<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\futsal_court;
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
    public function store(LoginRequest $request)
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Check user type and redirect accordingly
        if(Auth::user()->type === 0) {
            // Vendor dashboard
            return view('Vendor.dashboard');
        }
        else if (Auth::user()->type === 1) {
            // Normal user dashboard (futsal data)
            $futsal = futsal_court::all(); // Get all futsal courts
            return view('Frontend.pages.home', ['futsal' => $futsal]); // Normal user page
        }
        else {
            // Owner/Admin dashboard
            return view('superadmin'); // Admin/Owner view
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

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on the user role (if necessary)
        if (Auth::check() && Auth::user()->type === 0) {
            // Vendor-specific logout logic
            return redirect()->route('vendor.login');
        }

        // Default redirection after logout
        return redirect('/');
    }
}
