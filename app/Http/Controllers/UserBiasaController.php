<?php

namespace App\Http\Controllers;

use App\Models\UserBiasa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;

class UserBiasaController extends Controller
{
    public function ShowLogin()
    {
        return view('akun.login');
    }

    public function login(Request $request)
    {
        $usernameInput = $request->input('username');
        $passwordInput = $request->input('password');

        $user = UserBiasa::where('username', $usernameInput)->first();

        if ($user) {
            // Perbaikan: gunakan check (huruf kecil)
            if (Hash::check($passwordInput, $user->password)) { 
                Session::put('user_id', $user->userID);
                Session::put('user_name', $user->nameUser);             
                return redirect('/Homepage');
            }
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nameUser' => 'required',
            // Perbaikan: Pastikan unique ke tabel user yang benar (contoh: 'users')
            'email' => 'required|email|unique:user,email', 
            'username' => 'required|alpha_num|unique:user,username',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'gender' => 'required',
            'phone' => 'required|regex:/^08[0-9]{8,11}$/',
            'birthDate' => 'required|date|before:today',
        ], [
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka.',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.regex'     => 'Password harus mengandung setidaknya 1 huruf besar, 1 angka, dan 1 simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'phone.regex'        => 'Nomor telepon tidak valid.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini'
        ]);

        DB::beginTransaction();
        try {
            $lastUser = UserBiasa::orderBy('userID', 'desc')->lockForUpdate()->first();
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
            $user->gender = filter_var($request->input('gender'), FILTER_VALIDATE_BOOLEAN);
            $user->phone = $request->input('phone');
            $user->birthDate = $request->input('birthDate');
            $user->save();

            DB::commit();
            return redirect('/')->with('success', 'Registrasi Berhasil! Silakan Login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal register : ' . $e->getMessage())->withInput();
        }
    }

    public function BeliTiket(){
        return view('booking.create');
    }
}
