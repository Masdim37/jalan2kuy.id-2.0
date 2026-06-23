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
        // Set konfigurasi Midtrans
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
                $eventID = $tikets->first()->eventID;
                Event::find($eventID)->increment('quota', $tikets->count());
            }
            tiket::where('orderID', $orderID)->update(['tiketStatus' => 2]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pesanan dibatalkan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal membatalkan pesanan.'], 500);
        }
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed !== $request->signature_key) {
            return response()->json(['success' => false, 'message' => 'Signature Key tidak valid!'], 403);
        }

        $midtransOrderID = $request->order_id;
        $orderID = explode('-', $midtransOrderID)[0];

        $payment = \App\Models\payment::where('orderID', $orderID)->first();
        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Data pembayaran tidak ditemukan'], 444);
        }

        $transactionStatus = $request->transaction_status;

        DB::beginTransaction();
        try {
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                // STATUS LUNAS
                $payment->update(['paymentStatus' => 'success']);
                \App\Models\tiket::where('orderID', $orderID)->update(['tiketStatus' => 1]);

            } elseif ($transactionStatus == 'pending') {
                // STATUS PENDING
                $payment->update(['paymentStatus' => 'pending']);
                \App\Models\tiket::where('orderID', $orderID)->update(['tiketStatus' => 0]);

            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                // STATUS BATAL / EXPIRED
                $payment->update(['paymentStatus' => 'cancelled']);
                
                $tikets = \App\Models\tiket::where('orderID', $orderID)->get();
                if ($tikets->count() > 0) {
                    $eventID = $tikets->first()->eventID;
                    \App\Models\Event::find($eventID)->increment('quota', $tikets->count());
                }
                
                \App\Models\tiket::where('orderID', $orderID)->update(['tiketStatus' => 2]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Status database berhasil diperbarui']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function generateID($table, $column, $prefix) {
        do { 
            $id = $prefix . strtoupper(Str::random(4)); 
        } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }
}