<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        try {
            $user = AuthHelper::register($request->all());
            
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard')->with('success', 'Registration successful!');
            }
            
            return back()->with('error', 'Registration failed. Please try again.');
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (AuthHelper::login($credentials, $remember)) {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    /**
     * Handle user logout
     */
    public function logout()
    {
        AuthHelper::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        if (AuthHelper::sendPasswordResetLink($request->email)) {
            return back()->with('success', 'Password reset link sent to your email.');
        }

        return back()->with('error', 'Email not found. Please check and try again.');
    }

    /**
     * Show the reset password form
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (AuthHelper::resetPassword($request->token, $request->password)) {
            return redirect()->route('login')->with('success', 'Password reset successful. Please login with your new password.');
        }

        return back()->with('error', 'Password reset failed. Please try again.');
    }
    
    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
