<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


Route::post('/login', [AuthController::class, 'login'])->middleware(['throttle:5,1']);
Route::post('/register', [AuthController::class, 'register'])->middleware(['throttle:10,2']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    
    Route::get('/categories', [CategoryController::class, 'index']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('products', ProductController::class)->except(['index','store']);
    });
});
