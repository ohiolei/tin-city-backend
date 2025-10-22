<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;

// Public routes with session support for OAuth
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

    // Google OAuth routes with web middleware for session support
    Route::middleware('web')->group(function () {
        Route::get('redirect', [GoogleAuthController::class, 'redirectToGoogle']);
        Route::get('callback', [GoogleAuthController::class, 'handleGoogleCallback']);
    });
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::post('resend-verification', [AuthController::class, 'resendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
});
