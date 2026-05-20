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
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $event = Event::findOrFail($id);
        $qty = $request->qty ?? 1;
        $total = $qty * $event->entranceFee;

        DB::beginTransaction();
        try {
            $orderID = $this->generateID('order', 'orderID', 'OD');
            order::create([
                'orderID' => $orderID,
                'orderDate' => now(),
                'userID' => Session::get('user_id'),
                'totalPrice' => $total,
            ]);

            $paymentID = $this->generateID('payment', 'paymentID', 'PY');
            payment::create([
                'paymentID' => $paymentID,
                'paymentDate' => now(),
                'paymentStatus' => 'pending',
                'orderID' => $orderID,
            ]);

            for ($i = 0; $i < $qty; $i++) {
                $tiketID = $this->generateID('tiket', 'tiketID', 'TK');
                tiket::create([
                    'tiketID' => $tiketID,
                    'price' => $event->entranceFee,
                    'tiketStatus' => 0, // 0 = Pending awal
                    'eventID' => $id,
                    'orderID' => $orderID,
                ]);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $orderID,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => Session::get('user_name') ?? 'Customer',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            DB::commit();
            return view('booking.payment', compact('event', 'qty', 'total', 'orderID', 'snapToken'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateID($table, $column, $prefix) {
        do {
            $id = $prefix . strtoupper(Str::random(4));
        } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }

    public function success($orderID) {
    // 💡 TRIK SAKTI UNTUK LOCALHOST:
    // Karena Midtrans internet tidak bisa mengirim callback ke localhost laptopmu,
    // kita paksa update statusnya langsung di sini ketika halaman sukses diakses.
    \App\Models\payment::where('orderID', $orderID)->update(['paymentStatus' => 'success']);
    \App\Models\tiket::where('orderID', $orderID)->update(['tiketStatus' => 1]); // Jadi Aktif

    return view('booking.success', compact('orderID'));
}

    public function failed($orderID) {
        return view('booking.failed', compact('orderID'));
    }

    public function callback(Request $request) {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                payment::where('orderID', $request->order_id)->update(['paymentStatus' => 'success']);
                tiket::where('orderID', $request->order_id)->update(['tiketStatus' => 1]); // 1 = Lunas / Aktif
            } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                payment::where('orderID', $request->order_id)->update(['paymentStatus' => 'failed']);
                tiket::where('orderID', $request->order_id)->update(['tiketStatus' => 2]); // 2 = Gagal / Expired
            }
        }
        return response()->json(['status' => 'ok']);
    }
}