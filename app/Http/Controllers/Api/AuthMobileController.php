<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBiasa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthMobileController extends Controller
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
}