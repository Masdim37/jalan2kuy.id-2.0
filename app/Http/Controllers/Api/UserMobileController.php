<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBiasa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserMobileController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input dari Flutter
        $request->validate([
            'username' => 'required', // Sesuaikan dengan field di database Anda, misalnya 'username'
            'password' => 'required'
        ]);

        // 2. Cari user berdasarkan email
        $user = UserBiasa::where('username', $request->username)->first();

        // 3. Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah.'
            ], 401);
        }

        // 4. Buat Token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Kembalikan response JSON ke Flutter
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    public function showAccount(Request $request)
    {
        // Karena route ini akan dilindungi middleware auth:sanctum, 
        // kita bisa langsung mengambil data user yang sedang login lewat $request
        $user = $request->user();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Data akun berhasil diambil',
                'data' => $user
            ], 200);
        }

        // Return error (meskipun skenario ini jarang terjadi jika middleware aktif)
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    public function editProfile(Request $request)
    {
        // 1. Langsung ambil instance user dari Sanctum token
        $user = $request->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi tidak valid'], 401);
        }

        // Ambil ID user untuk pengecekan rule 'unique' saat ignore data sendiri
        $currentId = $user->userID;

        // 2. Proses Validasi
        $request->validate([
            'nameUser'  => 'required|string|max:255',
            // Menggunakan nama tabel 'user' dan primary key 'userID' sesuai konfigurasi Anda
            'email'     => 'required|email|unique:user,email,' . $currentId . ',userID',
            'username'  => 'required|alpha_num|unique:user,username,' . $currentId . ',userID',
            'password'  => [
                'nullable',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'gender'    => 'required',
            'phone'     => 'required|regex:/^08[0-9]{8,11}$/',
            'birthDate' => 'required|date|before:today',
        ], [
            // Pesan Error Custom
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka (tanpa simbol).',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.regex'     => 'Password harus mengandung setidaknya 1 huruf besar, 1 angka, dan 1 simbol (@ $ ! % * # ? &).',
            'phone.regex'        => 'Nomor telepon tidak valid.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini.'
        ]);

        // 3. Siapkan data yang akan diupdate
        $updateData = [
            'nameUser'  => $request->nameUser,
            'email'     => $request->email,
            'username'  => $request->username,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'birthDate' => $request->birthDate,
        ];

        // 4. Logika Pengamanan Password (Hanya update & hash jika user mengisi password baru)
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // 5. Eksekusi ORM Update langsung ke instance user aktif
        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
            'data'    => $user
        ], 200);
    }
}
