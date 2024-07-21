<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;

// Frontend routes
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

// Admin routes
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Authentication
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    // Accounts
    Route::get('/accounts', function () {
        return view('admin.accounts');
    })->name('admin.accounts');

    // Add Product Form
    Route::get('/add-product', function () {
        return view('admin.add-product');
    })->name('admin.add-product');

    // Add Category Form
    Route::get('/add-category', function () {
        return view('admin.add-category');
    })->name('admin.add-category');

    // Display Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');

    // Handle Product Form Submission
    Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');

    // Handle Category Form Submission
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category');
    Route::get('admin/admin/edit-category/{id}', [CategoryController::class, 'edit'])->name('admin.edit-category');
    Route::post('admin/admin/edit-category/{id}', [CategoryController::class, 'update'])->name('admin.update-category');
    

});


//test connection 
Route::get('/test-db-connection', [App\Http\Controllers\TestController::class, 'testConnection']);
