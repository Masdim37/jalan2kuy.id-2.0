<?php

namespace App\Http\Controllers;

use App\Models\UserBiasa;
use App\Models\Event;
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
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka (tanpa simbol).',
            'password.min'       => 'Password minimal harus 8 karakter.',
            'password.regex'     => 'Password harus mengandung setidaknya 1 huruf besar, 1 angka, dan 1 simbol (@ $ ! % * # ? &).',
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

    public function prosesKirimOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = UserBiasa::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar!']);
        }

        $otp = rand(111111, 999999);
        Session::put('reset_email', $request->email);
        Session::put('reset_otp', $otp);

        try {
            Mail::to($request->email)->send(new SendOtpMail($otp));
            return redirect()->route('verifikasi.otp')->with('success', 'Kode OTP telah dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email OTP. Cek koneksi internet.']);
        }
    }

    public function tampilFormOtp()
    {
        if (!Session::has('reset_email')) return redirect()->route('lupa.password');
        return view('akun.lupaPassProses');
    }

    public function prosesVerifikasiOtp(Request $request)
    {
        if ($request->code == Session::get('reset_otp')) {
            Session::put('otp_verified', true);
            return redirect()->route('reset.password');
        }
        return back()->with('error', 'Kode OTP salah!');
    }

    public function resendOtp()
    {
        // 1. Ambil email yang sudah disimpan di session sebelumnya
        $email = Session::get('reset_email');

        // Jika tiba-tiba session hilang (kedaluwarsa), kembalikan ke halaman awal
        if (!$email) {
            return redirect()->route('lupa.password')->with('error', 'Sesi Anda telah berakhir, silakan masukkan email kembali.');
        }

        // 2. Buat kode OTP baru
        $newOtp = rand(111111, 999999);
        
        // 3. Timpa/Update session OTP lama dengan yang baru
        Session::put('reset_otp', $newOtp);

        // 4. Kirim ulang ke email
        try {
            Mail::to($email)->send(new SendOtpMail($newOtp));
            
            // return back() artinya sistem akan mengembalikan user ke halaman saat ini 
            // (yaitu halaman verifikasi OTP) tanpa harus membuat halaman baru.
            return back()->with('success', 'Kode OTP yang baru telah berhasil dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email OTP. Silakan periksa koneksi internet Anda.');
        }
    }

    public function tampilFormReset()
    {
        if (!Session::get('otp_verified')) return redirect()->route('lupa.password');
        return view('akun.gantiPass');
    }

    public function prosesUpdatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',      // Harus mengandung minimal 1 huruf kapital
                'regex:/[0-9]/',      // Harus mengandung minimal 1 angka
                'regex:/[@$!%*#?&]/', // Harus mengandung minimal 1 simbol/karakter khusus
            ]
        ]);
        $email = Session::get('reset_email');

        if (!$email) {
            return redirect()->route('lupa.password')->with('error', 'Sesi kedaluwarsa.');
        }

        $user = UserBiasa::where('email', $email)->first();
        if($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // buat menghapus bekas buat reset password tadi biar saat ngajuin reset lagi ngulang dari awal lagi
        Session::forget(['reset_email', 'reset_otp', 'otp_verified']);

        return redirect('/')->with('success', 'Password berhasil diubah!');
    }

    public function tampilFormLupaPass()
    {
        return view('akun.lupaPass');
    }

    public function TampilBeliTiket($id){
        if (!Session::has('user_id')) {
            return redirect('/')->with('error', 'Anda harus login dulu!');
        }
        $event = Event::select(
            'eventID',
            'name',
            'startDate',
            'endDate',
            'location',
            'entranceFee',
            'startTime',
            'endTime',
            'socialMedia',
            'imagePath'
        )
        ->where('eventID', $id)
        ->first();

        if (!$event) { //jika $event tidak ketemu
            //redirect ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Event tidak ditemukan.');
        }

        return view('booking.create', compact('event'));
    }

    // controller tiket
    public function showMyTicket()
    {
        return view('tikets.myTikets');
    }

    // controller payment
    public function payment(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $qty = $request->qty ?? 1;
        $total = $qty * $event->entranceFee;
        return view(
            'booking.payment',
            compact('event', 'qty', 'total')
        );
    }
    

    public function showAccount()
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        //Cek apakah user sudah melewati tahap login awal atau belum 
        if (!Session::has('user_id')) {
            return redirect('/')->with('error', 'Anda harus login dulu!');
        }

        //query
        $userID = Session::get('user_id'); //ambil adminID dari session

        //query
        $user = UserBiasa::find($userID); //Cari data admin lengkap bedasarkan adminID yang diambil pada database

        //Kirim data $admin ke view accountAdmin
        return view('akun.account', ['user' => $user]);
    }

    public function logout()
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        Session::flush(); //Hapus semua data session

        //Redirect ke halaman homepage (/)
        return redirect('/')->with('success', 'Berhasil Logout.');
    }

    public function tampilFormEditProfile()
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        //Cek apakah user sudah melewati tahap login awal atau belum 
        if (!Session::has('user_id')) {
            return redirect('/')->with('error', 'Anda harus login dulu!');
        }

        //query
        $userID = Session::get('user_id'); //ambil adminID dari session

        //query
        $user = UserBiasa::find($userID); //Cari data admin lengkap bedasarkan adminID yang diambil pada database

        //kirim data $admin ke view editAkun
        return view('akun.editAkun', ['user' => $user]);
    }

    public function editProfile(Request $request)
    { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        //Cek apakah user sudah melewati tahap login awal atau belum 
        if (!Session::has('user_id')) {
            return redirect('/')->with('error', 'Anda harus login dulu!');
        }

        //query
        $userID = Session::get('user_id'); //ambil adminID dari session

        //query
        $user = UserBiasa::find($userID); //Cari data admin lengkap bedasarkan adminID yang diambil pada database

        //Validasi Input
        $request->validate([
            'nameUser' => 'required',
            'email' => 'required|email|unique:user,email,' . $userID . ',userID',
            'username' => 'required|alpha_num|unique:user,username,' . $userID . ',userID',
                'password' => [
                'nullable',
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
            'phone.regex'        => 'Nomor telepon tidak valid.',
            'birthDate.before'   => 'Tanggal lahir harus sebelum hari ini'
        ]);

        //Update Data dari input yang sudah divalidasi dan simpan datanya ke database
        $user->nameUser = $request->input('nameUser');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->gender = filter_var($request->input('gender'), FILTER_VALIDATE_BOOLEAN);
        $user->phone = $request->input('phone');
        $user->birthDate = $request->input('birthDate');
        //Cek apakah user mengisi password baru
        if ($request->filled('password')) { //jika user mengisi password baru
            $user->password = Hash::make($request->input('password')); //simpan password baru dalam bentuk hash
        }
        $user->save();

        //Update admin_name pada session  (jika nama berubah)
        Session::put('user_name', $user->nameUser);

        //Redirect ke halaman showAccount (/admin/Account)
        return redirect('/Account')->with('success', 'Profil berhasil diperbarui!');
    }

    // public function deleteAccount()
    // { //penamaan function diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
    //     //Cek apakah user sudah melewati tahap login awal atau belum 
    //     if (!Session::has('user_id')) {
    //         return redirect('/')->with('error', 'Anda harus login dulu!');
    //     }

    //     //query
    //     $userID = Session::get('user_id'); //ambil adminID dari session

    //     if ($userID) { //jika adminID ditemukan dari session
    //         //Memulai Transaction ke database
    //         DB::beginTransaction();
    //         try {
    //             //ubah foreign key adminID disetiap event menjadi null (query)
    //             Event::where('adminID', $adminID)->update(['adminID' => null]);

    //             //ubah foreign key adminID disetiap destination menjadi null (query)
    //             Destination::where('adminID', $adminID)->update(['adminID' => null]);

    //             //delete adminnya berdasarkan adminID (query)
    //             Admin::where('adminID', $adminID)->delete();

    //             //commit transaction
    //             DB::commit();

    //             //bersihkan session
    //             Session::flush();

    //             //redirect ke homepage (/)
    //             return redirect('/')->with('success', 'Akun berhasil dihapus!');
    //         } catch (\Exception $e) {
    //             //Jika ada yang salah, rollback transaction
    //             DB::rollBack();
    //             //jika salah, Kembali ke halaman showAccount dengan pesan error
    //             return back()->with('error', 'Error: ' . $e->getMessage());
    //         }
    //     }
    //     //tampillkan pesan error jika $adminID tidak ditemukan di session
    //     return back()->with('error', 'Gagal menghapus akun.');
    // }
}