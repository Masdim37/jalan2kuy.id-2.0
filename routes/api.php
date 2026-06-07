<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserMobileController; 
use App\Http\Controllers\Api\DestinationMobileController; 

// Route untuk Login Mobile
Route::post('/', [UserMobileController::class, 'login']);

// Route yang WAJIB menyertakan Token (Harus Login)
Route::middleware('auth:sanctum')->group(function () {
    
    // Route untuk mengambil data akun
    Route::get('/account', [UserMobileController::class, 'showAccount']);
    
    // Jalur mengubah data profil (Gunakan POST atau PUT)
    Route::post('/account/edit', [UserMobileController::class, 'editProfile']);

    Route::get('/destination', [DestinationMobileController::class, 'tampilCategory']);
    Route::get('/destination/category', [DestinationMobileController::class, 'destinasiByKategori']);
});