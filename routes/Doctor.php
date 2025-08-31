<?php

use App\Http\Controllers\Doctor\DoctorAuthController;
use App\Http\Controllers\Doctor\DoctorPasswordController;
use App\Http\Controllers\Doctor\DoctorVreificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('doctor')->group(function () {
    Route::controller(DoctorAuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::middleware('verify:doctor')->post('/login', 'login');
        Route::middleware('auth:sanctum')->post('/logout', 'logout');
    });

    Route::controller(DoctorVreificationController::class)->group(function () {
        Route::post('/verify', 'verifyEmail');
        Route::post('/resend', 'resendCode');
    });

    Route::controller(DoctorPasswordController::class)->group(function () {
        Route::post('/forget', 'forget');
        Route::post('/check', 'check');
        Route::post('/reset', 'reset');
    });
});
