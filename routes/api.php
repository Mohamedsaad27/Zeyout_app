<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TraderController;

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

Route::prefix('favorite')->middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::post('/', [FavoriteController::class, 'addProductToFavorite']);
    Route::post('/remove-product-from-fav', [FavoriteController::class, 'RemoveProductFromFavorite']);
    Route::get('/', [FavoriteController::class, 'getFavoriteProducts']);
});

Route::prefix('traders')->middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::get('/', [TraderController::class, 'getTrades']);
    Route::get('/{id}', [TraderController::class, 'getTraderDetails']);
    Route::get('/search', [TraderController::class, 'searchOnTraders']);
});

Route::get('products/filter', [ProductController::class, 'filterProducts'])->middleware('localization');