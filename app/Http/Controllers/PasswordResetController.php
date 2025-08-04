<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP to user's email for password reset
     */
    public function sendResetOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Check if user exists in database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.user_not_found')
                ]);
            }
            return back()->withErrors(['email' => __('auth.password_reset.user_not_found')])->withInput();
        }

        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store the OTP in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($otp),
                'created_at' => now()
            ]
        );

        // Send the OTP email
        try {
            Mail::to($request->email)->send(new OtpMail($otp, $request->email));
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => __('auth.password_reset.otp_sent')
                ]);
            }

            return back()->with('status', __('auth.password_reset.otp_sent'));
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.otp_send_failed')
                ]);
            }

            return back()->withErrors(['email' => __('auth.password_reset.otp_send_failed')]);
        }
    }

    /**
     * Verify OTP for password reset
     */
    public function verifyResetOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Check if OTP exists and is valid
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset || !Hash::check($request->otp, $passwordReset->token)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.invalid_otp')
                ]);
            }
            return back()->withErrors(['otp' => __('auth.password_reset.invalid_otp')]);
        }

        // Check if OTP is expired (15 minutes)
        if (now()->diffInMinutes($passwordReset->created_at) > 15) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.otp_expired')
                ]);
            }
            return back()->withErrors(['otp' => __('auth.password_reset.otp_expired')]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('auth.password_reset.otp_verified')
            ]);
        }

        return back()->with('otp_verified', true);
    }

    /**
     * Reset the user's password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Check if there's a valid OTP verification for this email
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.no_valid_otp')
                ]);
            }
            return back()->withErrors(['email' => __('auth.password_reset.no_valid_otp')]);
        }

        // Check if OTP is expired (15 minutes)
        if (now()->diffInMinutes($passwordReset->created_at) > 15) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.password_reset.otp_expired')
                ]);
            }
            return back()->withErrors(['email' => __('auth.password_reset.otp_expired')]);
        }

        // Update user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Delete the password reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Fire password reset event
        event(new PasswordReset($user));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('auth.password_reset.password_reset_success'),
                'redirect' => route('signup.show')
            ]);
        }

        return redirect()->route('signup.show')->with('status', __('auth.password_reset.password_reset_success'));
    }
}
