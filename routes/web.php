<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UsermgtController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post')->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/voucher', function () {
    return view('pages.voucher');
})->name('voucher');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Route Khusus Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UsermgtController::class, 'index'])->name('admin.usermgt');
    Route::post('/admin/users', [UsermgtController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UsermgtController::class, 'deleteUser'])->name('admin.users.delete');
    
});


