<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VnpayController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Quản lý tất cả các tài nguyên chỉ dành cho Admin
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('banners', BannerController::class);
});

// Route dành cho Manager (có thể quản lý sản phẩm, vouchers và banners)
Route::prefix('admin')->middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('banners', BannerController::class);
});

// Route dành cho Staff (chỉ có quyền quản lý banners)
Route::prefix('admin')->middleware(['auth', 'role:admin,manager,staff'])->group(function () {
    Route::resource('banners', BannerController::class);
});



Route::get("/", [HomeController::class, 'index']);


Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/product', [HomeController::class, 'product'])->name('product');


Route::get('/cart', [HomeController::class, 'cart'])->name('cart');


Route::get('/product_details/{id}', [HomeController::class, 'detail'])->name('product_details');

// web.php
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view_cart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('apply_discount');


Route::get('register', [RegisterController::class, 'showForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('activate/{email}', [RegisterController::class, 'activate'])->name('user.activate');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');




Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');




Route::get('/profile/edit', [LoginController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [LoginController::class, 'updateProfile'])->name('profile.update');


Route::get('/password/change', [LoginController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/password/update', [LoginController::class, 'updatePassword'])->name('password.update');
