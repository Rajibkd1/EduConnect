@extends('layouts.auth')

@section('title', __('auth.signin.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
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
            <input type="email" name="email" id="login-email" placeholder="{{ __('auth.signin.email_placeholder') }}"
                value="{{ old('email') }}" required />
            <div class="input-container">
                <input type="password" name="password" id="login-password"
                    placeholder="{{ __('auth.signin.password_placeholder') }}" required />
                <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                    <svg id="login-password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
            <a href="{{ route('password.request') }}">{{ __('auth.signin.forgot_password') }}</a>
            <button type="submit">{{ __('auth.signin.sign_in_btn') }}</button>
            <p style="margin-top: 20px; color: #666; font-size: 14px;">
                {{ __('auth.signin.no_account') }}
                <a href="{{ route('signup') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                    {{ __('auth.signin.create_account') }}
                </a>
            </p>
        </form>
    </div>

    <!-- Welcome Panel -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>{{ __('auth.overlay.welcome_title') }}</h1>
                <p>{{ __('auth.overlay.welcome_text') }}</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors->all());
                if (errors.length > 0) {
                    showModal(errors.join('\n'), false, 'Login Error');
                }
            });
        </script>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
