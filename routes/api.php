<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserMobileController; 
use App\Http\Controllers\Api\DestinationMobileController; 
use App\Http\Controllers\Api\EventMobileController;
use App\Http\Controllers\Api\TiketMobileController; 

// Route untuk Login Mobile
Route::post('/', [UserMobileController::class, 'login']);
Route::post('/register', [UserMobileController::class, 'register']); 

// Route yang WAJIB menyertakan Token (Harus Login)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [UserMobileController::class, 'logout']);
    
    // Route untuk mengambil data akun
    Route::get('/account', [UserMobileController::class, 'showAccount']);
    
    // Jalur mengubah data profil (Gunakan POST atau PUT)
    Route::post('/account/edit', [UserMobileController::class, 'editProfile']);

    Route::post('/account/delete', [UserMobileController::class, 'deleteAccount']);

    Route::get('/destination', [DestinationMobileController::class, 'tampilCategory']);
    Route::get('/destination/category', [DestinationMobileController::class, 'destinasiByKategori']);
    Route::get('/destination/detail', [DestinationMobileController::class, 'detailDestination']);
    Route::get('/gallery', [DestinationMobileController::class, 'tampilGaleri']);

    Route::get('/event', [EventMobileController::class, 'tampilEvent']);
    Route::get('/event/detail', [EventMobileController::class, 'tampilDetailEvent']);

    Route::get('/MyTicket', [TiketMobileController::class, 'showMyTicket']);

    // --- API PEMBAYARAN ---
    Route::post('/event/checkout/{id}', [\App\Http\Controllers\Api\PaymentMobileController::class, 'checkout']);
    Route::post('/payment/continue/{orderID}', [\App\Http\Controllers\Api\PaymentMobileController::class, 'continuePayment']);
    Route::post('/payment/cancel/{orderID}', [\App\Http\Controllers\Api\PaymentMobileController::class, 'cancelPayment']);
    
    // --- API SCAN TIKET ---
    Route::post('/ticket/scan/{tiketID}', [\App\Http\Controllers\Api\TiketMobileController::class, 'scanTiket']);
    
    
});