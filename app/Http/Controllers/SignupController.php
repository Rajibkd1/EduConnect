<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Guardian;
use App\Models\EmailVerification;
use Carbon\Carbon;
use App\Mail\OtpMail;

class SignupController extends Controller
{
    public function show()
    {
        return view('signup');
    }

    // Step 1: Send OTP to email
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email')
            ]);
        }

        try {
            // Delete any existing OTP for this email
            EmailVerification::where('email', $request->email)->delete();

            // Generate new OTP
            $otp = EmailVerification::generateOTP();

            // Store OTP in database
            EmailVerification::create([
                'email' => $request->email,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10), // OTP expires in 10 minutes
            ]);

            // Send OTP via email using OtpMail mailable
            Mail::to($request->email)->send(new OtpMail($otp, $request->email));

            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to your email!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send verification code. Please try again.'
            ]);
        }
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $verification = EmailVerification::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code.'
            ]);
        }

        if ($verification->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired. Please request a new one.'
            ]);
        }

        // Mark as verified
        $verification->update(['is_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully!'
        ]);
    }

    // Step 3: Complete registration
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        // Check if email is verified
        $verification = EmailVerification::where('email', $request->email)
            ->where('is_verified', true)
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Email not verified. Please verify your email first.'
            ]);
        }

        try {
            $userType = $request->input('user_type');

            // Create user in users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $userType,
            ]);

            // Create role-specific record without duplicating name, email, password
            if ($userType === 'student') {
                Student::create([
                    'user_id' => $user->id,
                    'educational_level' => null,
                ]);
            } elseif ($userType === 'tutor') {
                Tutor::create([
                    'user_id' => $user->id,
                    'rating' => 0,
                ]);
            } elseif ($userType === 'guardian') {
                Guardian::create([
                    'user_id' => $user->id,
                ]);
            }

            // Clean up verification record
            $verification->delete();

            // Automatically log in the user
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Account created successfully! Redirecting to dashboard...'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating your account. Please try again. Error: ' . $e->getMessage()
            ]);
        }
    }
}
