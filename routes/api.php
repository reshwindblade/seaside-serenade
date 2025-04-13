<?php

use App\Http\Controllers\Api\{
    AuthController,
    UserController
};
use Illuminate\Support\Facades\Route;

// Public Authentication Routes
Route::post('/login', [AuthController::class, 'login']);

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {
    // Authentication Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // User Management Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
    });
    
    // User Profile Route
    Route::get('/profile', function (Request $request) {
        return response()->json([
            'data' => $request->user()
        ]);
    });
});