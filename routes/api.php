<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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


    // To test for admin and regular users Gate::define('is_admin', fn(User $user) => $user->role === 'admin');
    Route::post('login', [RouteController::class, 'login']);

    Route::prefix('notifications')->group(function () {
        Route::post('test', [NotificationController::class, 'testNotification']);
    });
});
