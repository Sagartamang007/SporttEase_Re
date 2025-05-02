<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FutsalCourt; // ✅ Ensure correct model name
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Redirect based on user type
        if (Auth::user()->type === 0) {
            // Check if the vendor is approved
            if (Auth::user()->approved) {
                // Redirect to the vendor's dashboard if approved
                return redirect()->route('vendor.dashboard');
            } else {
                // Redirect to the vendor verification page if not approved
                return redirect()->route('vendor.verification');
            }
        } elseif (Auth::user()->type === 1) {
            // Normal user dashboard (futsal data)
            return redirect()->route('home');
        } elseif (Auth::user()->type === 2) {
            // Admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Default redirect
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout the user
        Auth::logout();

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
