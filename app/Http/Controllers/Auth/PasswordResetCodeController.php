<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetCodeController extends Controller
{
    /**
     * Show the code verification form.
     */
    public function showCodeVerificationForm(Request $request)
    {
        return view('auth.verify-code', ['email' => $request->email]);
    }

    /**
     * Verify the reset code.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'numeric', 'digits:6'],
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || $record->code !== $request->code) {
            return back()->withErrors(['code' => 'Invalid verification code.']);
        }

        return redirect()->route('password.resetForm', ['email' => $request->email]);
    }

    /**
     * Show the reset password form.
     */
    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', ['email' => $request->email]);
    }

    /**
     * Reset the password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email.']);
        }

        // Update password
        $user->update(['password' => bcrypt($request->password)]);

        // Delete the reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }
}
