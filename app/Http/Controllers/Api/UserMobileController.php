<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBiasa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule; // Tambahkan ini untuk Rule::unique
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'phone.regex'        => 'Nomor telepon tidak valid.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini'
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

    public function register(Request $request)
    {
        // 1. Validasi input dari Flutter
        $request->validate([
            'nameUser'  => 'required|string|max:255',
            'email'     => [
                'required',
                'email',
                Rule::unique('user')->whereNull('deleted_at')
            ],
            'username'  => [
                'required',
                'alpha_num',
                Rule::unique('user')->whereNull('deleted_at')
            ],
            'password'  => [
                'required',
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
            'email.unique'       => 'Email sudah terdaftar.',
            'username.unique'    => 'Username sudah digunakan.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka (tanpa simbol).',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.regex'     => 'Password harus mengandung setidaknya 1 huruf besar, 1 angka, dan 1 simbol.',
            'phone.regex'        => 'Nomor telepon tidak valid.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini.'
        ]);

        // 2. Mulai proses database transaction
        DB::beginTransaction();
        try {
            // Cek apakah email ATAU username yang diinput ada di data yang terhapus
            $trashedUser = UserBiasa::onlyTrashed()
                ->where(function ($query) use ($request) {
                    $query->where('username', $request->input('username'))
                        ->orWhere('email', $request->input('email'));
                })
                ->first();

            // CATATAN GENDER: Di web Anda menggunakan filter_var(..., FILTER_VALIDATE_BOOLEAN). 
            // Karena Flutter mengirim string 'Laki-laki' / 'Perempuan', kita konversi manual menjadi 1 atau 0:
            $isMale = ($request->input('gender') === 'Laki-laki' || $request->input('gender') == '1') ? 1 : 0;

            if ($trashedUser) {
                // ==========================================
                // KONDISI A: AKUN LAMA DITEMUKAN -> RESTORE
                // ==========================================
                $trashedUser->restore(); // Kembalikan akun (ubah deleted_at menjadi null)

                $trashedUser->nameUser  = $request->input('nameUser');
                $trashedUser->email     = $request->input('email');
                $trashedUser->username  = $request->input('username');
                $trashedUser->password  = Hash::make($request->input('password'));
                $trashedUser->gender    = $isMale; // Pakai nilai yang sudah dikonversi
                $trashedUser->phone     = $request->input('phone');
                $trashedUser->birthDate = $request->input('birthDate');

                $trashedUser->save();

                $user = $trashedUser; // Simpan data user untuk dikirim di response
            } else {
                // ==========================================
                // KONDISI B: AKUN BENAR-BENAR BARU -> CREATE
                // ==========================================
                $lastUser = UserBiasa::withTrashed()->orderBy('userID', 'desc')->first();
                $newUserID = 'usr001';

                if ($lastUser) {
                    $lastID = $lastUser->userID;
                    $number = (int) substr($lastID, 3);
                    $number++;
                    $newUserID = 'usr' . sprintf("%03d", $number);
                }

                $user = new UserBiasa();
                $user->userID = $newUserID;
                $user->nameUser = $request->input('nameUser');
                $user->email = $request->input('email');
                $user->username = $request->input('username');
                $user->password = Hash::make($request->input('password'));
                $user->gender = $isMale; // Pakai nilai yang sudah dikonversi
                $user->phone = $request->input('phone');
                $user->birthDate = $request->input('birthDate');

                $user->save();
            }

            DB::commit();

            // Mengembalikan JSON Response ke Flutter (Bukan redirect seperti web)
            return response()->json([
                'success' => true,
                'message' => 'Registrasi Berhasil! Silakan Login.',
                'data'    => $user
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // Mengembalikan Error JSON ke Flutter
            return response()->json([
                'success' => false,
                'message' => 'Gagal register : ' . $e->getMessage()
            ], 500);
        }
    }
}
