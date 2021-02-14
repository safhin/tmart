<?php

use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\ShopPageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ConfirmationController;
use App\Http\Controllers\Frontend\CuponController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landingPage');
Route::get('/shop', [ShopPageController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopPageController::class, 'show'])->name('shop.show');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::post('/cupon', [CuponController::class, 'store'])->name('cupon.store');
Route::delete('/cupon', [CuponController::class, 'destroy'])->name('cupon.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thankyou', [ConfirmationController::class,'index'])->name('confirmation.index');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
