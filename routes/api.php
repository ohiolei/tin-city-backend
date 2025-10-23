<?php


use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;



// Get authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');;



// })->middleware('auth:sanctum');


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
    Route::prefix('notifications')->group(function () {
        Route::post('test', [NotificationController::class, 'testNotification']);
    });

    // Public login route (under v1 prefix)
    Route::post('login', [AuthController::class, 'login'])->name('login');

    // Protected logout route (under v1 prefix)
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Admin routes group (use admin prefix)
Route::prefix('admin')->middleware(['auth:sanctum', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index']);
});


});

