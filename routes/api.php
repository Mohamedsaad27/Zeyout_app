<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require base_path('routes/auth.php');

Route::prefix('categories')->middleware('localization')->group(function () {    
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
});

Route::prefix('brands')->middleware('localization')->group(function () {    
    Route::get('/getAllBrands', [BrandController::class, 'getAllBrands']);
    Route::get('/getBrandById/{id}', [BrandController::class, 'getBrandById']);
});

Route::prefix('products')->middleware(['auth:sanctum', 'localization'])->group(function () {    
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
});