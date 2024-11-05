<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TraderController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\GovernateController;

Route::get('/', function () {
    return view('admin.auth.login');
});


Route::prefix('dashboard')->group(function () {
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('traders', TraderController::class);
    Route::resource('governates', GovernateController::class);
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'index'])->name('dashboard.index');
Route::post('/add-variant', [ProductController::class, 'addVariant'])->name('add-variant');