<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;


Route::post('/register',[AuthController::class, 'register']);
Route::get('/thanks',[AuthController::class,'thanks']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/mypage', [AuthController::class, 'mypage']);
});