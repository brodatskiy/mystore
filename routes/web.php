<?php

use App\Http\Controllers\Client\WishController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CatalogController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MessageController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\SetLocaleController;
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

Route::post('/locale', [SetLocaleController::class, 'locale'])->name('locale');

//Shop
Route::get('/',  HomeController::class)->name('/');
Route::get('/wish', [WishController::class, 'index'])->name('wish');
Route::get('/catalog/{category:slug}', CatalogController::class)->name('catalog');
Route::resource('/product', ProductController::class)->only('show');

//Cart
Route::controller(CartController::class)
    ->prefix('cart')
    ->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/{product}/add', 'add')->name('cart.add');
        Route::patch('/{product}/increase', 'increase')->name('cart.increase');
        Route::patch('/{product}/decrease', 'decrease')->name('cart.decrease');
        Route::post('/{item}', 'quantity')->name('cart.quantity');
        Route::delete('/{item}', 'destroy')->name('cart.destroy');
    });

//Profile
Route::middleware(['auth'])->group(function () {
    Route::resource('/messages', MessageController::class)->only(['index', 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
