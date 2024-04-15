<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);});
    Route::get('/logout', [AuthController::class, 'logout']);