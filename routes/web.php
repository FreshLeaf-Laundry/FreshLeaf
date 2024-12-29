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

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Route khusus user login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'show'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/shipping', [OrderController::class, 'index'])->name('orders.index');

    // Voucher Routes
    Route::post('/voucher/redeem', [VoucherController::class, 'redeem'])->name('voucher.redeem');
    Route::get('/voucher/check/{code}', [VoucherController::class, 'check'])->name('voucher.check');
});

// Route Khusus Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UsermgtController::class, 'index'])->name('admin.usermgt');
    Route::post('/admin/users', [UsermgtController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UsermgtController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('/admin/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    // Route::post('/admin/faq/update/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::post('faq/reorder', [FaqController::class, 'reorder'])->name('admin.faq.reorder');
    Route::delete('/admin/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    Route::get('/admin/vouchers', [VoucherEditController::class, 'index'])->name('admin.vouchers');
    Route::post('/admin/vouchers', [VoucherEditController::class, 'store'])->name('admin.vouchers.store');
    Route::get('/admin/vouchers/{voucher}/edit', [VoucherEditController::class, 'edit'])->name('admin.vouchers.edit');
    Route::put('/admin/vouchers/{voucher}', [VoucherEditController::class, 'update'])->name('admin.vouchers.update');
    Route::delete('/admin/vouchers/{voucher}', [VoucherEditController::class, 'destroy'])->name('admin.vouchers.delete');
    Route::get('/order/admin', [OrderController::class, 'index_admin'])->name('admin.orders.admin');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
});
