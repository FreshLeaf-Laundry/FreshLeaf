<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\UsermgtController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VoucherEditController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\StoreEditController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    $faqs = \App\Models\FAQ::orderBy('order')->get();
    return view('pages.about', compact('faqs'));
})->name('about');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post')->middleware('guest');


Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');

Route::get('/store', [StoreController::class, 'index'])->name('store');

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Route khusus user login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Feedback Routes
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'show'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/shipping', [OrderController::class, 'index'])->name('orders.index');

    // Voucher Routes
    Route::post('/voucher/redeem', [VoucherController::class, 'redeem'])->name('voucher.redeem');
    Route::get('/voucher/check/{code}', [VoucherController::class, 'check'])->name('voucher.check');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Route Khusus Admin
Route::middleware(['auth', 'admin'])->group(function () {
    // User Management Routes
    Route::get('/admin/users', [UsermgtController::class, 'index'])->name('admin.usermgt');
    Route::post('/admin/users', [UsermgtController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UsermgtController::class, 'deleteUser'])->name('admin.users.delete');
    
    // FAQ Routes
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('/admin/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::post('faq/reorder', [FaqController::class, 'reorder'])->name('admin.faq.reorder');
    Route::delete('/admin/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

    // Voucher Routes
    Route::get('/admin/vouchers', [VoucherEditController::class, 'index'])->name('admin.vouchers');
    Route::post('/admin/vouchers', [VoucherEditController::class, 'store'])->name('admin.vouchers.store');
    Route::get('/admin/vouchers/{voucher}/edit', [VoucherEditController::class, 'edit'])->name('admin.vouchers.edit');
    Route::put('/admin/vouchers/{voucher}', [VoucherEditController::class, 'update'])->name('admin.vouchers.update');
    Route::delete('/admin/vouchers/{voucher}', [VoucherEditController::class, 'destroy'])->name('admin.vouchers.delete');

    // Order Routes
    Route::get('/order/admin', [OrderController::class, 'index_admin'])->name('admin.orders.admin');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');

    // Store Routes
    Route::get('/admin/store', [StoreEditController::class, 'index'])->name('admin.store');
    Route::post('/admin/store', [StoreEditController::class, 'store'])->name('admin.store.store');
    Route::delete('/admin/store/{id}', [StoreEditController::class, 'destroy'])->name('admin.store.destroy');
    Route::get('/admin/store/{id}', [StoreEditController::class, 'show'])->name('admin.store.show');
    Route::put('/admin/store/{id}', [StoreEditController::class, 'update'])->name('admin.store.update');
});





