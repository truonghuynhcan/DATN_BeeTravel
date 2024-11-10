<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminTourController;
use App\Http\Controllers\AdminNewController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserTourController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserNgayDiController;
use App\Http\Controllers\UserOrderController;
use Illuminate\Support\Facades\Route;

// ! USER ==================================================================================================================================
Route::get('/', [UserPageController::class, 'home'])->name('home');
Route::get('/gioi-thieu', [UserPageController::class, 'about'])->name('about');
//Route::get('/lien-he', [UserPageController::class, 'contact'])->name('contact');
// SEARCH TOUR TỔNG QUÁT
Route::get('/search-tong-quat', [UserTourController::class, 'fullsearch'])->name('search_tong_quat');
Route::post('/search_tong_quat/search_all', [UserTourController::class, 'Allsearch'])->name('search_tong_quat.search_all');

// * login/register/logout ----------------------------------------------------------------
Route::get('/dang-nhap', [UserPageController::class, 'login'])->name('login');
Route::post('/dang-nhap', [UserLoginController::class, 'login'])->name('login_loading');
Route::get('/dang-ky', [UserPageController::class, 'register'])->name('register');
Route::post('/dang-ky', [UserLoginController::class, 'register'])->name('register_loading');
Route::post('/dangxuat', [UserLoginController::class, 'logout'])->name('dangxuat');


// * Tour ----------------------------------------------------------------
Route::get('/tour', [UserTourController::class, 'tour'])->name('tour');
Route::get('/tour/{slug}', [UserTourController::class, 'chitiet'])->name('chitiet');
Route::get('/tour-chi-tiet/{slug}', [UserTourController::class, 'chitiet'])->name('tour_chi_tiet');
Route::get('/tour/{id}', [UserTourController::class, 'chitietid'])->name('tour_chi_tiet');
Route::get('/tour/price', [UserTourController::class, 'getPrice']);
Route::post('/tour/search', [UserTourController::class, 'searchTours'])->name('tour.search');
Route::get('/tour/filter', [UserTourController::class, 'filter'])->name('tour.filter');
Route::get('/category/{id}', [UserTourController::class, 'showToursByCategory'])->name('tour.category');
Route::get('/tin-tuc/{id}', [UserNewsController::class, 'showNews'])->name('client.tin_tuc_chi_tiet');


// * Thanh toán ----------------------------------------------------------------
Route::get('/thanh-toan/{id_tour}', [UserOrderController::class, 'viewThanhToan'])->name('thanh_toan');
Route::post('/thanh-toan/loading/{tour_id}', [UserOrderController::class, 'thanhToan_'])->name('thanhtoan_');

// * TIN TỨC ----------------------------------------------------------------
Route::get('/news', [UserNewsController::class, 'news'])->name('news');
Route::get('/categories/{category_id}', [UserNewsController::class, 'getNewByCategory'])->name('categories');
Route::get('/tin_tuc_chi_tiet/{category_id}', [UserNewsController::class, 'showNews'])->name('tin_tuc_chi_tiet');


//*LIÊN HỆ
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// * USER ACCOUNT SETTING ----------------------------------------------------------------
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


Route::prefix('api')->group(function(){
    Route::get('/get-price/{date_id}', [UserNgayDiController::class, 'getPrice']);
});



// ! ADMIN ==================================================================================================================================


// * login/register/logout ----------------------------------------------------------------
// show view login form
Route::view('/dang-nhap-doi-tac', 'admin.dang_nhap_doi_tac')->name('login_admin');
// xử lý đăng nhập admin
Route::post('/dang-nhap-doi-tac/loading', [AdminLoginController::class, 'login_admin_'])->name('login_admin_');


Route::view('/dang-ky-doi-tac', 'admin.dang_ky_doi_tac')->name('register_admin');
Route::post('/dang-ky-doi-tac/loading', [AdminLoginController::class, 'register_admin_'])->name('register_admin_');

// * Page admin và provider sau khi đăng nhập thành công
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'admin_or_provider'])->group(function () {
    // Route cho logout admin
    Route::post('/dang-xuat', [AdminLoginController::class, 'logout'])->name('logout');
    
    Route::view('/quan-ly-tour', 'admin.tour')->name('tourManagement');
    Route::view('/them-tour', 'admin.tour_insert')->name('tourInsert');
    Route::post('/them-tour/loading', [AdminTourController::class, 'tourInsert_'])->name('tourInsert_');
    
    Route::view('/quan-ly-tt', 'admin.news')->name('newsManagement');
    Route::view('/them-tt', 'admin.new_insert')->name('newInsert');
    Route::post('/them-tt/loading', [AdminNewController::class, 'newInsert_'])->name('newInsert_');

    Route::view('/quan-ly-dmtt', 'admin.category_new')->name('CateNewsManagement');
    Route::view('/quan-ly-dmtour', 'admin.category_tour')->name('CateToursManagement');

    Route::view('/quan-ly-users', 'admin.users')->name('usersManagement');
    // Provide đối tác
    Route::view('/quan-ly-provide', 'admin.users_provide')->name('providesManagement');
    Route::view('/them-provider', 'admin.provider_insert')->name('providerInsert');
    Route::post('/them-provider/loading', [AdminUsersController::class, 'providerInsert_'])->name('providerInsert_');
    // Person đối tác
    Route::view('/quan-ly-person', 'admin.users_person')->name('personsManagement');
    Route::view('/them-person', 'admin.person_insert')->name('personInsert');
    Route::post('/them-person/loading', [AdminUsersController::class, 'personInsert_'])->name('personInsert_');
    // Admin đối tác
    Route::view('/quan-ly-admin', 'admin.users_admin')->name('adminusersManagement');
    Route::view('/them-admin', 'admin.admin_insert')->name('adminInsert');
    Route::post('/them-admin/loading', [AdminUsersController::class, 'adminInsert_'])->name('adminInsert_');

    Route::get('/sua-tour/{id}', [AdminTourController::class, 'tourEdit'])->name('tourEdit');
    Route::post('/sua-tour/{id}', [AdminTourController::class, 'tourEdit_update'])->name('tourEdit_update');

    Route::get('/sua-tintuc/{id}', [AdminNewController::class, 'newEdit'])->name('newEdit');
    Route::put('/sua-tintuc/{id}', [AdminNewController::class, 'newEdit_update'])->name('newEdit_update');
    // Route::post('/sua-tintuc/loading', [AdminNewController::class, 'newEdit_'])->name('newEdit_');

    // Route::post('/them-tour/loading', [AdminTourController::class, 'tourInsert_'])->name('tourInsert_');

    // Route::get('/quan-ly-tour', [TourController::class, 'quanLyTour'])->name('quanLyTour');
    Route::prefix('/api')->group(function(){
        Route::get('/danh-sach-tour/{admin_id}', [AdminTourController::class,'tours']);
        Route::get('/danh-muc-tour', [AdminCategoryController::class,'index']); // lấy danh mục categories tour
        Route::get('/danh-sach-admin', [AdminController::class,'index']); // lấy danh mục categories tour
        Route::get('/danh-sach-category-tour', [AdminTourController::class,'category_tour']);

         //New Admin
    Route::get('/danh-sach-new/{admin_id}', [AdminNewController::class,'news']);
    Route::get('/danh-muc-new', [AdminCategoryController::class,'index_tt']); // lấy danh mục categories new
    Route::get('/danh-sach-admin', [AdminController::class,'index_tt']); // lấy danh mục categories tour
    Route::get('/danh-sach-category-new', [AdminNewController::class,'category_new']);
        // Admin role user
        Route::get('/danh-sach-useradmin', [AdminUsersController::class, 'getAdmins']);
        Route::get('/danh-sach-user', [AdminUsersController::class, 'getAllUsers']);
        Route::get('/danh-sach-user-provide', [AdminUsersController::class, 'getProviders']);
        Route::get('/danh-sach-person', [AdminUsersController::class, 'getAllPersons']);
        Route::get('/danh-sach-adminusers', [AdminUsersController::class, 'getAdminUsers']);
    });
    
});
// Setup danh mục tin tức





Route::middleware(['login.check'])->group(function () {
    // Các routes trong nhóm này chỉ có thể truy cập nếu người dùng đã đăng nhập
});
//Route sau khi test Auth để đăng ký và đăng nhập