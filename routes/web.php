<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Signup routes
Route::get('/signup', function() {
    return view('signup');
})->name('signup.show');
Route::post('/signup/send-otp', [SignupController::class, 'sendOtp'])->name('signup.sendOtp');
Route::post('/signup/verify-otp', [SignupController::class, 'verifyOtp'])->name('signup.verifyOtp');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

// Login routes - redirect to signup page for combined auth
Route::get('/login', function () {
    return redirect()->route('signup.show');
})->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Test route to simulate authenticated user for navigation testing
Route::get('/test-navigation', function () {
    // Create a fake user for testing navigation with all required attributes
    $fakeUser = new \App\Models\User();
    $fakeUser->id = 1;
    $fakeUser->name = 'Rajib Kumar Dhar';
    $fakeUser->email = 'rajibkd@gmail.com';
    $fakeUser->user_type = 'student';
    $fakeUser->created_at = now();
    $fakeUser->updated_at = now();

    // Set the attributes array to make the model work properly
    $fakeUser->setRawAttributes([
        'id' => 1,
        'name' => 'Rajib Kumar Dhar',
        'email' => 'rajibkd@gmail.com',
        'user_type' => 'student',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Mark the model as existing
    $fakeUser->exists = true;

    // Temporarily authenticate this fake user
    Auth::login($fakeUser);

    // Redirect to dashboard to ensure proper authentication state
    return redirect()->route('dashboard');
})->name('test-navigation');

// Dashboard route - protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['user' => auth()->user()]);
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Student and Guardian routes
    Route::get('/search-tutor', function () {
        return view('search-tutor', ['user' => auth()->user()]);
    })->name('search-tutor');

    Route::get('/sessions', function () {
        return view('sessions', ['user' => auth()->user()]);
    })->name('sessions');

    Route::get('/feedback', function () {
        return view('feedback', ['user' => auth()->user()]);
    })->name('feedback');

    // Tutor routes
    Route::get('/session-requests', function () {
        return view('session-requests', ['user' => auth()->user()]);
    })->name('session-requests');

    Route::get('/create-sessions', function () {
        return view('create-sessions', ['user' => auth()->user()]);
    })->name('create-sessions');
});
