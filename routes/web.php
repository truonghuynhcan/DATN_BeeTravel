<?php

use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserTourController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'home'])->name('home');
Route::get('/gioi-thieu', [UserPageController::class, 'about'])->name('about');
Route::get('/lien-he', [UserPageController::class, 'contact'])->name('contact');


// TIN TỨC
Route::get('/tin-tuc', [UserNewsController::class, 'news'])->name('news');


// USER ACCOUNT SETTING
Route::prefix('tai-khoan')->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserAccountController::class, 'myProfileView'])->name('myProfile');
    Route::get('/ngan-hang', [UserAccountController::class, 'myPaymentView'])->name('myPayment');
    Route::get('/cai-dat-thong-bao', [UserAccountController::class, 'settingNotificationView'])->name('settingNotification');
    Route::get('/bao-mat', [UserAccountController::class, 'settingSecurityView'])->name('settingSecurity');
    
    Route::get('/tour-cua-toi', [UserAccountController::class, 'myTourView'])->name('myTour');

    Route::get('/thong-bao', [UserAccountController::class, 'settingNotificationsOrderView'])->name('settingNotificationsOrder');
});







Route::get('/thanh-toan', function(){return view('client.thanh_toan');})->name('thanh_toan');

Route::get('/tour-chi-tiet/{slug}', [UserTourController::class, 'chitiet'])->name('tour_chi_tiet');
// Route::get('/tour-chi-tiet', function(){return view('client.tour_chi_tiet');})->name('tour_chi_tiet');