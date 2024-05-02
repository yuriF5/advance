<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CsvController;

// simple 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

// auth
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mypage', [AuthController::class, 'mypage'])->name('mypage');
});

// shop
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/search', [ShopController::class, 'search'])->name('search');

// Reservation
Route::prefix('reservation')->group(function () {
    Route::post('/store/{shop}', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/edit/{reservation}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::get('/done',  [ReservationController::class, 'done'])->name('reservation.done');
});

// Favorites
Route::post('/favorite/store/{shop}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/destroy/{shop}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

// Mypage
Route::get('/mypage', [MyPageController::class, 'mypage'])->name('mypage');
Route::post('/mypage/favorite/{shopId}', [MyPageController::class, 'updateFavorite'])->name('user.favorite.update');
Route::delete('/reservations/{reservation}', [MyPageController::class, 'destroy'])->name('reservation.destroy');

// csv
Route::get('/csv', [CsvController::class, 'csv_index'])->name('csv.csv_index');
Route::post('/csv/upload', [CsvController::class, 'upload'])->name('csv.upload');


// review
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
Route::get('/thanks_review', [ReviewController::class, 'thanks'])->name('review.thanks');

