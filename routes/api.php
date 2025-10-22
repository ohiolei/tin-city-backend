<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Get authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public login route
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected logout route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Admin routes group
Route::middleware(['auth:sanctum', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});