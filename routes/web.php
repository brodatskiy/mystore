<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

Route::post('/locale', [SetLocaleController::class, 'change'])->name('changeLocale');

//Shop
Route::get('/', [CatalogController::class, 'index'])->name('/');
Route::get('/catalog/navigation', [CatalogController::class, 'navigation'])->name('catalog.navigation.index');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{section:slug}', [CatalogController::class, 'sectionIndex'])->name('catalog.section.index');
Route::get('/catalog/{section:slug}/category/{category:slug}', [CatalogController::class, 'categoryIndex'])->name('catalog.section.category.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::resource('/product', ProductController::class)->only('show');

//Orders
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

//Wishes
Route::middleware(['auth'])->group(function () {
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::post('/wishes/{product}/toggle', [WishController::class, 'toggle'])->name('wishes.toggle');
});

//Cart
Route::middleware([])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order')->middleware('auth');
    Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{product}/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::patch('/cart/{product}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
});

//Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
