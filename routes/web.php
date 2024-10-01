<?php

use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserTourController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'home'])->name('home');
Route::get('/gioi-thieu', [UserPageController::class, 'about'])->name('about');
Route::get('/lien-he', [UserPageController::class, 'contact'])->name('contact');
Route::get('/tin-tuc', [UserNewsController::class, 'news'])->name('news');

Route::get('/thanh-toan', function(){return view('client.thanh_toan');})->name('thanh_toan');

Route::get('/tour-chi-tiet/{slug}', [UserTourController::class, 'chitiet'])->name('tour_chi_tiet');
// Route::get('/tour-chi-tiet', function(){return view('client.tour_chi_tiet');})->name('tour_chi_tiet');