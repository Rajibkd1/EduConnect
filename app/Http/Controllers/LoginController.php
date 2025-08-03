<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        // Check if user exists first
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $errorMessage = 'No account found with this email address. Please check your email or create a new account.';
        } else if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back to EduConnect! Redirecting to your dashboard...',
                    'redirect' => route('dashboard')
                ]);
            }
            return redirect()->intended('dashboard');
        } else {
            $errorMessage = 'The password you entered is incorrect. Please check your password and try again.';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ]);
        }

        return back()->withErrors([
            'login' => $errorMessage,
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
