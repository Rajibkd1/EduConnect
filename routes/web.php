<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Signup routes
Route::get('/signup', [SignupController::class, 'show'])->name('signup.show');
Route::post('/signup/send-otp', [SignupController::class, 'sendOtp'])->name('signup.sendOtp');
Route::post('/signup/verify-otp', [SignupController::class, 'verifyOtp'])->name('signup.verifyOtp');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

// Login routes - redirect to signup page for combined auth
Route::get('/login', function () {
    return redirect()->route('signup.show');
})->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route - protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['user' => auth()->user()]);
    })->name('dashboard');
});
