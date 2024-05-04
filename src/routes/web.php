<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;


// simple 
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

// auth
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mypage', [AuthController::class, 'mypage'])->name('mypage');
});

// shop
Route::controller(ShopController::class)->group(function () {
    Route::get('/detail/{shop_id}', 'detail');
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
});

// Reservation
Route::prefix('reservation')->controller(ReservationController::class)->group(function () {
    Route::post('/store/{shop}', 'store')->name('reservation');
    Route::get('/edit/{reservation}', 'edit')->name('reservation.edit');
    Route::get('/done',  'done')->name('done');
    });

// Favorites
Route::controller(FavoriteController::class)->group(function () {
    Route::post('/favorite/store/{shop}', 'store')->name('favorite');
    Route::delete('/favorite/destroy/{shop}', 'destroy')->name('unfavorite');
    });

// Mypage
Route::controller(MyPageController::class)->group(function () {
    Route::get('/mypage', 'mypage')->name('mypage');
    Route::post('/mypage/favorite/{shopId}', 'updateFavorite')->name('user.favorite.update');
    Route::delete('/reservations/{reservation}', 'destroy')->name('reservation.destroy');
});

// csv
Route::controller(CsvController::class)->group(function () {
    Route::get('/csv', 'csv_index')->name('csv_index');
    Route::post('/csv/upload', 'upload')->name('csv.upload');
});

// review
Route::get('/shop/{shop_id}', [ReviewController::class, 'show'])->name('shop.show');
Route::get('/review/create/{shop_id}', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/{shop_id}', [ReviewController::class, 'store'])->name('review.store');
Route::get('/reviewer', [ReviewController::class, 'thanks'])->name('reviewer');
Route::post('/delete/{review_id}',[ReviewController::class, 'delete']);

// mail
Route::post('/admin/email-send', [MailController::class, 'send'])->name('send');


Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
    Route::post('/register/shopRepresentative', [AdminController::class, 'register'])->name('admin.register');
    Route::get('/admin/register',[AdminController::class, 'register'])->name('admin.register');
