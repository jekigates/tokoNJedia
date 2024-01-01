<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Merchant;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/login', [Auth\LoginController::class, 'index'])->name('login.index');
Route::post('/login', [Auth\LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [Auth\RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [Auth\RegisterController::class, 'authenticate'])->name('register.authenticate');
Route::post('/logout', [HomeController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/auth/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/callback', [GoogleController::class, 'callback']);

Route::get('/promos/{id}', [PromoController::class, 'index'])->name('promos.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/cart', [CartController::class, 'store'])->middleware('auth')->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
Route::get('/checkout', [CartController::class, 'checkout_index'])->middleware('auth')->name('checkout.index');
Route::post('/checkout', [CartController::class, 'checkout_store'])->middleware('auth')->name('checkout.store');
Route::post('/bill', [CartController::class, 'bill_store'])->middleware('auth')->name('bill.store');

Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('/general', [ProfileController::class, 'general'])->middleware('auth')->name('general.index');
Route::put('/general', [ProfileController::class, 'general_update'])->middleware('auth')->name('general.update');

Route::get('/locations', [ProfileController::class, 'location'])->middleware('auth')->name('locations.index');
Route::post('/locations', [ProfileController::class, 'location_store'])->middleware('auth')->name('locations.store');
Route::delete('/locations/{id}', [ProfileController::class, 'location_destroy'])->middleware('auth')->name('locations.destroy');

Route::get('/history-transaction', [ProfileController::class, 'history'])->middleware('auth')->name('history-transaction.index');
Route::get('/following-list', [ProfileController::class, 'following'])->middleware('auth')->name('following-list.index');

Route::put('/th/{th_id}/pr/{pr_id}/va/{va_id}', [OrderController::class, 'update'])->middleware('auth')->name('order.update');
Route::get('/merchant/register', [Merchant\RegisterController::class, 'index'])->middleware(['auth', 'not.user'])->name('merchant.register.index');
Route::post('/merchant/register', [Merchant\RegisterController::class, 'store'])->middleware(['auth', 'not.user'])->name('merchant.register.store');

Route::get('/merchants/{id}', [Merchant\HomeController::class, 'show'])->name('merchant.show');

Route::get('/merchant/home', [Merchant\HomeController::class, 'index'])->middleware(['auth', 'not.merchant'])->name('merchant.index');
Route::get('/merchant/profile', [Merchant\ProfileController::class, 'index'])->middleware(['auth', 'not.merchant'])->name('merchant.profile.index');
Route::put('/merchant/profile', [Merchant\ProfileController::class, 'update'])->middleware(['auth', 'not.merchant'])->name('merchant.profile.update');
Route::get('/merchant/transactions', [Merchant\TransactionController::class, 'index'])->middleware(['auth', 'not.merchant'])->name('merchant.transactions.index');
