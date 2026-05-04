<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductAttributeController;

Route::get('/', function () {
    return view('screens.web.home.index');
})->name('home');

Route::get('/about', function () {
    return view('screens.web.about.index');
})->name('about');

Route::get('/journey', function () {
    return view('screens.web.journey.index');
})->name('journey');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    
    Route::get('/categories', [ProductCategoryController::class, 'index'])->name('product-categories.index');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/{product:slug}/gallery-image/{productImage}', [ProductController::class, 'destroyGalleryImage'])
        ->name('products.gallery-image.destroy');
    Route::put('/products/{product:slug}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/product-variations', [ProductAttributeController::class, 'index'])->name('product-variations.index');
    Route::get('/product-variations/create', [ProductAttributeController::class, 'create'])->name('product-variations.create');
    Route::post('/product-variations', [ProductAttributeController::class, 'store'])->name('product-variations.store');
});

Route::prefix('admin')->middleware(['auth', 'role:user'])->group(function () {
});

Route::prefix('admin')->middleware(['auth', 'role:admin|user'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});


require __DIR__ . '/auth.php';
