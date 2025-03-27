<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
{
    // Validate the request
    $validated = Validator::make($request->all(), [
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    // Check for validation errors
    if ($validated->fails()) {
        return back()->withErrors($validated)->withInput();
    }

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'User not found.']);
    }

    // Update the password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('status', 'Password reset successfully!');
}
}
