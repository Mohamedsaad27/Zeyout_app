<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ApiLocalization;

Route::prefix('auth')->middleware(ApiLocalization::class)->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('send-reset-password-code', [AuthController::class, 'sendResetPasswordCode']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('refresh', [AuthController::class, 'refreshToken'])->middleware('auth:sanctum');
    Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
    Route::post('change-password', [AuthController::class, 'changePassword'])->middleware('auth:sanctum');
    Route::post('change-personal-info', [AuthController::class, 'changePersonalInfo'])->middleware('auth:sanctum');
    Route::post('/verify-reset-password-code', [AuthController::class, 'verifyResetPasswordCode']);
    Route::post('/resend-registration-code', [AuthController::class, 'resendRegistrationCode']);
});

