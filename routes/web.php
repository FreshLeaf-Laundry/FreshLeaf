<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VoucherController;

// Halaman Utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman About
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Halaman Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Halaman Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Halaman Feedback
Route::get('/feedback', function () {
    return view('pages.feedback');
})->name('feedback');

// Halaman Voucher (menggunakan VoucherController)
Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');

// Resource Route untuk Voucher (CRUD)
Route::resource('vouchers', VoucherController::class);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->name('admin.dashboard');
// ->middleware(['auth', 'admin']);
