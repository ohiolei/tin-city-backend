<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AdminController;

Route::prefix('v1')->group(function () {
    Route::prefix('routes')->group(function () {
        // Public endpoints
        Route::get('export', [RouteController::class, 'export']);
        Route::get('', action: [RouteController::class, 'index']);
        Route::get('{id}', [RouteController::class, 'show']);

        // Admin-only endpoints
        Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
            Route::post('', [RouteController::class, 'store']);
            Route::put('{route}', [RouteController::class, 'update']);
            Route::delete('{route}', [RouteController::class, 'destroy']);
        });
    });
    Route::prefix('badges')->group(function () {
        Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
            // Badge endpoints for Admin
            Route::get('', [BadgeController::class, 'index']);
            Route::post('', [BadgeController::class, 'store']);
            Route::get('{id}', [BadgeController::class, 'show']);
            Route::put('{badge}', [BadgeController::class, 'update']);
            Route::delete('{badge}', [BadgeController::class, 'destroy']);
        });
    });

    // Admin dashboard and management endpoints
    Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
        Route::get('admin/contributions', [AdminController::class, 'contributions']);
        Route::get('admin/routes', [AdminController::class, 'routes']);
        Route::get('admin/users', [AdminController::class, 'users']);
    });

    // To test for admin and regular users Gate::define('is_admin', fn(User $user) => $user->role === 'admin');
    Route::post('login', [RouteController::class, 'login']);

    Route::prefix('notifications')->group(function () {
        Route::post('test', [NotificationController::class, 'testNotification']);
    });
});
