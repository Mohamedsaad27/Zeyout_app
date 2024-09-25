<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->group(function () {
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'index'])->name('dashboard.index');