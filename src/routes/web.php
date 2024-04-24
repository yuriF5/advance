<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/mypage', [AuthController::class, 'mypage']);
    Route::get('/done', [ReservationController::class, 'done']);
});