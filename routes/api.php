<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::prefix('v1')->group(function () {
    // Public endpoints
    Route::get('routes/export', [RouteController::class, 'export']);
    Route::get('routes', [RouteController::class, 'index']);
    Route::get('routes/{id}', [RouteController::class, 'show']);

    // Admin-only endpoints
    Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
        Route::post('routes', [RouteController::class, 'store']);
        Route::put('routes/{route}', [RouteController::class, 'update']);
        Route::delete('routes/{route}', [RouteController::class, 'destroy']);
    });

    // To test for admin and regular users Gate::define('is_admin', fn(User $user) => $user->role === 'admin');
    Route::post('login', [RouteController::class, 'login']);

    Route::prefix('notifications')->group(function () {
        Route::post('test', [NotificationController::class, 'testNotification']);
    });

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
});
