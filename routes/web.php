<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Merchant;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
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


// welcome generated
// Route::get('/', function () {
//     return view('welcome');
// });

// all role routes

Route::controller(HomeController::class)->name('home.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
});

Route::get('/categories/{id}', [HomeController::class, 'show'])->name('categories.show');
Route::get('/promos/{id}', [PromoController::class, 'index'])->name('promos.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/merchants/{id}', [Merchant\HomeController::class, 'show'])->name('merchant.show');

// guest only routes
Route::middleware('guest')->group(function () {
    // login controllers
    Route::prefix('login')->controller(Auth\LoginController::class)->name('login.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'authenticate')->name('authenticate');
    });

    // register controllers
    Route::prefix('register')->controller(Auth\RegisterController::class)->name('register.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'authenticate')->name('authenticate');
    });

    // login register google controllers
    Route::prefix('auth')->controller(GoogleController::class)->group(function () {
        Route::get('redirect', 'redirect');
        Route::get('callback', 'callback');
    });
});

// authenticated user routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [HomeController::class, 'logout'])->name('logout');

    // prefix chats controllers
    Route::prefix('chats')->controller(ChatController::class)->name('chats.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('redirect/{merchant_id}', 'redirect')->name('redirect');
        Route::get('{room_id}', 'show')->name('show');
        Route::post('{room_id}', 'store')->name('store');
    });

    // cart controllers
    Route::controller(CartController::class)->group(function () {
        Route::get('cart', 'index')->name('cart.index');
        Route::post('cart', 'store')->name('cart.store');
        Route::get('checkout', 'checkout_index')->name('checkout.index');
        Route::post('checkout', 'checkout_store')->name('checkout.store');
        Route::post('bill', 'bill_store')->name('bill.store');
    });

    // profile controllers
    Route::controller(ProfileController::class)->group(function () {
        // prefix general
        Route::prefix('general')->name('general.')->group(function () {
            Route::get('', 'general_index')->name('index');
            Route::put('', 'general_update')->name('update');
        });

        // prefix locations
        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('', 'location_index')->name('index');
            Route::post('', 'location_store')->name('store');
            Route::delete('{id}', 'location_destroy')->name('destroy');
        });

        Route::get('history-transaction', 'history_index')->name('history-transaction.index');

        Route::prefix('following-list')->name('following-list.')->group(function () {
            Route::get('', 'following_index')->name('index');
            Route::post('', 'following_store')->name('store');
            Route::delete('', 'following_destroy')->name('destroy');
        });
    });

    // update transaction / order status by merchant / user
    Route::put('th/{th_id}/pr/{pr_id}/va/{va_id}', [OrderController::class, 'update'])->name('order.update');

    // merchant controllers
    Route::prefix('merchant')->name('merchant.')->group(function () {
        // only user able to register be merchant
        Route::prefix('register')->controller(Merchant\RegisterController::class)->middleware('not.user')->name('register.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
        });

        // only merchant pages
        Route::middleware('not.merchant')->group(function () {
            Route::get('home', [Merchant\HomeController::class, 'index'])->name('index');

            // prefix chats controllers
            Route::prefix('chats')->controller(Merchant\ChatController::class)->name('chats.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{room_id}', 'show')->name('show');
                Route::post('{room_id}', 'store')->name('store');
            });

            // profile controllers
            Route::prefix('profile')->controller(Merchant\ProfileController::class)->name('profile.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::put('', 'update')->name('update');
            });

            Route::get('transactions', [Merchant\TransactionController::class, 'index'])->name('transactions.index');

            Route::get('products', [Merchant\ProductController::class, 'index'])->name('products.index');
            Route::get('products/create', [Merchant\ProductController::class, 'create'])->name('products.create');
            Route::post('products/store', [Merchant\ProductController::class, 'store'])->name('products.store');
            Route::put('products/{id}', [Merchant\ProductController::class, 'update'])->name('products.update');
            Route::delete('products/{id}', [Merchant\ProductController::class, 'destroy'])->name('products.destroy');
            Route::post('products/{product_id}/variants', [Merchant\VariantController::class, 'store'])->name('variants.store');
            Route::put('products/{product_id}/variants/{variant_id}', [Merchant\VariantController::class, 'update'])->name('variants.update');
            Route::delete('products/{product_id}/variants/{variant_id}', [Merchant\VariantController::class, 'destroy'])->name('variants.destroy');
        });
    });
});
