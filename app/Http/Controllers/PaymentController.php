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
    // Proses saat tombol "Beli Tiket" ditekan
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
            // 1. Buat Data Order (Maks 6 karakter)
            $orderID = $this->generateID('order', 'orderID', 'OD');
            order::create([
                'orderID' => $orderID,
                'orderDate' => now(),
                'userID' => Session::get('user_id'),
                'totalPrice' => $total,
            ]);

            // 2. Buat Data Payment (Status Pending)
            $paymentID = $this->generateID('payment', 'paymentID', 'PY');
            payment::create([
                'paymentID' => $paymentID,
                'paymentDate' => now(),
                'paymentStatus' => 'pending',
                'orderID' => $orderID,
            ]);

            // 3. Buat Data Tiket (Status 0 = Belum Dibayar)
            for ($i = 0; $i < $qty; $i++) {
                $tiketID = $this->generateID('tiket', 'tiketID', 'TK');
                tiket::create([
                    'tiketID' => $tiketID,
                    'price' => $event->entranceFee,
                    'tiketStatus' => 0, 
                    'eventID' => $id,
                    'orderID' => $orderID,
                ]);
            }

            DB::commit();
            // Tampilkan halaman konfirmasi pembayaran
            return view('booking.payment', compact('event', 'qty', 'total', 'orderID'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Fungsi Helper untuk generate ID 6 Karakter
    private function generateID($table, $column, $prefix) {
        do {
            $id = $prefix . strtoupper(Str::random(4));
        } while (DB::table($table)->where($column, $id)->exists());
        return $id;
    }

    // Fungsi pura-pura sukses bayar (Bypass untuk video progress)
    public function dummyPay($orderID)
    {
        // Ubah status payment jadi success
        payment::where('orderID', $orderID)->update(['paymentStatus' => 'success']);
        
        // Ubah status tiket jadi 1 (Aktif)
        tiket::where('orderID', $orderID)->update(['tiketStatus' => 1]);

        return redirect('/MyTiket')->with('success', 'Pembayaran Berhasil! Tiket Anda sudah diterbitkan.');
    }
}