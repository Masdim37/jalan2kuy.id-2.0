<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\DestCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserBiasaController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PaymentController;

//Note:
//Method GET digunakan untuk mengambil atau menampilkan data/halaman. Tidak mengubah data di server.
//Method POST digunakan untuk mengirim data baru ke server (biasanya dari form).
//Method PUT atau PATCH digunakan untuk memperbarui (update) data yang sudah ada secara keseluruhan.
//Method DELETE digunakan untuk menghapus data dari server.

Route::get('/', [UserBiasaController::class, 'Showlogin']);

Route::post('/login', [UserBiasaController::class, 'login']);

Route::get('/register', function () {
    return view('akun.registrasiAkun');
});

Route::post('/register-proses', [UserBiasaController::class, 'register']);

// Lupa Password Routes
Route::get('/lupaPass', [UserBiasaController::class, 'tampilFormLupaPass'])->name('lupa.password');
Route::post('/lupaPassProses', [UserBiasaController::class, 'prosesKirimOtp']);
Route::get('/resend-otp',  [UserBiasaController::class, 'resendOtp']);
Route::get('/otp-timer-reset', [UserBiasaController::class,'otpTimerReset']);
Route::get('/verifikasi-otp', [UserBiasaController::class, 'tampilFormOtp'])->name('verifikasi.otp');
Route::post('/verifikasi-otp-proses', [UserBiasaController::class, 'prosesVerifikasiOtp']);
Route::get('/reset-password', [UserBiasaController::class, 'tampilFormReset'])->name('reset.password');
Route::post('/reset-password-proses', [UserBiasaController::class, 'prosesUpdatePassword']);

Route::get('/Homepage', function () {
    //Cek apakah user sudah melewati tahap login awal atau belum
    if (!session()->has('user_id')) {
        return redirect('/login')->with('error', 'Anda harus login dulu!');
    }
    return view('homepage');
});


//Alur Destination (User Biasa) (Start)
//route halaman Utama Destination (Method: GET)
Route::get('/Destination', [DestCategoryController::class, 'tampilCategory']);

//route halaman Kategori Destination (Method: GET)
Route::get('/Destination/Category', [DestCategoryController::class, 'category']);

//route halaman detail destination (Method: GET)
Route::get('/Destination/Detail/{id}', [DestinationController::class, 'tampilkanDetailDestination']);
//Alur Destination (User Biasa) (End)

//Alur Event (User Biasa) (Start)
//route halaman Utama Event (Method: GET)
Route::get('/Event', [EventController::class, 'tampilEvent']);

//route halaman detail event (Method: GET)
Route::get('/Event/Detail/{id}', [EventController::class, 'tampilkanDetailEvent']);
//Alur Event (User Biasa) (End)

Route::get('/BeliTiket/{id}', [UserBiasaController::class, 'TampilBeliTiket']);

// Tampilkan Tiket (Pastikan fungsi showMyTicket di TiketController cuma nampilin yg tiketStatus == 1 ya)
Route::get('/MyTiket', [TiketController::class, 'showMyTicket']);

// Proses Buat Order & Tampilkan Tombol Bayar
Route::post('/checkout/{id}', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');

// Halaman Redirect setelah dari Midtrans
Route::get('/payment/success/{orderID}', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed/{orderID}', [\App\Http\Controllers\PaymentController::class, 'failed'])->name('payment.failed');

// Route Callback/Webhook (Jalur belakang untuk update database otomatis)
Route::post('/api/midtrans-callback', [\App\Http\Controllers\PaymentController::class, 'callback']);

//route halaman Utama gallery (Method: GET)
Route::get('/Gallery', [DestinationController::class, 'tampilGaleri']);

Route::get('/Account', [UserBiasaController::class, 'showAccount']);

//route halaman form edit account admin (Method: GET)
Route::get('/Edit-Profile', [UserBiasaController::class, 'tampilFormEditProfile']);

//route untuk proses simpan update account admin (Method: PUT)
Route::put('/Update-Profile', [UserBiasaController::class, 'editProfile']);

Route::delete('/delete-account', [UserBiasaController::class, 'deleteAccount']);

//route halaman passkey (Method: GET)
Route::get('/verifikasi-login', [AdminController::class, 'showVerifikasiLogin']);

//route proses logout (Method: POST)
Route::post('/logout', [UserBiasaController::class, 'logout']);

//route proses verifikasi passkey (Method: POST)
Route::post('/verifikasi-login-proses', [AdminController::class, 'prosesVerifikasiLogin']);
//Alur Login (End)














////===ROUTE-ROUTE DIBAWAH INI KHUSUS ADMIN ONLY===

//route group admin (Hanya bisa diakses jika sudah login)
Route::prefix('admin')->group(function () {
    //Alur Login (Start)
    //route halaman login (Method: GET)
    Route::get('/login', function () {
        return view('admin.loginAdmin');
    })->name('login');

    //route proses login (Method: POST)
    Route::post('/login-proses', [AdminController::class, 'login']);

    //route halaman passkey (Method: GET)
    Route::get('/verifikasi-login', [AdminController::class, 'showVerifikasiLogin']);

    //route proses verifikasi passkey (Method: POST)
    Route::post('/verifikasi-login-proses', [AdminController::class, 'prosesVerifikasiLogin']);
    //Alur Login (End)

    //route halaman homepage admin (Method: GET)
    Route::get('/Homepage', function () {
        //Cek apakah user sudah melewati tahap login awal atau belum
        if (!session()->has('admin_id')) {
            return redirect('/login')->with('error', 'Anda harus login dulu!');
        }
        return view('admin.homepageAdmin');
    });

    //Alur Destination (User Admin) (Start)
    //route halaman Utama Destination Admin (Method: GET)
    Route::get('/Destination', [DestCategoryController::class, 'tampilCategoryAdmin']);

    //route halaman Kategori Destination admin (Method: GET)
    Route::get('/Destination/Category', [DestCategoryController::class, 'categoryAdmin']);

    //route halaman detail destination admin (Method: GET)
    Route::get('/Destination/Detail/{id}', [DestinationController::class, 'tampilkanDetailDestinationAdmin']);

    //route untuk menampilkan Form addDestination admin (Method: GET)
    Route::get('Destination/AddDestination', [DestinationController::class, 'addDestination']);

    //Route untuk menyimpan Data addDestination ke Database admin (Method: POST)
    Route::post('/Destination/Store', [DestinationController::class, 'storeDestinationData']);

    //route halaman form edit destination admin (Method: GET)
    Route::get('/Destination/Edit/{id}', [DestinationController::class, 'tampilFormEditDestination']);

    //route untuk proses simpan update destination admin (Method: PUT)
    Route::put('/Destination/Update/{id}', [DestinationController::class, 'editDestination']);

    //route untuk proes delete destination admin (Method: DELETE)
    Route::delete('/Destination/Delete/{id}', [DestinationController::class, 'deleteDestination']);
    //Alur Destination (User Admin) (End)

    //Alur Event (User Admin) (Start)
    //route halaman Utama Event Admin (Method: GET)
    Route::get('/Event', [EventController::class, 'tampilEventAdmin']);

    //route halaman detail event admin (Method: GET)
    Route::get('/Event/Detail/{id}', [EventController::class, 'tampilkanDetailEventAdmin']);

    //route halaman form add event admin (Method: GET)
    Route::get('/event/create', [EventController::class, 'addEvent']);

    //Route untuk menyimpan Data addEvent ke Database admin (Method: POST)
    Route::post('/Event/store', [EventController::class, 'storeEventData']);

    //route halaman form edit event admin (Method: GET)
    Route::get('/Event/Edit/{id}', [EventController::class, 'tampilFormEditEvent']);

    //route untuk proses simpan update event admin (Method: PUT)
    Route::put('/Event/Update/{id}', [EventController::class, 'editEvent']);

    //route untuk proes delete event admin (Method: DELETE)
    Route::delete('/Event/Delete/{id}', [EventController::class, 'hapusEvent']);
    //Alur Event (User Admin) (End)

    //route halaman Utama gallery Admin (Method: GET)
    Route::get('/Gallery', [DestinationController::class, 'tampilGaleriAdmin']);

    //Alur account (User Admin) (Start)
    //route halaman Utama account Admin (Method: GET)
    Route::get('/Account', [AdminController::class, 'showAccount']);

    //route halaman form edit account admin (Method: GET)
    Route::get('/Edit-Profile', [AdminController::class, 'tampilFormEditProfile']);

    //route untuk proses simpan update account admin (Method: PUT)
    Route::put('/Update-Profile', [AdminController::class, 'editProfile']);
    
    //route untuk proes delete account admin (Method: DELETE)
    Route::delete('/delete-account', [AdminController::class, 'deleteAccount']);
    //Alur account (User Admin) (End)
});

// Alur Lupa Password (Start)
// 1. Halaman input email

// Alur Lupa Password (End)