<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('user', [AuthController::class, 'store']);
    Route::post('auth/login', [AuthController::class, 'loginUser']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('product/{slug}', [ProductController::class, 'show']);
})->middleware('auth');

Route::prefix('v1/auth')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware([UserMiddleware::class]);
    Route::post('logout', [AuthController::class, 'logout']);
})->middleware(UserMiddleware::class);
