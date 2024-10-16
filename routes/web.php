<?php
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserTourController;
use Illuminate\Support\Facades\Route;

// !USER ==================================================================================================================================
Route::get('/', [UserPageController::class, 'home'])->name('home');
Route::get('/gioi-thieu', [UserPageController::class, 'about'])->name('about');
Route::get('/lien-he', [UserPageController::class, 'contact'])->name('contact');

// *login/register/logout
Route::get('/dang-nhap', [UserPageController::class, 'login'])->name('login');
Route::post('/dang-nhap',[UserLoginController::class,'login'])->name('login');
Route::get('/dang-ky', [UserPageController::class, 'register'])->name('register');
Route::post('/dang-ky',[UserLoginController::class,'register'])->name('register');
Route::post('/dangxuat',[UserLoginController::class,'logout'])->name('dangxuat');

// *Tour
Route::get('/tour', [UserTourController::class, 'tour'])->name('tour');
Route::get('/tour/{id}', [UserTourController::class,'chitiet'])->name('chitiet');
Route::get('/tour-chi-tiet/{slug}', [UserTourController::class, 'chitiet'])->name('tour_chi_tiet');

// *Thanh toán
Route::get('/thanh-toan', function(){return view('client.thanh_toan');})->name('thanh_toan');

// *TIN TỨC
Route::get('/tin-tuc', [UserNewsController::class, 'news'])->name('news');

// *USER ACCOUNT SETTING
//Route áp dụng được quyền sử dụng sau khi đã đăng nhập tài khoản
// Route::middleware(['login.check'])->group(function () {
    // Các routes trong nhóm này chỉ có thể truy cập nếu người dùng đã đăng nhập
    // });
Route::prefix('tai-khoan')->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserAccountController::class, 'myProfileView'])->name('myProfile');
    Route::get('/ngan-hang', [UserAccountController::class, 'myPaymentView'])->name('myPayment');
    Route::get('/cai-dat-thong-bao', [UserAccountController::class, 'settingNotificationView'])->name('settingNotification');
    Route::get('/bao-mat', [UserAccountController::class, 'settingSecurityView'])->name('settingSecurity');
    
    Route::get('/tour-cua-toi', [UserAccountController::class, 'myTourView'])->name('myTour');

    Route::get('/thong-bao', [UserAccountController::class, 'settingNotificationsOrderView'])->name('settingNotificationsOrder');
});



// !ADMIN ==================================================================================================================================

// *login/register/logout
Route::get('/admin', 'AdminController@index')->middleware('login.check');
//Route sau khi test Auth để đăng ký và đăng nhập
Route::view('/admin','client.admin')->name('admin')->middleware('login.check');
Route::get('/dang-nhap-doi-tac', function (){ return view('client.dang_nhap');})->name('auth.login');
// Route::get('/dang-nhap-dl', function (){ return view('client.dang_nhap_dl');})->name('auth.login');
Route::get('/dang-ky-doi-tac', function (){ return view('client.dang_ky');})->name('auth.register');

Route::get('/dang-nhap-dl', [UserPageController::class, 'login_dl'])->name('login_dl'); // đăng nhập cho đại lý
Route::post('/dang-nhap-dl',[UserLoginController::class,'login_dl'])->name('login_dl');
