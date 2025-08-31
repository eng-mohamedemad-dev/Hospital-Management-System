<?php

use App\Http\Controllers\Patient\PatientAuthController;
use App\Http\Controllers\Patient\PatientPasswordController;
use App\Http\Controllers\Patient\PatientVreificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('patient')->group(function () {
    Route::controller(PatientAuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::middleware('verify:patient')->post('/login', 'login');
        Route::middleware('auth:sanctum')->post('/logout', 'logout');
    });

    Route::controller(PatientVreificationController::class)->group(function () {
        Route::post('/verify', 'verifyEmail');
        Route::post('/resend', 'resendCode');
    });

    Route::controller(PatientPasswordController::class)->group(function () {
        Route::post('/forget', 'forget');
        Route::post('/check', 'check');
        Route::post('/reset', 'reset');
    });
});
