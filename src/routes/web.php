<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');
Route::post('/favorite', [FavoriteController::class,'toggleFavorite'])->name('favorite.toggle');


Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mypage', [AuthController::class, 'mypage'])->name('mypage');
   
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/detail/{shop_id}', 'detail');
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
});

Route::prefix('reservation')->controller(ReservationController::class)->group(function () {
        Route::post('/store/{shop}', 'store')->name('reservation');
        Route::get('/edit/{reservation}', 'edit')->name('reservation.edit');
        Route::get('/done',  'done')->name('reservation.done');
    });