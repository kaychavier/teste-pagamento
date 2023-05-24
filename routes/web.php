<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Public\ClientController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\PurchaseController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/clients', ClientController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/purchases', PurchaseController::class);
});
