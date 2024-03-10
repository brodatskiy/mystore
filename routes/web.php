<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\StickerController;
use App\Http\Controllers\Client\WishController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CatalogController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MessageController;
use App\Http\Controllers\Client\ProductSingleController;
use App\Http\Controllers\Client\ProfileController;
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

Route::get('/',  HomeController::class)->name('/');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/wish', [WishController::class, 'index'])->name('wish');
Route::singleton('catalog', CatalogController::class);
Route::resource('product', ProductSingleController::class)->only('show');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('products', ProductController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('stickers', StickerController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('tags', TagController::class)->except(['show']);
    Route::resource('users', UserController::class);
    Route::resource('chat', ChatController::class)->only(['index', 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/messages', MessageController::class)->only(['index', 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
