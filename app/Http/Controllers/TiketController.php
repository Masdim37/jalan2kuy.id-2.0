<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiket;
use Illuminate\Support\Facades\Session;

class TiketController extends Controller
{
    // Fungsi untuk menampilkan daftar tiket milik user
    public function showMyTicket()
    {
        // Cek apakah user sudah login
        if (!Session::has('user_id')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu!');
        }

        $userId = Session::get('user_id'); 
        
        // HANYA ambil tiket yang SUDAH DIBAYAR (tiketStatus = 1)
        $tikets = tiket::whereHas('order', function($query) use ($userId) {
            $query->where('userID', $userId);
        })->where('tiketStatus', 1)->with('event')->get();

        return view('tikets.myTikets', compact('tikets'));
    }

    // Fungsi scan tiket (opsional untuk admin)
    public function scanTiket($tiketID)
    {
        $tiket = tiket::find($tiketID);
        
        if ($tiket && $tiket->tiketStatus == 1) {
            $tiket->update(['tiketStatus' => 0]);
            return redirect()->back()->with('success', 'Tiket berhasil di-scan!');
        }
        
        return redirect()->back()->with('error', 'Tiket tidak valid atau sudah digunakan.');
    }
}