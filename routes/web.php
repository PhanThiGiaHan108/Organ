<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;

use App\Http\Controllers\AdminCategoryController;



 Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('user/shop', [ProductController::class, 'shop'])->name('user.shop');
 Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('user/shop/cart', [CartController::class, 'shopCart'])->name('shop.cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('user/shop/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::put('user/shop/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');

// Trang hiển thị form
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

// Xử lý submit form
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');

// Trang hiển thị thành công
Route::get('/order-success', function () {
    return view('user.order-success');
})->name('orders.success');


 Route::get('user/contact', [ContactController::class, 'contact'])->name('contact');
 Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
 





 Route::get('/about', function () {
    return view('user.about');
})->name('about');


Route::get('/categories', [ProductController::class, 'showCategories'])->name('categories.index');

Route::get('/search', [CartController::class, 'search'])->name('search');
// Route admin dashboard
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/users', [AdminUserController::class, 'index'])->name('admin.user');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
    // Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.order');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');
    // Route::get('/products', [AdminProductController::class, 'index'])->name('admin.product');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
    //  Route::get('/categories', [AdminCategoryController::class, 'index'])->name('category');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

});




// Route admin user
Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');


// Route admin order
Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('admin.order');



Route::get('/admin/product', [AdminProductController::class, 'index'])->name('admin.product');


// Route admin category
Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category');




