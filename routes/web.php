
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\NotificationController;

// ------------------- AUTH & PROFILE -------------------
Route::get('/', fn() => view('welcome'));
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------- USER SHOPPING -------------------
Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('user/shop', [ProductController::class, 'shop'])->name('user.shop');
Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('user/shop/cart', [CartController::class, 'shopCart'])->name('shop.cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('user/shop/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('user/shop/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');

// ------------------- CHECKOUT -------------------
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
Route::get('/order-success', fn() => view('user.order-success'))->name('orders.success');

// ------------------- CONTACT -------------------
Route::get('user/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/my-messages', [ContactController::class, 'userMessages'])->middleware('auth')->name('contact.userMessages');

// ------------------- STATIC PAGES -------------------
Route::get('/about', fn() => view('user.about'))->name('about');
Route::get('/categories', [ProductController::class, 'showCategories'])->name('categories.index');
Route::get('/search', [CartController::class, 'search'])->name('search');

// ------------------- ADMIN ROUTES -------------------
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // User management
    Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');

    // Order management
    Route::get('/order', [AdminOrderController::class, 'index'])->name('admin.order');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');

    // Product management
    Route::get('/product', [AdminProductController::class, 'index'])->name('admin.product');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

    // Category management
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

    // Notification management
    Route::get('/notification', [NotificationController::class, 'index'])->name('admin.notification');
    Route::post('/contact-replies', [NotificationController::class, 'storeReply'])->name('contact-replies.store');
});

// ------------------- NOTIFICATION (USER) -------------------
Route::middleware('auth')->group(function () {
    // Lấy danh sách thông báo mới nhất
    Route::get('/notifications/fetch', [NotificationController::class, 'fetch']);
    // Đếm số thông báo chưa đọc
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
    // Đánh dấu tất cả là đã đọc
    Route::post('/notifications/mark-all', [NotificationController::class, 'markAllAsRead']);
    // Lấy số lượng các loại thông báo
    Route::get('/notifications/counts', [NotificationController::class, 'counts'])->name('notifications.counts');
    // Xem tin nhắn/thông báo cá nhân
    Route::get('/user/messages', [NotificationController::class, 'message'])->name('user.messages');
});

