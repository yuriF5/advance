<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\EmailVerificationController;


Route::get('/',[AuthController::class,'index']);
Route::get('/auth/register',[AuthController::class,'store']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/login',[AuthController::class,'login']);
Route::get('/auth/thanks', [AuthController::class, 'thanks']);
Route::controller(EmailVerificationController::class)
	->prefix('email')->name('verification.')->group(function () {
		Route::get('verify', 'index')->name('notice');
		Route::post('verification-notification', 'notification')
			->middleware('throttle:6,1')->name('send');
		Route::get('verification/{id}/{hash}', 'verification')
			->middleware(['signed', 'throttle:6,1'])->name('verify');
	});
Route::middleware(['web', 'verified', 'auth']);

// auth
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/my_page', [AuthController::class, 'my_page'])->name('my_page');
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
    Route::get('/edit/reservation/{reservation}', 'edit')->name('reservation.edit');
    Route::post('/update/reservation/{id}','update')->name('reservation.update');
    Route::get('/done','done')->name('done');
    });

// Favorites
Route::controller(FavoriteController::class)->group(function () {
    Route::post('/favorite/store/{shop}', 'store')->name('favorite');
    Route::delete('/favorite/destroy/{shop}', 'destroy')->name('unfavorite');
    });

// My_page
Route::controller(MyPageController::class)->group(function () {
    Route::get('/my_age', 'my_page')->name('my_page');
    Route::post('/my_page/favorite/{shopId}', 'updateFavorite')->name('user.favorite.update');
    Route::delete('/reservations/{reservation}', 'destroy')->name('reservation.destroy');
    Route::get('/code','showQrCode');

});

// review
Route::get('/review/create/{shop_id}', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/{shop_id}', [ReviewController::class, 'store'])->name('review.store');
Route::post('/delete/{review_id}',[ReviewController::class, 'delete']);

// mail
Route::post('/send-notification', [MailController::class, 'sendNotification'])->name('send.notification');
Route::get('/admin/email_send',[MailController::class,'email']);

// admin
Route::get('/admin/board',[AdminController::class,'board']);
Route::get('/admin/create',[AdminController::class,'create']);
Route::post('/add/shop',[ShopController::class,'store']);
Route::get('/admin/update/{shop_id}',[ShopController::class,'show']);
Route::post('/update/shop',[ShopController::class,'update']);
Route::get('/admin/done',[ShopController::class,'done']);
Route::get('/admin/do',[AdminController::class,'do']);
Route::post('/admin/register',[AdminController::class,'register']);
Route::get('/admin/reservation', [AdminController::class, 'index'])->name('admin.reservation');

// peyment
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/create',[PaymentController::class,'create'])->name('create');
    Route::post('/store',[PaymentController::class,'store'])->name('store');
});
Route::get('/payment/com', [PaymentController::class,'com'])->name('com');