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
        if (!Session::has('user_id')) return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');

        $event = Event::findOrFail($id);
        $qty = $request->qty ?? 1;

        if ($event->quota < $qty) return back()->with('error', 'Maaf, sisa kuota tiket tidak mencukupi!');

        $total = $qty * $event->entranceFee;

        DB::beginTransaction();
        try {
            $orderID = $this->generateID('order', 'orderID', 'OD');
            order::create(['orderID' => $orderID, 'orderDate' => now(), 'userID' => Session::get('user_id'), 'totalPrice' => $total]);
            payment::create(['paymentID' => $this->generateID('payment', 'paymentID', 'PY'), 'paymentDate' => now(), 'paymentStatus' => 'pending', 'orderID' => $orderID]);

            for ($i = 0; $i < $qty; $i++) {
                tiket::create(['tiketID' => $this->generateID('tiket', 'tiketID', 'TK'), 'price' => $event->entranceFee, 'tiketStatus' => 0, 'eventID' => $id, 'orderID' => $orderID]);
            }

            // Kurangi kuota saat checkout
            $event->decrement('quota', $qty);

            $params = [
                'transaction_details' => ['order_id' => $orderID, 'gross_amount' => (int)$total],
                'customer_details' => ['first_name' => Session::get('user_name') ?? 'Customer'],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            DB::commit();
            return view('booking.payment', compact('event', 'qty', 'total', 'orderID', 'snapToken'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function continuePayment($orderID)
    {
        if (!Session::has('user_id')) return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');

        $order = order::where('orderID', $orderID)->firstOrFail();
        $anyTiket = tiket::where('orderID', $orderID)->firstOrFail();
        $event = Event::findOrFail($anyTiket->eventID);

        $qty = tiket::where('orderID', $orderID)->count();
        $total = $order->totalPrice;

        $params = [
            'transaction_details' => ['order_id' => $orderID, 'gross_amount' => (int)$total],
            'customer_details' => ['first_name' => Session::get('user_name') ?? 'Customer'],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('booking.payment', compact('event', 'qty', 'total', 'orderID', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses ulang pembayaran: ' . $e->getMessage());
        }
    }

    public function cancelPayment($orderID)
    {
        if (!Session::has('user_id')) return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');

        DB::beginTransaction();
        try {
            $payment = payment::where('orderID', $orderID)->first();
            if ($payment->paymentStatus == 'cancelled') return back()->with('error', 'Pesanan ini sudah dibatalkan sebelumnya.');

            payment::where('orderID', $orderID)->update(['paymentStatus' => 'cancelled']);

            $tikets = tiket::where('orderID', $orderID)->get();
            $qty = $tikets->count();

            if ($qty > 0) {
                $eventID = $tikets->first()->eventID;
                $event = Event::find($eventID);
                if ($event) {
                    $event->increment('quota', $qty);
                }
            }

            tiket::where('orderID', $orderID)->update(['tiketStatus' => 2]);

            DB::commit();
            return redirect()->back()->with('success', 'Pesanan dibatalkan dan kuota telah dikembalikan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $payment = payment::where('orderID', $request->order_id)->first();
            if ($payment && ($payment->paymentStatus == 'success' || $payment->paymentStatus == 'cancelled')) {
                return response()->json(['status' => 'already_processed']);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                payment::where('orderID', $request->order_id)->update(['paymentStatus' => 'success']);
                tiket::where('orderID', $request->order_id)->update(['tiketStatus' => 1]);
            } elseif (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
                payment::where('orderID', $request->order_id)->update(['paymentStatus' => 'failed']);
                
                $tikets = tiket::where('orderID', $request->order_id)->get();
                if ($tikets->count() > 0) {
                    Event::find($tikets->first()->eventID)->increment('quota', $tikets->count());
                }
                tiket::where('orderID', $request->order_id)->update(['tiketStatus' => 2]);
            }
        }
        return response()->json(['status' => 'ok']);
    }

    public function success($orderID)
    {
        payment::where('orderID', $orderID)->update(['paymentStatus' => 'success']);
        tiket::where('orderID', $orderID)->update(['tiketStatus' => 1]);
        return view('booking.success', compact('orderID'));
    }

    public function failed($orderID)
    {
        return view('booking.failed', compact('orderID'));
    }

    private function generateID($table, $column, $prefix)
    {
        do { $id = $prefix . strtoupper(Str::random(4)); } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }
}