<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
// web routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jumps', [BlogController::class, 'index'])->name('blog.index');
Route::get('/jumps/posts', [BlogController::class, 'posts'])->name('blog.posts');
Route::get('/jumps/{slug}', [BlogController::class, 'show'])
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('blog.show');

Route::get('/identity', function () {
    return view('screens.web.about.index');
})->name('about');

Route::get('/carpediem', function () {
    return view('screens.web.carpe-diem.index');
})->name('carpediem');

Route::get('/journey', function () {
    return view('screens.web.journey.index');
})->name('journey');

Route::get('/artifacts', [StoreController::class, 'index'])->name('artifacts.index');
Route::get('/artifacts/filter', [StoreController::class, 'filterArtifacts'])->name('artifacts.filter');
Route::get('/artifacts/{product:slug}', [StoreController::class, 'show'])->name('artifacts.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart', [CartItemController::class, 'store'])->name('cart.store');
Route::patch('/cart-items/{id}', [CartItemController::class, 'updateQty'])->name('cart-items.update');
Route::delete('/cart-items/{id}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');

/** Guest checkout: account created from billing email when new; Stripe still secures payment. */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'storeAfterPayment'])->name('checkout.place-order');
Route::post('/checkout/payment-intent', [CheckoutController::class, 'createPaymentIntent'])->name('checkout.payment-intent');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order-success/{order}', [CheckoutController::class, 'success'])->name('order.success');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order:id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order:id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/categories', [ProductCategoryController::class, 'index'])->name('product-categories.index');
    Route::post('/categories', [ProductCategoryController::class, 'store'])->name('product-categories.store');
    Route::put('/categories/{category}', [ProductCategoryController::class, 'update'])->name('product-categories.update');
    Route::delete('/categories/{category}', [ProductCategoryController::class, 'destroy'])->name('product-categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/{product:slug}/gallery-image/{productImage}', [ProductController::class, 'destroyGalleryImage'])
        ->name('products.gallery-image.destroy');
    Route::put('/products/{product:slug}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/blog-categories', [BlogCategoryController::class, 'index'])->name('blog-categories.index');
    Route::post('/blog-categories', [BlogCategoryController::class, 'store'])->name('blog-categories.store');
    Route::put('/blog-categories/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog-categories.update');
    Route::delete('/blog-categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog-categories.destroy');

    Route::post('/blog-editor/image', [AdminBlogController::class, 'uploadBlogBodyImage'])->name('blogs.editor-image');

    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:user'])->group(function () {});

Route::prefix('admin')->middleware(['auth', 'role:admin|user'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
