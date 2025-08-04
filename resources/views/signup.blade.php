@extends('layouts.auth')

@section('title', 'EduConnect - Authentication')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <!-- Sign Up Container -->
    <div class="form-container sign-up-container">
        <!-- Step 1: Email Verification -->
        <div id="email-step" class="step-form">
            <form id="email-form">
                @csrf
                <h1>Create Account</h1>
                <span>Enter your email for verification</span>
                <input type="email" id="email" name="email" placeholder="Email" required />
                <button type="submit">Send Verification Code</button>
                <div id="message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 2: OTP Verification -->
        <div id="otp-step" class="step-form hidden">
            <form id="otp-form">
                @csrf
                <h1>Verify Email</h1>
                <span>Enter the 6-digit code sent to your email</span>
                <input type="text" id="otp" name="otp" class="otp-input" placeholder="000000" maxlength="6"
                    required pattern="[0-9]{6}" inputmode="numeric" />
                <button type="submit">Verify Code</button>
                <button type="button" id="back-to-email" class="secondary">Back to Email</button>
                <div id="otp-message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 3: Complete Registration -->
        <div id="registration-step" class="step-form hidden">
            <form id="registration-form" method="POST" action="{{ route('signup.store') }}">
                @csrf
                <input type="hidden" id="verified-email" name="email" />
                <h1>Complete Registration</h1>
                <input type="text" id="name" name="name" placeholder="Full Name" required />
                <select id="user_type" name="user_type" required>
                    <option value="">Select User Type</option>
                    <option value="student">Student</option>
                    <option value="tutor">Tutor</option>
                    <option value="guardian">Guardian</option>
                </select>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required />
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <svg id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="input-container">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password" required />
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <svg id="password_confirmation-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
                <button type="submit">Create Account</button>
                <button type="button" id="back-to-otp" class="secondary">Back to Verification</button>
                <div id="registration-message" class="message hidden"></div>
            </form>
        </div>
    </div>

    <!-- Sign In Container -->
    <div class="form-container sign-in-container">
        <form id="login-form" method="POST" action="{{ route('login.perform') }}">
            @csrf
            <div class="logo">
                <h2>EduConnect</h2>
                <p class="tagline">Connect. Learn. Grow.</p>
            </div>
            <h1>Sign in</h1>
            <span>Welcome back to EduConnect</span>
            <input type="email" name="email" id="login-email" placeholder="Email" required />
            <div class="input-container">
                <input type="password" name="password" id="login-password" placeholder="Password" required />
                <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                    <svg id="login-password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
            <a href="#">Forgot your password?</a>
            <button type="submit">Sign In</button>
            <div id="login-message" class="message hidden"></div>
            <button type="button" class="mobile-toggle" id="mobileSignUp">Don't have an account? Sign Up</button>
        </form>
    </div>

    <!-- Overlay Container -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back to EduConnect!</h1>
                <p>Continue your learning journey with us. Sign in to access your account.</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Join EduConnect!</h1>
                <p>Start your educational journey with us. Create an account to get started.</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
