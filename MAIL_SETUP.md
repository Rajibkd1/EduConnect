# EduConnect Mail Configuration Setup

## Overview
This guide explains how to configure email settings for OTP (One-Time Password) functionality in the EduConnect application.

## Mail Configuration

### Step 1: Update Environment Variables
Add the following mail configuration to your `.env` file:

```env
# Mail Configuration for OTP Sending
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=rajibinf00@gmail.com
MAIL_PASSWORD="vcme rrlc nelg ddso"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="rajibinf00@gmail.com"
MAIL_FROM_NAME="EduConnect"
```

### Step 2: Gmail App Password Setup
The password `vcme rrlc nelg ddso` appears to be a Gmail App Password. If you need to generate a new one:

1. Go to your Google Account settings
2. Navigate to Security → 2-Step Verification
3. Scroll down to "App passwords"
4. Generate a new app password for "Mail"
5. Use the generated 16-character password in the `MAIL_PASSWORD` field

### Step 3: Clear Configuration Cache
After updating the `.env` file, run these commands:

```bash
php artisan config:clear
php artisan config:cache
```

## Testing Email Functionality

### Test OTP Email Sending
1. Navigate to the signup page: `http://your-domain/signup`
2. Click "SIGN UP" to switch to the registration panel
3. Enter an email address and click "Send OTP"
4. Check the email inbox for the verification code

### Email Template
The OTP email uses a custom template located at:
- `resources/views/emails/otp.blade.php`
- Mailable class: `app/Mail/OtpMail.php`

## Troubleshooting

### Common Issues

1. **"Failed to authenticate on SMTP server"**
   - Verify the Gmail app password is correct
   - Ensure 2-factor authentication is enabled on the Gmail account
   - Check that "Less secure app access" is disabled (use app passwords instead)

2. **"Connection could not be established with host smtp.gmail.com"**
   - Check your internet connection
   - Verify firewall settings allow SMTP connections on port 587
   - Try using port 465 with SSL encryption instead of TLS

3. **"Address in mailbox given [] does not comply with RFC 2822"**
   - Ensure `MAIL_FROM_ADDRESS` is properly formatted
   - Remove any extra quotes or spaces

### Alternative SMTP Settings
If Gmail doesn't work, you can try other SMTP providers:

#### Mailtrap (for testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

#### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

## Security Notes

1. **Never commit `.env` files** to version control
2. **Use app passwords** instead of regular Gmail passwords
3. **Rotate credentials regularly** for security
4. **Monitor email sending** for unusual activity

## Email Flow in EduConnect

1. **User Registration**: User enters email on signup form
2. **OTP Generation**: System generates 6-digit OTP with 10-minute expiry
3. **Email Sending**: OTP sent via configured SMTP server
4. **Verification**: User enters OTP to verify email
5. **Account Creation**: Upon successful verification, user account is created

## Files Involved

- **Controller**: `app/Http/Controllers/SignupController.php`
- **Model**: `app/Models/EmailVerification.php`
- **Mailable**: `app/Mail/OtpMail.php`
- **Email Template**: `resources/views/emails/otp.blade.php`
- **Configuration**: `config/mail.php`
- **Routes**: `routes/web.php`

## Support

If you encounter issues with email configuration, check:
1. Laravel logs: `storage/logs/laravel.log`
2. Email provider documentation
3. Server firewall and network settings
4. PHP mail extensions are installed and enabled
