<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetCodeMail;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the forgot password form.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle sending the password reset code.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Check if the user exists (Users and Vendors only)
        $user = User::where('email', $request->email)->whereIn('type', [0, 1])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No vendor or user found with this email.']);
        }

        // Generate 6-digit verification code
        $code = mt_rand(100000, 999999);

        // Store the code in the password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'code' => $code,
                'created_at' => Carbon::now(),
            ]
        );

        // Send the verification code via email
        Mail::to($request->email)->send(new PasswordResetCodeMail($code));

        // Redirect to the verify code page
        return redirect()->route('password.verifyCodeForm', ['email' => $request->email])
            ->with('status', 'A 6-digit verification code has been sent to your email.');
    }

    /**
     * Show the form to verify the reset code.
     */
    public function showCodeVerificationForm(Request $request)
    {
        return view('auth.verify-code', ['email' => $request->email]);
    }
}
