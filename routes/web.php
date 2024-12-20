<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::prefix('admin')->group(function () {
    // category
    Route::resource('categories', CategoryController::class);
    // end-category

    // user
    Route::resource('users', UserController::class);
    // end-user



    // product
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('add');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
    // end-product


    // user
    Route::resource('vouchers', VoucherController::class);
    // end-user
});

Route::get("/", [HomeController::class, 'index']);


Route::resource('banners', BannerController::class);
Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/product', [HomeController::class, 'product'])->name('product');


Route::get('/cart', [HomeController::class, 'cart'])->name('cart');


Route::get('/product_details/{id}', [HomeController::class, 'detail'])->name('product_details');

// web.php
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view_cart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('apply_discount');
