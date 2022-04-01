<?php

use App\Contracts\CategoryContract;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [CategoryController::class ,'show'])->name('category.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/shopping_cart', [ProductController::class, 'show_cart'])->name('showCart');
Route::post('/addToCart/{id}', [ProductController::class, 'addToCart'])->name('addToCart');

Route::get('/removeProductFromCart/{id}', [ProductController::class, 'removeProductFromCart'])->name('removeProductFromCart');
Route::post('/updateProductFromCart/{id}', [ProductController::class, 'updateProductFromCart'])->name('updateProductFromCart');


Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');

Route::get('/variant/{id}', [ProductController::class, 'show'])->name('variant.show');

Route::get('/filterProducts', [ProductController::class, 'filter'])->name('product.filter');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');
});

Auth::routes();

require 'admin.php';