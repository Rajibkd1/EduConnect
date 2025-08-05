<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchTutorController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Language switching routes
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
Route::get('/api/language/current', [LanguageController::class, 'current'])->name('language.current');

// Theme switching routes
Route::get('/theme/{theme}', [App\Http\Controllers\ThemeController::class, 'switch'])->name('theme.switch');

// Signup routes
Route::get('/signup', function () {
    return view('signup');
})->name('signup.show');
Route::post('/signup/send-otp', [SignupController::class, 'sendOtp'])->name('signup.sendOtp');
Route::post('/signup/verify-otp', [SignupController::class, 'verifyOtp'])->name('signup.verifyOtp');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');
Route::get('/api/subjects', [SignupController::class, 'getSubjects'])->name('api.subjects');

// Login routes - redirect to signup page for combined auth
Route::get('/login', function () {
    return redirect()->route('signup.show');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset routes
Route::get('/forgot-password', [App\Http\Controllers\PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password/send-otp', [App\Http\Controllers\PasswordResetController::class, 'sendResetOtp'])->name('password.send-otp');
Route::post('/forgot-password/verify-otp', [App\Http\Controllers\PasswordResetController::class, 'verifyResetOtp'])->name('password.verify-otp');
Route::post('/reset-password', [App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.update');

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
    Route::get('/search-tutor', [SearchTutorController::class, 'index'])->name('search-tutor');
    Route::get('/tutor/{id}', [SearchTutorController::class, 'show'])->name('tutor.show');

    // Session routes
    Route::get('/sessions', [App\Http\Controllers\SessionController::class, 'index'])->name('sessions');
    Route::get('/sessions/create', [App\Http\Controllers\SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [App\Http\Controllers\SessionController::class, 'store'])->name('sessions.store');
    Route::patch('/sessions/{session}/status', [App\Http\Controllers\SessionController::class, 'updateStatus'])->name('sessions.updateStatus');
    Route::delete('/sessions/{session}/cancel', [App\Http\Controllers\SessionController::class, 'cancel'])->name('sessions.cancel');

    // Session Request routes
    Route::get('/session-requests', [App\Http\Controllers\SessionRequestController::class, 'index'])->name('session-requests');
    Route::get('/session-requests/create/{tutor}', [App\Http\Controllers\SessionRequestController::class, 'create'])->name('session-requests.create');
    Route::post('/session-requests', [App\Http\Controllers\SessionRequestController::class, 'store'])->name('session-requests.store');
    Route::patch('/session-requests/{sessionRequest}/status', [App\Http\Controllers\SessionRequestController::class, 'updateStatus'])->name('session-requests.updateStatus');
    Route::delete('/session-requests/{sessionRequest}/cancel', [App\Http\Controllers\SessionRequestController::class, 'cancel'])->name('session-requests.cancel');

    // Feedback routes
    Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback');
    Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');
    Route::put('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'destroy'])->name('feedback.destroy');
    Route::get('/tutor/{tutor}/feedback', [App\Http\Controllers\FeedbackController::class, 'getTutorFeedback'])->name('tutor.feedback');

    // Message/Chat routes
    Route::get('/conversations', [App\Http\Controllers\MessageController::class, 'getConversations'])->name('conversations');
    Route::get('/chat/{session}', [App\Http\Controllers\MessageController::class, 'showChat'])->name('chat.show');
    Route::get('/api/sessions/{session}/messages', [App\Http\Controllers\MessageController::class, 'getSessionMessages'])->name('api.messages.get');
    Route::post('/api/messages', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('api.messages.send');
    Route::post('/api/messages/mark-read', [App\Http\Controllers\MessageController::class, 'markAsRead'])->name('api.messages.markRead');

    // Notification routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/api/notifications/unread-count', [App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('api.notifications.unread-count');
    Route::get('/api/notifications/recent', [App\Http\Controllers\NotificationController::class, 'getRecent'])->name('api.notifications.recent');
    Route::patch('/api/notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('api.notifications.markAsRead');
    Route::patch('/api/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('api.notifications.markAllAsRead');
    Route::delete('/api/notifications/{notification}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('api.notifications.destroy');
    Route::delete('/api/notifications/clear-read', [App\Http\Controllers\NotificationController::class, 'clearRead'])->name('api.notifications.clearRead');

    // Tutor routes
    Route::get('/create-sessions', [App\Http\Controllers\SessionController::class, 'create'])->name('create-sessions');
});
