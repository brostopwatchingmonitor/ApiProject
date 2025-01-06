<?php

use App\Http\Controllers\ProductPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [ProductPageController::class, 'index']);
// tambahan