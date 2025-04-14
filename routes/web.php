<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CatalogController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\WishController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SetLocaleController;
use Illuminate\Support\Facades\Route;

Route::post('/locale', [SetLocaleController::class, 'locale'])->name('locale');

//Shop
Route::get('/', HomeController::class)->name('/');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/navigation', [CatalogController::class, 'navigation'])->name('catalog.navigation.index');
Route::get('/catalog/{section:slug}', [CatalogController::class, 'sectionIndex'])->name('catalog.section.index');
Route::get('/catalog/{section:slug}/category/{category:slug}', [CatalogController::class, 'categoryIndex'])->name('catalog.section.category.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/sections', [SectionController::class, 'index'])->name('section.index');
Route::get('/sections/{section}', [SectionController::class, 'show'])->name('section.show');

Route::resource('/product', ProductController::class)->only('show');

//Orders
Route::middleware([])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

//Wishes
Route::middleware(['auth'])->group(function () {
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::post('/wishes/{product}/toggle', [WishController::class, 'toggle'])->name('wishes.toggle');
});

//Cart
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order');
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
