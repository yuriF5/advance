<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

// ログイン認証がない場合
Route::get('/', [ShopController::class, 'index']);

//  ログイン認証ある場合
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);});