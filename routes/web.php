<?php

use App\Http\Controllers\ClientPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientPageController::class, 'home'])->name('home');

Route::get('/thanh-toan', function(){return view('client.thanh_toan');})->name('thanh_toan');

Route::get('/tour-chi-tiet', function(){return view('client.tour_chi_tiet');})->name('tour_chi_tiet');