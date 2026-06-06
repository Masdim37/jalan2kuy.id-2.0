<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthMobileController; 

// Route untuk Login Mobile
Route::post('/', [AuthMobileController::class, 'login']);

// Contoh route yang dilindungi (Hanya bisa diakses jika di Flutter mengirimkan Token yang valid)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});