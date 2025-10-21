<?php

use App\Http\Controllers\BadgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
