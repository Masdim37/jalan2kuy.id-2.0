<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiket;
use Illuminate\Support\Facades\Session;

class TiketController extends Controller
{
    public function showMyTicket()
    {
        // 1. Pastikan user sudah login
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $userID = Session::get('user_id');

        // 2. Ambil semua tiket milik user (Pending, Lunas, Maupun Gagal)
        // Diurutkan dari yang terbaru, dibatasi 5 tiket per halaman
        $tikets = tiket::with(['event', 'order'])
            ->whereHas('order', function ($query) use ($userID) {
                $query->where('userID', $userID);
            })
            ->orderBy('tiketID', 'desc') // Menampilkan yang paling baru dibeli di urutan teratas
            ->paginate(5);

        return view('tikets.myTikets', compact('tikets'));
    }

    public function scanTiket($tiketID)
    {
        $tiket = tiket::where('tiketID', $tiketID)->first();

        if ($tiket && $tiket->tiketStatus == 1) {
            // Ubah status menjadi 0 setelah sukses di-scan (hangus)
            $tiket->tiketStatus = 0;
            $tiket->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Tiket Valid! Selamat Datang.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Tiket Tidak Valid atau Sudah Pernah Digunakan!'
        ], 400);
    }
}