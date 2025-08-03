@extends('layouts.auth')

@section('title', 'EduConnect - Authentication')

@push('styles')
    <style>
        /* Form container styles */
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .auth-container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .auth-container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        .auth-container.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .auth-container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .auth-container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .auth-container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .auth-container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        /* Form styles */
        form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px 50px;
            height: 100%;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-weight: 700;
            margin: 0 0 20px 0;
            font-size: 2rem;
            color: #333;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        span {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            display: block;
        }

        /* Input container for password toggle */
        .input-container {
            position: relative;
            width: 100%;
            margin: 10px 0;
        }

        input,
        select {
            background: rgba(248, 249, 250, 0.9);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 15px 20px;
            margin: 10px 0;
            width: 100%;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .input-container input {
            margin: 0;
            padding-right: 50px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        input::placeholder {
            color: #999;
            font-weight: 400;
        }

        /* Password toggle button */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            color: #666;
            transition: all 0.3s ease;
            font-size: 16px;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #667eea;
            transform: translateY(-50%) scale(1.1);
        }

        /* OTP Input Styling */
        .otp-input {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 8px;
            background: rgba(248, 249, 250, 0.9);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
            width: 100%;
            font-family: 'Courier New', monospace;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .otp-input:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .otp-input::placeholder {
            letter-spacing: 2px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }

        button {
            border-radius: 25px;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 600;
            padding: 15px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        button.ghost {
            background: transparent;
            border: 2px solid #FFFFFF;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        button.ghost:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
        }

        button.secondary {
            background: linear-gradient(135deg, #6c757d, #8a9ba8);
            border: none;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        button.secondary:hover {
            background: linear-gradient(135deg, #5a6268, #6c757d);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo h2 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
            text-shadow: none;
        }

        .tagline {
            font-size: 14px;
            color: #666;
            font-weight: 400;
            margin: 0;
            font-style: italic;
        }

        .hidden {
            display: none;
        }

        .step-form {
            width: 100%;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .message {
            margin: 15px 0;
            padding: 15px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            backdrop-filter: blur(10px);
            border: none;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.9), rgba(72, 187, 120, 0.9));
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .message.error {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.9), rgba(248, 81, 73, 0.9));
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        a {
            color: #667eea;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        a:hover {
            color: #764ba2;
            text-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
        }

        p {
            font-size: 16px;
            font-weight: 300;
            line-height: 24px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 400px;
                min-height: auto;
            }

            .form-container {
                position: relative;
                width: 100%;
                height: auto;
                transform: none !important;
                opacity: 1 !important;
            }

            .sign-in-container,
            .sign-up-container {
                position: relative;
                width: 100%;
                left: 0;
                transform: none !important;
                opacity: 1 !important;
            }

            .overlay-container {
                display: none;
            }

            .auth-container.right-panel-active .sign-in-container {
                display: none;
            }

            .auth-container.right-panel-active .sign-up-container {
                display: block;
            }

            .sign-in-container {
                display: block;
            }

            .sign-up-container {
                display: none;
            }

            form {
                padding: 30px 25px;
                min-height: auto;
            }

            h1 {
                font-size: 1.8rem;
                margin-bottom: 15px;
            }

            .logo h2 {
                font-size: 2rem;
            }

            input,
            select {
                padding: 12px 15px;
                margin: 8px 0;
                font-size: 16px;
            }

            .input-container input {
                padding-right: 45px;
            }

            button {
                padding: 12px 35px;
                font-size: 12px;
            }

            .mobile-toggle {
                display: block;
                margin-top: 20px;
                background: transparent;
                border: 2px solid #667eea;
                color: #667eea;
                padding: 10px 20px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .mobile-toggle:hover {
                background: #667eea;
                color: white;
                transform: translateY(-1px);
            }
        }

        @media (min-width: 769px) {
            .mobile-toggle {
                display: none;
            }
        }
    </style>
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
                        <i id="password-icon">👁️</i>
                    </button>
                </div>
                <div class="input-container">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password" required />
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i id="password_confirmation-icon">👁️</i>
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
                    <i id="login-password-icon">👁️</i>
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
    <script>
        // Panel switching
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.querySelector('.auth-container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        // Mobile toggle functionality
        const mobileSignUpButton = document.getElementById('mobileSignUp');
        if (mobileSignUpButton) {
            mobileSignUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });
        }

        // Signup flow steps
        const emailStep = document.getElementById('email-step');
        const otpStep = document.getElementById('otp-step');
        const registrationStep = document.getElementById('registration-step');

        // Step navigation
        document.getElementById('back-to-email').addEventListener('click', () => {
            otpStep.classList.add('hidden');
            emailStep.classList.remove('hidden');
        });

        document.getElementById('back-to-otp').addEventListener('click', () => {
            registrationStep.classList.add('hidden');
            otpStep.classList.remove('hidden');
        });

        // Message display function
        function showMessage(elementId, message, isSuccess = true) {
            const messageDiv = document.getElementById(elementId);
            messageDiv.textContent = message;
            messageDiv.className = `message ${isSuccess ? 'success' : 'error'}`;
            messageDiv.classList.remove('hidden');
        }

        // Email form submission
        document.getElementById('email-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;

            try {
                const response = await fetch('{{ route('signup.sendOtp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('message', data.message);
                    setTimeout(() => {
                        emailStep.classList.add('hidden');
                        otpStep.classList.remove('hidden');
                    }, 1000);
                } else {
                    showMessage('message', data.message, false);
                }
            } catch (error) {
                showMessage('message', 'An error occurred. Please try again.', false);
            }
        });

        // OTP form submission
        document.getElementById('otp-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;

            try {
                const response = await fetch('{{ route('signup.verifyOtp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email,
                        otp
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('otp-message', data.message);
                    document.getElementById('verified-email').value = email;
                    setTimeout(() => {
                        otpStep.classList.add('hidden');
                        registrationStep.classList.remove('hidden');
                    }, 1000);
                } else {
                    showMessage('otp-message', data.message, false);
                }
            } catch (error) {
                showMessage('otp-message', 'An error occurred. Please try again.', false);
            }
        });

        // Registration form submission
        document.getElementById('registration-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('{{ route('signup.store') }}', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('registration-message', data.message);
                    setTimeout(() => {
                        window.location.href = '{{ route('dashboard') }}';
                    }, 2000);
                } else {
                    showMessage('registration-message', data.message, false);
                }
            } catch (error) {
                showMessage('registration-message', 'An error occurred. Please try again.', false);
            }
        });

        // Login form submission
        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('{{ route('login.perform') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showMessage('login-message', data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect || '{{ route('dashboard') }}';
                    }, 1500);
                } else {
                    showMessage('login-message', data.message, false);
                }
            } catch (error) {
                showMessage('login-message', 'An error occurred. Please try again.', false);
            }
        });

        // Password toggle functionality
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.textContent = '🙈';
            } else {
                passwordField.type = 'password';
                icon.textContent = '👁️';
            }
        }

        // OTP input enhancements
        document.getElementById('otp').addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Auto-submit when 6 digits are entered
            if (this.value.length === 6) {
                setTimeout(() => {
                    document.getElementById('otp-form').dispatchEvent(new Event('submit'));
                }, 500);
            }
        });

        // Add paste functionality for OTP
        document.getElementById('otp').addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const numbers = paste.replace(/[^0-9]/g, '').substring(0, 6);
            this.value = numbers;
            
            if (numbers.length === 6) {
                setTimeout(() => {
                    document.getElementById('otp-form').dispatchEvent(new Event('submit'));
                }, 500);
            }
        });
    </script>
@endpush
