<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventMobileController extends Controller
{
    public function tampilEvent(Request $request)
    {
        // 2. Mulai query
        $query = Event::query();

        // 3. Logika searching berdasarkan tanggal lewat Query Parameters (misal: ?start_date=2026-01-01&end_date=2026-01-10)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('startDate', [
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        }

        // 4. Ambil data event (urutkan dari yang terbaru)
        $events = $query->orderBy('startDate', 'desc')->get();

        // 5. Cek apakah data event kosong atau tidak untuk memberikan message yang proporsional di Flutter
        if ($events->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada event yang ditemukan pada rentang tanggal tersebut.',
                'data' => [] // Tetap kirim array kosong agar Flutter tidak crash
            ], 200);
        }

        // 6. Mengembalikan JSON Response sukses membawa data $events
        return response()->json([
            'success' => true,
            'message' => 'Daftar event berhasil diambil.',
            'data' => $events
        ], 200);
    }

    public function tampilDetailEvent(Request $request)
    {

        $eventID = $request->eventID;
        $event = Event::where('eventID', $eventID)->first();

        if (!$event) {
            return response()->json([
                'success' => false, // Ganti ke false agar Flutter bisa membedakan dengan sukses data
                'message' => 'Event Tidak Ditemukan.',
                'data' => null,
            ], 200); // Tetap 200 OK karena server berhasil memproses request, hanya saja datanya tidak ada
        }

        return response()->json([
            'success' => true, // Ganti ke false agar Flutter bisa membedakan dengan sukses data
            'message' => 'Event Ditemukan.',
            'data' => $event,
        ], 200);
    }
}
