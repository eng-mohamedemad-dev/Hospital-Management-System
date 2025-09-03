<?php

use App\Http\Controllers\Patient\PatientAuthController;
use App\Http\Controllers\Patient\PatientPasswordController;
use App\Http\Controllers\Patient\PatientVreificationController;
use App\Http\Controllers\Patient\ReviewController;
use App\Http\Controllers\Patient\HomeController;
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

    // resource rout for reviews 
    Route::get('/reviews/{doctor}', [ReviewController::class, 'index']);
    Route::resource('reviews', ReviewController::class)->except(['index']);

    Route::controller(HomeController::class)->group(function () {
        Route::get('/doctors', 'getDoctors');
        Route::get('/specialists', 'getSpecialists');
        Route::get('/search', 'searchDoctors');
        Route::get('/logs', 'getSearchLogs');
    });
});
