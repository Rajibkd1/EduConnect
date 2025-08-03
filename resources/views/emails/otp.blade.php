<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .otp-code {
            background-color: #3498db;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            letter-spacing: 5px;
        }
        .message {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">EduConnect</div>
            <p>Email Verification Required</p>
        </div>
        
        <div class="message">
            <p>Hello,</p>
            <p>Thank you for signing up with EduConnect! To complete your registration, please use the verification code below:</p>
        </div>
        
        <div class="otp-code">
            {{ $otp }}
        </div>
        
        <div class="warning">
            <strong>Important:</strong> This verification code will expire in 10 minutes for security reasons.
        </div>
        
        <div class="message">
            <p>If you didn't request this verification code, please ignore this email.</p>
            <p>Welcome to EduConnect - Your gateway to quality education!</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} EduConnect. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
