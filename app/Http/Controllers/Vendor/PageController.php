<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(){
        return view('Vendor.dashboard');
    }

    public function futsalform(){
        return view('Vendor.futsalform');
    }

    public function myprofile()
    {
        $user = auth()->user(); // Ensure you have the user instance here
        return view('Vendor.myprofile', compact('user'));
    }

    public function bookings(){
        return view('Vendor.bookings');
    }

    public function verification()
    {
        return view('Vendor.verification');
    }

    public function update(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',  // Optional: Allow name change if needed
            'email' => 'nullable|email|max:255',  // Optional: Allow email change if needed
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'current_password' => 'nullable|string|min:8', // Add validation for current password
            'new_password' => 'nullable|string|min:8|confirmed', // Add validation for new password and confirmation
        ]);

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if current password matches
        if ($request->filled('current_password') && !\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // If a new password is provided, update it
        if ($request->filled('new_password')) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
        }

        // Update other fields if provided
        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email,
            'phone' => $validated['phone'] ?? $user->phone,
            'address' => $validated['address'] ?? $user->address,
        ]);

        // Redirect back with success message
        return back()->with('success', 'Profile updated successfully!');
    }

}
