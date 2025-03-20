<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\WishlistController;

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
Route::middleware(['auth:api','checkAuth'])->group(function () {
    Route::apiResource('cart', CartController::class);
    Route::apiResource('/cart-items', CartItemsController::class);
    Route::get('/cart-items/cart/{cart_id}', [CartItemsController::class, 'getItemsByCartId']);
    Route::get('/CartByUser/{Id}', [CartController::class, 'getCartForUser']);
    Route::apiResource('/wishlist', WishlistController::class);
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/wishlist', [WishlistController::class, 'index']); // Get wishlist items
//     Route::post('/wishlist', [WishlistController::class, 'store']); // Add to wishlist
//     Route::delete('/wishlist/{product_id}', [WishlistController::class, 'destroy']); // Remove from wishlist
// });


