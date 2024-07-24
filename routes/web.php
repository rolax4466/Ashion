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

// Route to display the form for adding a new category
Route::get('/add-category', [CategoryController::class, 'create'])->name('admin.create-category');

// Route to handle the form submission for adding a new category
Route::post('/add-category', [CategoryController::class, 'store'])->name('admin.add-category');

Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('admin.edit-category');
// Update the category
Route::put('/edit-category/{id}', [CategoryController::class, 'update'])->name('admin.update-category');
// Delete a category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

 // Display Products
 Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
 Route::get('/add-product', [ProductController::class, 'create'])->name('admin.add-product');
 Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');
 Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit-product');
 Route::put('/admin/edit-product/{id}', [ProductController::class, 'update']);

});


//test connection 
Route::get('/test-db-connection', [App\Http\Controllers\TestController::class, 'testConnection']);
