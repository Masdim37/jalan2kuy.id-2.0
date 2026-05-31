<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiket;
use Illuminate\Support\Facades\Session;

class TiketController extends Controller
{
    public function showMyTicket()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $userID = Session::get('user_id');

        $tikets = tiket::with(['event', 'order'])
            ->whereHas('order', function ($query) use ($userID) {
                $query->where('userID', $userID);
            })
            ->orderBy('tiketID', 'desc') 
            ->paginate(5);

        return view('tikets.myTikets', compact('tikets'));
    }

    public function scanTiket($tiketID)
    {
        $tiket = tiket::where('tiketID', $tiketID)->first();

        if ($tiket && $tiket->tiketStatus == 1) {
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

    // Fungsi Baru: Tampilkan Tiket untuk di-Print
    public function printTiket($tiketID)
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $tiket = tiket::with(['event', 'order'])->where('tiketID', $tiketID)->firstOrFail();

        if ($tiket->tiketStatus != 1) {
            return redirect('/MyTiket')->with('error', 'Tiket tidak valid atau belum dilunasi!');
        }

        return view('tikets.printTikets', compact('tiket'));
    }
}