<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tiket;

class TiketMobileController extends Controller
{
    public function showMyTicket(Request $request)
    {
        // 1. Ambil user yang sedang login lewat token Sanctum
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu!'
            ], 401);
        }

        // 2. Ambil data tiket dengan relasi event dan order
        // Menggunakan $user->userID karena ID user Anda menggunakan primary key custom (userID)
        $tikets = tiket::with(['event', 'order'])
            ->whereHas('order', function ($query) use ($user) {
                $query->where('userID', $user->userID);
            })
            ->orderBy('tiketID', 'desc')
            ->get(); // Menggunakan get() agar lebih mudah di-looping di Listview Flutter.

        // 3. Kembalikan response berupa JSON
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil riwayat tiket.',
            'data'    => $tikets
        ], 200);
    }
}