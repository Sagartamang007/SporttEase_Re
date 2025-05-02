<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\futsal_court;

use Carbon\Carbon; // Don't forget to import Carbon if you're using it
use Illuminate\Support\Facades\Auth;



class PageController extends Controller
{
    public function dashboard(){
        $vendorUserId = Auth::id();

        // Get all court ids belonging to this vendor
        $futsalCourtIds = \App\Models\futsal_court::where('user_id', $vendorUserId)->pluck('id');

        // Get bookings where the futsal_court_id is in the list of courts that belong to this vendor
        $totalVendorsUsers = Booking::whereIn('futsal_court_id', $futsalCourtIds)->count();



        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $thisMonthBookings = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        // $canceledBookings = Booking::where('status', 'canceled')->count();
        // $upcomingBookings = Booking::where('status', 'pending')->orderBy('date', 'asc')->take(5)->get();

        return view('vendor.dashboard', compact(
            'totalVendorsUsers',
            'todayBookings',
            // 'thisMonthBookings',
            // 'canceledBookings',
            // 'upcomingBookings'
        ));
    }

    public function futsalform(){
        return view('Vendor.futsalform');
    }

    public function myprofile()
    {
        $user = auth()->user(); // Ensure you have the user instance here
        return view('Vendor.myprofile', compact('user'));
    }
    public function cancelBooking($id)
{
    // Find the booking by ID
    $booking = Booking::findOrFail($id);

    // Check if the booking status is not already 'Cancelled'
    if ($booking->status != 'Cancelled') {
        // Update the status to 'Cancelled'
        $booking->status = 'Cancelled';
        $booking->save();

        // Optionally, send a notification to the customer about the cancellation
        // Notification::send($booking->user, new BookingCancelledNotification($booking));

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

    return redirect()->back()->with('error', 'This booking is already cancelled.');
}
   public function bookings() {
    $id = Auth::id();

    $bookings = Booking::with(['futsal_court', 'user'])
        ->whereHas('futsal_court', function ($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->simplePaginate(2);  // Corrected pagination method

    return view('Vendor.bookings', compact('bookings'));
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
