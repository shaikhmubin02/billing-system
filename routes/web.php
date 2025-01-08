<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('bills', BillController::class);
