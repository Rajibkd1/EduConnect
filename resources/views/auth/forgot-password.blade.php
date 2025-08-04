@extends('layouts.auth')

@section('title', __('auth.password_reset.forgot_password_title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
    <!-- Overlay Container -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <div class="overlay-content">
                    <h1>{{ __('auth.password_reset.remember_password_title') }}</h1>
                    <p>{{ __('auth.password_reset.remember_password_text') }}</p>
                    <a href="{{ route('signup.show') }}" class="ghost">{{ __('auth.overlay.sign_in_btn') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-container sign-up-container" style="opacity: 1; z-index: 5;">
        <!-- Step 1: Email Entry -->
        <div id="email-step" class="step-form">
            <form id="email-form">
                @csrf
                <h1>{{ __('auth.password_reset.forgot_password_title') }}</h1>
                <span>{{ __('auth.password_reset.forgot_password_instruction') }}</span>
                <input type="email" id="email" name="email" placeholder="{{ __('auth.signin.email_placeholder') }}" required />
                <button type="submit">{{ __('auth.password_reset.send_otp') }}</button>
                <div id="email-message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 2: OTP Verification -->
        <div id="otp-step" class="step-form hidden">
            <form id="otp-form">
                @csrf
                <h1>{{ __('auth.password_reset.verify_otp_title') }}</h1>
                <span>{{ __('auth.password_reset.otp_instruction') }}</span>
                <input type="text" id="otp" name="otp" class="otp-input" placeholder="{{ __('auth.signup.otp_placeholder') }}" maxlength="6"
                    required pattern="[0-9]{6}" inputmode="numeric" />
                <button type="submit">{{ __('auth.password_reset.verify_otp') }}</button>
                <button type="button" id="back-to-email" class="secondary">{{ __('auth.signup.back_to_email') }}</button>
                <div id="otp-message" class="message hidden"></div>
            </form>
        </div>

        <!-- Step 3: Password Reset -->
        <div id="password-step" class="step-form hidden">
            <form id="password-form">
                @csrf
                <input type="hidden" id="verified-email" name="email" />
                <h1>{{ __('auth.password_reset.reset_password_title') }}</h1>
                <span>{{ __('auth.password_reset.reset_password_instruction') }}</span>
                
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="{{ __('auth.password_reset.new_password_placeholder') }}" required />
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
                    <input type="password" id="password_confirmation" name="password_confirmation" 
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
                <button type="button" id="back-to-otp" class="secondary">{{ __('auth.signup.back_to_verification') }}</button>
                <div id="password-message" class="message hidden"></div>
            </form>
        </div>
    </div>

    <!-- Sign In Container -->
    <div class="form-container sign-in-container">
        <div class="logo">
            <h2>EduConnect</h2>
            <p class="tagline">{{ __('auth.tagline') }}</p>
        </div>
        <div class="overlay-content">
            <h1>{{ __('auth.password_reset.remember_password_title') }}</h1>
            <p>{{ __('auth.password_reset.remember_password_text') }}</p>
            <a href="{{ route('signup.show') }}" class="ghost">{{ __('auth.overlay.sign_in_btn') }}</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentEmail = '';
            
            // Step 1: Email Form
            const emailForm = document.getElementById('email-form');
            const emailStep = document.getElementById('email-step');
            const otpStep = document.getElementById('otp-step');
            const passwordStep = document.getElementById('password-step');
            const emailMessage = document.getElementById('email-message');
            
            emailForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(emailForm);
                const submitButton = emailForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                
                submitButton.disabled = true;
                submitButton.textContent = '{{ __("auth.password_reset.sending") }}';
                
                fetch('{{ route("password.send-otp") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    emailMessage.className = data.success ? 'message success' : 'message error';
                    emailMessage.textContent = data.message;
                    emailMessage.classList.remove('hidden');
                    
                    if (data.success) {
                        currentEmail = formData.get('email');
                        setTimeout(() => {
                            emailStep.classList.add('hidden');
                            otpStep.classList.remove('hidden');
                        }, 1500);
                    }
                })
                .catch(error => {
                    emailMessage.className = 'message error';
                    emailMessage.textContent = '{{ __("auth.password_reset.otp_send_failed") }}';
                    emailMessage.classList.remove('hidden');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
            });
            
            // Step 2: OTP Form
            const otpForm = document.getElementById('otp-form');
            const otpMessage = document.getElementById('otp-message');
            
            otpForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(otpForm);
                formData.append('email', currentEmail);
                const submitButton = otpForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                
                submitButton.disabled = true;
                submitButton.textContent = '{{ __("auth.password_reset.verifying") }}';
                
                fetch('{{ route("password.verify-otp") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    otpMessage.className = data.success ? 'message success' : 'message error';
                    otpMessage.textContent = data.message;
                    otpMessage.classList.remove('hidden');
                    
                    if (data.success) {
                        document.getElementById('verified-email').value = currentEmail;
                        setTimeout(() => {
                            otpStep.classList.add('hidden');
                            passwordStep.classList.remove('hidden');
                        }, 1500);
                    }
                })
                .catch(error => {
                    otpMessage.className = 'message error';
                    otpMessage.textContent = '{{ __("auth.password_reset.invalid_otp") }}';
                    otpMessage.classList.remove('hidden');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
            });
            
            // Step 3: Password Reset Form
            const passwordForm = document.getElementById('password-form');
            const passwordMessage = document.getElementById('password-message');
            
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(passwordForm);
                const submitButton = passwordForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                
                submitButton.disabled = true;
                submitButton.textContent = '{{ __("auth.password_reset.resetting") }}';
                
                fetch('{{ route("password.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    passwordMessage.className = data.success ? 'message success' : 'message error';
                    passwordMessage.textContent = data.message;
                    passwordMessage.classList.remove('hidden');
                    
                    if (data.success && data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000);
                    }
                })
                .catch(error => {
                    passwordMessage.className = 'message error';
                    passwordMessage.textContent = '{{ __("auth.password_reset.reset_failed") }}';
                    passwordMessage.classList.remove('hidden');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
            });
            
            // Back buttons
            document.getElementById('back-to-email').addEventListener('click', function() {
                otpStep.classList.add('hidden');
                emailStep.classList.remove('hidden');
                otpForm.reset();
                otpMessage.classList.add('hidden');
            });
            
            document.getElementById('back-to-otp').addEventListener('click', function() {
                passwordStep.classList.add('hidden');
                otpStep.classList.remove('hidden');
                passwordForm.reset();
                passwordMessage.classList.add('hidden');
            });
        });
    </script>
@endpush
