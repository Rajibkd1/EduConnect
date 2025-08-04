@extends('layouts.auth')

@section('title', __('auth.title'))

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
                <h1>{{ __('auth.signup.create_account') }}</h1>
                <span>{{ __('auth.signup.email_verification') }}</span>
                <input type="email" id="email" name="email" placeholder="{{ __('auth.signup.email_placeholder') }}" required />
                <button type="submit">{{ __('auth.signup.send_verification') }}</button>
                <div id="message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 2: OTP Verification -->
        <div id="otp-step" class="step-form hidden">
            <form id="otp-form">
                @csrf
                <h1>{{ __('auth.signup.verify_email') }}</h1>
                <span>{{ __('auth.signup.otp_instruction') }}</span>
                <input type="text" id="otp" name="otp" class="otp-input" placeholder="{{ __('auth.signup.otp_placeholder') }}" maxlength="6"
                    required pattern="[0-9]{6}" inputmode="numeric" />
                <button type="submit">{{ __('auth.signup.verify_code') }}</button>
                <button type="button" id="back-to-email" class="secondary">{{ __('auth.signup.back_to_email') }}</button>
                <div id="otp-message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 3: Complete Registration -->
        <div id="registration-step" class="step-form hidden">
            <form id="registration-form" method="POST" action="{{ route('signup.store') }}">
                @csrf
                <input type="hidden" id="verified-email" name="email" />
                <h1>{{ __('auth.signup.complete_registration') }}</h1>
                <input type="text" id="name" name="name" placeholder="{{ __('auth.signup.full_name_placeholder') }}" required />
                <select id="user_type" name="user_type" required>
                    <option value="">{{ __('auth.signup.select_user_type') }}</option>
                    <option value="student">{{ __('auth.signup.student') }}</option>
                    <option value="tutor">{{ __('auth.signup.tutor') }}</option>
                    <option value="guardian">{{ __('auth.signup.guardian') }}</option>
                </select>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="{{ __('auth.signup.password_placeholder') }}" required />
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
                        placeholder="{{ __('auth.signup.confirm_password_placeholder') }}" required />
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
                <button type="submit">{{ __('auth.signup.create_account_btn') }}</button>
                <button type="button" id="back-to-otp" class="secondary">{{ __('auth.signup.back_to_verification') }}</button>
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
                <p class="tagline">{{ __('auth.tagline') }}</p>
            </div>
            <h1>{{ __('auth.signin.title') }}</h1>
            <span>{{ __('auth.signin.welcome_back') }}</span>
            <input type="email" name="email" id="login-email" placeholder="{{ __('auth.signin.email_placeholder') }}" required />
            <div class="input-container">
                <input type="password" name="password" id="login-password" placeholder="{{ __('auth.signin.password_placeholder') }}" required />
                <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                    <svg id="login-password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
            <a href="#">{{ __('auth.signin.forgot_password') }}</a>
            <button type="submit">{{ __('auth.signin.sign_in_btn') }}</button>
            <div id="login-message" class="message hidden"></div>
            <button type="button" class="mobile-toggle" id="mobileSignUp">{{ __('auth.signin.no_account') }}</button>
        </form>
    </div>

    <!-- Overlay Container -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>{{ __('auth.overlay.welcome_back_title') }}</h1>
                <p>{{ __('auth.overlay.welcome_back_text') }}</p>
                <button class="ghost" id="signIn">{{ __('auth.overlay.sign_in_btn') }}</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>{{ __('auth.overlay.join_title') }}</h1>
                <p>{{ __('auth.overlay.join_text') }}</p>
                <button class="ghost" id="signUp">{{ __('auth.overlay.sign_up_btn') }}</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
