<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\order;
use App\Models\payment;
use App\Models\tiket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentMobileController extends Controller
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
        $user = $request->user();
        $event = Event::findOrFail($id);
        $qty = $request->qty ?? 1;

        if ($event->quota < $qty) {
            return response()->json(['success' => false, 'message' => 'Kuota tidak mencukupi!'], 400);
        }

        DB::beginTransaction();
        try {
            $orderID = $this->generateID('order', 'orderID', 'OD');
            $total = $qty * $event->entranceFee;
            order::create(['orderID' => $orderID, 'orderDate' => now(), 'userID' => $user->userID, 'totalPrice' => $total]);
            payment::create(['paymentID' => $this->generateID('payment', 'paymentID', 'PY'), 'paymentDate' => now(), 'paymentStatus' => 'pending', 'orderID' => $orderID]);

            for ($i = 0; $i < $qty; $i++) {
                tiket::create(['tiketID' => $this->generateID('tiket', 'tiketID', 'TK'), 'price' => $event->entranceFee, 'tiketStatus' => 0, 'eventID' => $id, 'orderID' => $orderID]);
            }

            $event->decrement('quota', $qty);

            // 💡 TRIK BYPASS: Sama persis dengan web
            $midtransOrderID = $orderID . '-' . time();
            $snapToken = \Midtrans\Snap::getSnapToken([
                'transaction_details' => ['order_id' => $midtransOrderID, 'gross_amount' => (int)$total],
                'customer_details' => ['first_name' => $user->name ?? 'Customer']
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'orderID' => $orderID,
                'redirect_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function continuePayment(Request $request, $orderID)
    {
        $user = $request->user();
        $order = order::where('orderID', $orderID)->firstOrFail();
        $total = $order->totalPrice;
        
        $midtransOrderID = $orderID . '-' . time();
        $snapToken = \Midtrans\Snap::getSnapToken([
            'transaction_details' => ['order_id' => $midtransOrderID, 'gross_amount' => (int)$total],
            'customer_details' => ['first_name' => $user->name ?? 'Customer']
        ]);
        
        return response()->json([
            'success' => true,
            'redirect_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken
        ]);
    }

    public function cancelPayment($orderID)
    {
        DB::beginTransaction();
        try {
            $payment = payment::where('orderID', $orderID)->first();
            if ($payment->paymentStatus == 'cancelled') {
                return response()->json(['success' => false, 'message' => 'Sudah dibatalkan!'], 400);
            }

            $payment->update(['paymentStatus' => 'cancelled']);
            $tikets = tiket::where('orderID', $orderID)->get();
            
            if ($tikets->count() > 0) {
                Event::find($tikets->first()->eventID)->increment('quota', $tikets->count());
            }
            tiket::where('orderID', $orderID)->update(['tiketStatus' => 2]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pesanan dibatalkan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal membatalkan pesanan.'], 500);
        }
    }

    private function generateID($table, $column, $prefix) {
        do { $id = $prefix . strtoupper(Str::random(4)); } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }
}