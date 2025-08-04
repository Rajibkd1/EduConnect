<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.password_reset.email_subject') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .tagline {
            color: #7f8c8d;
            font-size: 14px;
        }
        .content {
            margin-bottom: 30px;
        }
        .reset-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .reset-button:hover {
            background-color: #2980b9;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .link-text {
            word-break: break-all;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 3px;
            font-family: monospace;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">EduConnect</div>
            <div class="tagline">{{ __('auth.tagline') }}</div>
        </div>

        <div class="content">
            <h2>{{ __('auth.password_reset.email_greeting') }}</h2>
            
            <p>{{ __('auth.password_reset.email_intro') }}</p>
            
            <div style="text-align: center;">
                <a href="{{ route('password.reset', $token) }}?email={{ urlencode($email) }}" class="reset-button">
                    {{ __('auth.password_reset.reset_password_btn') }}
                </a>
            </div>
            
            <div class="warning">
                <strong>{{ __('auth.password_reset.email_warning_title') }}</strong><br>
                {{ __('auth.password_reset.email_warning_text') }}
            </div>
            
            <p>{{ __('auth.password_reset.email_manual_instruction') }}</p>
            
            <div class="link-text">
                {{ route('password.reset', $token) }}?email={{ urlencode($email) }}
            </div>
            
            <p>{{ __('auth.password_reset.email_expiry') }}</p>
            
            <p>{{ __('auth.password_reset.email_ignore') }}</p>
        </div>

        <div class="footer">
            <p>{{ __('auth.password_reset.email_footer') }}</p>
            <p>&copy; {{ date('Y') }} EduConnect. {{ __('auth.password_reset.email_rights') }}</p>
        </div>
    </div>
</body>
</html>
