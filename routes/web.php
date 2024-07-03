<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop', function () {
    return view('shop');
})->name('shop');
Route::get('/product-details', function () {
    return View::make('product-details');
})->name('product-details');

Route::get('/shop-cart', function () {
    return View::make('shop-cart');
})->name('shop-cart');

Route::get('/checkout', function () {
    return View::make('checkout');
})->name('checkout');

Route::get('/blog-details', function () {
    return View::make('blog-details');
})->name('blog-details');
Route::get('/blog', function () {
    return View::make('blog');
})->name('blog');
Route::get('/contact', function () {
    return View::make('contact');
})->name('contact');
Route::get('partials/login', function () {
    return View::make('partials.login');
})->name('partials.login');
Route::get('partials/register', function () {
    return View::make('partials.register');
})->name('partials.register');


//admin
// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});
Route::get('admin/login', function () {
    return View::make('admin.login');
})->name('admin.login');
Route::get('admin/products', function () {
    return View::make('admin.products');
})->name('admin.products');
Route::get('admin/accounts', function () {
    return View::make('admin.accounts');
})->name('admin.accounts');
Route::get('admin/add-product', function () {
    return View::make('admin.add-product');
})->name('admin.add-product');





