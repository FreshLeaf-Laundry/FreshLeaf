<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdmindashController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/voucher', function () {
    return view('pages.voucher');
})->name('voucher');

Route::get('/feedback', function () {
    return view('pages.feedback');
})->name('feedback');

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Route Login cuma bisa diakses jika belum login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post')->middleware('guest');

// Route Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Khusus Admin (hanya bisa diakses jika sudah login dan role admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdmindashController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users', [AdmindashController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [AdmindashController::class, 'destroy'])->name('admin.users.delete');
    // Add other admin routes here
});
