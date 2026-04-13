<?php

namespace App\Http\Controllers;

use App\Models\UserBiasa;
use Faker\Provider\PhoneNumber;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class UserBiasaController extends Controller
{
    public function ShowLogin()
    {
        return view('akun.login');
    }

    public function login(Request $request)
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        $usernameInput = $request->input('username'); //penamaan variabel diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        $passwordInput = $request->input('password');

        //query
        $user = UserBiasa::where('username', $usernameInput)->first();

        if ($user) {
            if (Hash::Check($passwordInput, $user->password)) { // Cek Password apakah sama dengan yang disimpan didalam database atau tidak
                Session::put('user_id', $user->userID); //perbarui admin_id pada session menggunakan $adminID
                Session::put('user_name', $user->nameUser); //perbarui admin_name pada session menggunakan $adminName                
                //Redirect ke URL halaman Passkey (/verifikasi-login)
                return redirect('/Homepage');
            }
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function register(Request $request)
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        //validasi input
        $request->validate([
            'nameUser' => 'required',
            'email' => 'required|email|unique:admin,email',
            'username' => 'required|alpha_num|unique:admin,username',
            'password' => [
                'required',
                'confirmed', //passowrd yang diinputkan harus sesuai dengan yang diinputkan di form input ('password_confirmation')
                'min:8', //password minimal 8 karakter
                'regex:/[A-Z]/', //password harus ada huruf besar (minimal 1)
                'regex:/[0-9]/', //password harus ada angka (minimal 1)
                'regex:/[@$!%*#?&]/', //password harus ada simbol (minimal 1)
            ],
            'gender' => 'required',
            'phone' => 'required|regex:/^08[0-9]{8,11}$/',
            'birthDate' => 'required|date|before:today',
        ], [
            //Pesan Error Custom
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka (tanpa simbol).',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.regex'     => 'Password harus mengandung setidaknya 1 huruf besar, 1 angka, dan 1 simbol (@ $ ! % * # ? &).',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'phone.regex'        => 'Nomor telepon hanya boleh berisi angka.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini'
        ]);

        //memulai transaction ke database
        DB::beginTransaction();

        try {
            //generate adminID baru (ID-ID terdiri dari 6 karakter dengan 3 karakter pertama adalah alfabet dan 3 karakter sisanya adalah angka (mengurut))
            $lastUser = UserBiasa::orderBy('userID', 'desc')->lockForUpdate()->first(); //ambil adminID terakhir yang ada pada tabel admin di database
            $newUserID = 'usr001'; //jika tidak ditemukan adminID terakhir, gunakan $newAdminID

            if ($lastUser) { //jika ditemukan adminID terakhir, maka generate adminID baru
                $lastID = $lastUser->userID;
                $number = (int) substr($lastID, 3);
                $number++;
                $newUserID = 'usr' . sprintf("%03d", $number);
            }

            //buat objek Admin dan simpan datanya ke database
            $user = new UserBiasa();
            $user->userID = $newUserID;
            $user->nameUser = $request->input('nameUser');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password')); //password disimpan dalam bentuk hash
            $user->gender = filter_var($request->input('gender'), FILTER_VALIDATE_BOOLEAN);
            $user->phone = $request->input('phone');
            $user->birthDate = $request->input('birthDate');
            $user->save();

            //commit transaction ke database
            DB::commit();
            //Redirect ke URL login (/login) dengan pesan sukses
            return redirect('/')->with('success', 'Registrasi Berhasil! Silakan Login.');
        } catch (\Exception $e) {
            //Jika ada yang salah, rollback transaction
            DB::rollBack();
            //jika salah, Kembali ke halaman register dengan pesan error
            return back()->with('error', 'Gagal register : ' . $e->getMessage())->withInput();
        }
    }

    public function BeliTiket(){
        return view('booking.create');
    }
}
