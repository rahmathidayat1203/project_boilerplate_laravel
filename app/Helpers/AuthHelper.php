<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthHelper
{
    /**
     * Register a new user
     *
     * @param array $data
     * @return User|false
     */
    public static function register(array $data)
    {
        // Validate data
        $validated = validator($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return $user;
    }

    /**
     * Authenticate a user
     *
     * @param array $credentials
     * @param bool $remember
     * @return bool
     */
    public static function login(array $credentials, bool $remember = false)
    {
        // Validate credentials
        $validated = validator($credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ])->validate();

        // Attempt to login
        return Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ], $remember);
    }

    /**
     * Logout the current user
     *
     * @return void
     */
    public static function logout()
    {
        Auth::logout();
    }

    /**
     * Send password reset link
     *
     * @param string $email
     * @return bool
     */
    public static function sendPasswordResetLink(string $email)
    {
        // Check if user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return false;
        }

        // Generate reset token
        $token = Str::random(60);
        
        // Store token in database (you might want to create a password_resets table)
        // For simplicity, we're storing it directly in the users table
        // In a real application, you'd use Laravel's built-in password reset functionality
        $user->update(['password_reset_token' => $token]);
        
        // Send email (in a real application, you'd use Laravel's Mail facade)
        // Mail::to($email)->send(new PasswordResetEmail($token));
        
        return true;
    }

    /**
     * Reset user password
     *
     * @param string $token
     * @param string $password
     * @return bool
     */
    public static function resetPassword(string $token, string $password)
    {
        // Find user with token
        $user = User::where('password_reset_token', $token)->first();
        
        if (!$user) {
            return false;
        }

        // Update password
        $user->update([
            'password' => Hash::make($password),
            'password_reset_token' => null
        ]);
        
        return true;
    }
}