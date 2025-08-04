@extends('layouts.auth')

@section('title', __('auth.password_reset.reset_password_title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <div class="form-container sign-in-container">
        <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="logo">
                <h2>EduConnect</h2>
                <p class="tagline">{{ __('auth.tagline') }}</p>
            </div>
            <h1>{{ __('auth.password_reset.reset_password_title') }}</h1>
            <span>{{ __('auth.password_reset.reset_password_instruction') }}</span>

            @if ($errors->any())
                <div class="message error">
                    {{ $errors->first() }}
                </div>
            @endif

            <input type="email" name="email" id="email" placeholder="{{ __('auth.signin.email_placeholder') }}"
                value="{{ old('email', request()->email) }}" required />

            <div class="input-container">
                <input type="password" name="password" id="password"
                    placeholder="{{ __('auth.password_reset.new_password_placeholder') }}" required />
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <svg id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="input-container">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="{{ __('auth.password_reset.confirm_new_password_placeholder') }}" required />
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                    <svg id="password_confirmation-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>

            <button type="submit">{{ __('auth.password_reset.reset_password_btn') }}</button>

            <div id="reset-password-message" class="message hidden"></div>

            <a href="{{ route('signup.show') }}" class="back-link">{{ __('auth.password_reset.back_to_login') }}</a>
        </form>
    </div>

    <!-- Overlay Container -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>{{ __('auth.password_reset.almost_done_title') }}</h1>
                <p>{{ __('auth.password_reset.almost_done_text') }}</p>
                <a href="{{ route('signup.show') }}" class="ghost">{{ __('auth.overlay.sign_in_btn') }}</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reset-password-form');
            const messageDiv = document.getElementById('reset-password-message');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;

                submitButton.disabled = true;
                submitButton.textContent = '{{ __('auth.password_reset.resetting') }}';

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageDiv.className = data.success ? 'message success' : 'message error';
                        messageDiv.textContent = data.message;
                        messageDiv.classList.remove('hidden');

                        if (data.success && data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        messageDiv.className = 'message error';
                        messageDiv.textContent = '{{ __('auth.password_reset.reset_failed') }}';
                        messageDiv.classList.remove('hidden');
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.textContent = originalText;
                    });
            });
        });
    </script>
@endpush
