<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AdminController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Badge Management Routes (Admin Only)
Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
    Route::apiResource('badges', BadgeController::class);
});

// User Badge Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/badges', function (Request $request) {
        return $request->user()->badges;
    });
});


// for admin only

Route::middleware(['auth:sanctum', 'can:is_admin'])->group(function () {
    Route::get('/admin/contributions', [AdminController::class, 'contributions']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
   
});



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
});
