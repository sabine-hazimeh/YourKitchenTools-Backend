<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\ProductController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
});
// Route::middleware(['auth:api','checkAuth','admin'])->group(function () {
// Route::apiResource('products', ProductController::class);
// });
Route::get('products', [ProductController::class, 'index']);  
Route::get('products/{product}', [ProductController::class, 'show']);
Route::middleware(['auth:api', 'checkAuth', 'admin'])->group(function () {
    Route::post('products', [ProductController::class, 'store']); 
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
});