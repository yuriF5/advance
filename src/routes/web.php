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
use App\Http\Controllers\QrCodeController;


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
Route::get('/review/create/{shop_id}', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/{shop_id}', [ReviewController::class, 'store'])->name('review.store');
Route::post('/delete/{review_id}',[ReviewController::class, 'delete']);

// mail
Route::post('/admin/email-notification', [MailController::class, 'sendNotification'])->name('send.notification');
Route::get('/admin/email_send',[MailController::class,'email']);

// admin
Route::get('/admin/board',[AdminController::class,'board']);
Route::get('/admin/create',[AdminController::class,'create']);
Route::post('/add/shop',[ShopController::class,'store']);
Route::get('/admin/update/{shop_id}',[ShopController::class,'show']);
Route::post('/update/shop',[ShopController::class,'update']);
Route::get('/admin/do',[AdminController::class,'do']);
Route::post('/admin/register',[AdminController::class,'register']);
Route::get('/admin/reservation',[AdminController::class,'index']);
Route::get('/qrcode',[QrCodeController::class,'displayQrCode']);