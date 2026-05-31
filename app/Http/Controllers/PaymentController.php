<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\order;
use App\Models\payment;
use App\Models\tiket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function checkout(Request $request, $id)
    {
        if (!Session::has('user_id')) return redirect('/login')->with('error', 'Silakan login!');

        $event = Event::findOrFail($id);
        $qty = $request->qty ?? 1;

        if ($event->quota < $qty) return back()->with('error', 'Kuota tidak mencukupi!');

        DB::beginTransaction();
        try {
            $orderID = $this->generateID('order', 'orderID', 'OD');
            $total = $qty * $event->entranceFee;
            order::create(['orderID' => $orderID, 'orderDate' => now(), 'userID' => Session::get('user_id'), 'totalPrice' => $total]);
            payment::create(['paymentID' => $this->generateID('payment', 'paymentID', 'PY'), 'paymentDate' => now(), 'paymentStatus' => 'pending', 'orderID' => $orderID]);

            for ($i = 0; $i < $qty; $i++) {
                tiket::create(['tiketID' => $this->generateID('tiket', 'tiketID', 'TK'), 'price' => $event->entranceFee, 'tiketStatus' => 0, 'eventID' => $id, 'orderID' => $orderID]);
            }

            $event->decrement('quota', $qty);

            // 💡 TRIK BYPASS: Tambah buntut timestamp
            $midtransOrderID = $orderID . '-' . time();
            $snapToken = \Midtrans\Snap::getSnapToken(['transaction_details' => ['order_id' => $midtransOrderID, 'gross_amount' => (int)$total], 'customer_details' => ['first_name' => Session::get('user_name') ?? 'Customer']]);

            DB::commit();
            return view('booking.payment', compact('event', 'qty', 'orderID', 'snapToken', 'total'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function callback(Request $request) {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            // 💡 KEMBALIKAN ID: Potong buntut timestamp
            $dbOrderID = explode('-', $request->order_id)[0];

            $payment = payment::where('orderID', $dbOrderID)->first();
            if ($payment && ($payment->paymentStatus == 'success' || $payment->paymentStatus == 'cancelled')) {
                return response()->json(['status' => 'already_processed']);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                payment::where('orderID', $dbOrderID)->update(['paymentStatus' => 'success']);
                tiket::where('orderID', $dbOrderID)->update(['tiketStatus' => 1]);
            } elseif (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
                payment::where('orderID', $dbOrderID)->update(['paymentStatus' => 'failed']);
                
                $tikets = tiket::where('orderID', $dbOrderID)->get();
                if ($tikets->count() > 0) {
                    Event::find($tikets->first()->eventID)->increment('quota', $tikets->count());
                }
                tiket::where('orderID', $dbOrderID)->update(['tiketStatus' => 2]);
            }
        }
        return response()->json(['status' => 'ok']);
    }

    public function success($orderID) {
        payment::where('orderID', $orderID)->update(['paymentStatus' => 'success']);
        tiket::where('orderID', $orderID)->update(['tiketStatus' => 1]);
        return view('booking.success', compact('orderID'));
    }

    public function failed($orderID) {
        return view('booking.failed', compact('orderID'));
    }

    public function continuePayment($orderID) {
        $order = order::where('orderID', $orderID)->firstOrFail();
        $qty = tiket::where('orderID', $orderID)->count();
        $event = Event::findOrFail(tiket::where('orderID', $orderID)->first()->eventID);
        $total = $order->totalPrice;
        
        // 💡 TRIK BYPASS: Tambah buntut timestamp
        $midtransOrderID = $orderID . '-' . time();
        $snapToken = \Midtrans\Snap::getSnapToken(['transaction_details' => ['order_id' => $midtransOrderID, 'gross_amount' => (int)$total], 'customer_details' => ['first_name' => Session::get('user_name') ?? 'Customer']]);
        
        return view('booking.payment', compact('event', 'qty', 'orderID', 'snapToken', 'total'));
    }

    public function cancelPayment($orderID) {
        DB::beginTransaction();
        try {
            $payment = payment::where('orderID', $orderID)->first();
            if ($payment->paymentStatus == 'cancelled') return back()->with('error', 'Sudah dibatalkan!');

            $payment->update(['paymentStatus' => 'cancelled']);
            $tikets = tiket::where('orderID', $orderID)->get();
            
            if ($tikets->count() > 0) {
                Event::find($tikets->first()->eventID)->increment('quota', $tikets->count());
            }
            tiket::where('orderID', $orderID)->update(['tiketStatus' => 2]);

            DB::commit();
            return back()->with('success', 'Pesanan dibatalkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal.');
        }
    }

    private function generateID($table, $column, $prefix) {
        do { $id = $prefix . strtoupper(Str::random(4)); } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }
}