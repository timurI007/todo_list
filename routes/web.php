<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::redirect('/', '/login');

    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginPage')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'registerPage')->name('register');
        Route::post('/register', 'register');
    });

    Route::get('/confirm-email', [EmailVerificationController::class, 'confirmEmailPage'])->name('confirm_email');
    // Route::post('/confirm-email', [EmailVerificationController::class, 'confirmEmail']);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/dashboard');

    // Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
