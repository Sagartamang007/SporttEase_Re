<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the admin login page.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle the admin login request.
     */
    public function login(Request $request)
    {
        // Validate login input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the logged-in user is an Admin
            if (Auth::user()->type === 2) {
                $request->session()->regenerate(); // Prevent session fixation attacks
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'Access Denied.');
            }
        }

        // Throw error on failed login attempt
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials. Please try again.',
        ]);
    }

    /**
     * Logout the admin user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

}
