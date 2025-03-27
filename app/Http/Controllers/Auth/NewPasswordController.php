<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NewPasswordController extends Controller
{
    // Show reset password form
    public function create(Request $request)
    {
        return view('auth.passwords.reset', ['email' => $request->email, 'code' => $request->code]);
    }

    // Handle resetting the password
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|numeric|digits:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetRequest = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->first();

        if (!$resetRequest) {
            return back()->withErrors(['code' => 'Invalid or expired verification code.']);
        }

        // Update the user's password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Remove the reset entry
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully.');
    }
}
