<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admindash;
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

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [Admindash::class, 'index'])->name('admin.dashboard')->middleware('auth');
