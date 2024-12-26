<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('user', [AuthController::class, 'store']);
    Route::post('auth/login', [AuthController::class, 'loginUser']);
})->middleware('auth');

Route::prefix('v1/auth')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    // Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
})->middleware(UserMiddleware::class);
