<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DestCategory;
use App\Models\Destination;
use App\Models\Event;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class DestinationMobileController extends Controller
{
    public function tampilCategory(Request $request)
    {
        // 1. Logika Searching
        if ($request->has('search') && !empty(trim($request->search))) {
            $keyword = trim($request->search);

            // Ambil data
            $destinations = Destination::where('name', 'LIKE', '%' . $keyword . '%')->get();

            // Cek apakah hasil pencarian kosong
            if ($destinations->isEmpty()) {
                return response()->json([
                    'success' => false, // Ganti ke false agar Flutter bisa membedakan dengan sukses data
                    'message' => 'Destinasi Tidak Ditemukan.',
                    'type' => 'search',
                    'data' => [] // Kirim array kosong
                ], 200); // Tetap 200 OK karena server berhasil memproses request, hanya saja datanya tidak ada
            }

            // Jika data ditemukan
            return response()->json([
                'success' => true,
                'message' => 'Destinasi Ditemukan',
                'type' => 'search',
                'data' => $destinations
            ], 200);
        }

        // 2. Jika tidak ada search, ambil semua kategori
        $categories = DestCategory::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kategori berhasil diambil',
            'type' => 'category',
            'data' => $categories
        ], 200);
    }

    //function untuk menampilkan destinasi-destinasi yang ada dalam sebuah kategori
    public function destinasiByKategori(Request $request)
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        // Ambil ID Kategori dari URL parameter
        $categoryId = $request->destCategoryID;

        // Cari destinasi yang kolom categoryID-nya cocok
        $destinations = Destination::where('destCategoryID', $categoryId)->get();

        return response()->json([
            'success' => true,
            'data' => $destinations
        ], 200);
    }

    public function detailDestination(Request $request)
    {
        $destinationId = $request->destinationID;

        $destination = Destination::where('destinationID', $destinationId)->first();

        $relatedEvents = Event::where('destinationID', $destinationId)->get();

        if (!$destination) {
            return response()->json([
                'success' => false, // Ganti ke false agar Flutter bisa membedakan dengan sukses data
                'message' => 'Destinasi Tidak Ditemukan.',
                'destination' => null, // Kirim array kosong
                'event' => []
            ], 200); // Tetap 200 OK karena server berhasil memproses request, hanya saja datanya tidak ada
        }

        return response()->json([
            'success' => true,
            'message' => 'Destinasi Ditemukan',
            'destination' => $destination,   
            'event' => $relatedEvents
        ], 200);
    }

    public function tampilGaleri(){
        $destination = Destination::all();

        if (!$destination) {
            return response()->json([
                'success' => false, 
                'message' => 'Destinasi Tidak Ditemukan',
                'data' => [], 
            ], 200); 
        }

        return response()->json([
            'success' => true,
            'message' => 'Destinasi Ditemukan',
            'data' => $destination
        ], 200);
    }
}
