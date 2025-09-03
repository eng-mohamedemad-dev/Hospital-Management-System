<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\ProfileController;
use App\Http\Controllers\Doctor\DoctorAuthController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorPasswordController;
use App\Http\Controllers\Doctor\DoctorVreificationController;
use App\Http\Controllers\Doctor\AddessController;

Route::prefix('doctor')->group(function ()
{
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



        Route::prefix('profile')->group(function()
        {
            Route::controller(ProfileController::class)->middleware('auth:sanctum')->group(function ()
            {
                Route::get('/', 'showProfile');
                Route::put('/', 'updateProfile');
                Route::delete('/', 'deleteAccount');
            });
        });

        Route::prefix('appointments')->group(function()
        {
            Route::controller(AppointmentController::class)->middleware('auth:sanctum')->group(function ()
            {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });
        Route::controller(AddessController::class)->group(function () {
            Route::put('/address', 'update');
            Route::delete('/address', 'destroy');
        });
        Route::resource('address', AddessController::class)->except(['show','update','destroy']);

});
