<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([GuestMiddleware::class])->prefix('v1')->group(function () {
    Route::post('user', [AuthController::class, 'store']);
    Route::post('auth/login', [AuthController::class, 'loginUser']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('product/{slug}', [ProductController::class, 'show']);
    Route::post('/cart/add-product/{productId}', [CartController::class, 'addProductToCart']);
});

Route::middleware([UserMiddleware::class])->prefix('v1/auth')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware([UserMiddleware::class]);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/cart/add-product/{productId}', [CartController::class, 'addProductToCart']);
});
