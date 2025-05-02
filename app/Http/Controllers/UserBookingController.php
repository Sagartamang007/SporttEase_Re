<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    // Display user bookings
    public function index()
    {
        $user = Auth::user();

        $bookings = Booking::where('user_id', $user->id)
                           ->with('futsal_Court')
                           ->latest()
                           ->get();

        return view('Frontend.pages.my_bookings', compact('bookings'));
    }

    public function cancelBooking($bookingId)
{
    // Get the authenticated user
    $user = Auth::user();

    // Find the booking by ID and ensure it belongs to the authenticated user
    $booking = Booking::where('id', $bookingId)
                      ->where('user_id', $user->id)
                      ->first();

    // Check if the booking was found
    if (!$booking) {
        return back()->with('error', 'Booking not found.');
    }

    // Prevent cancellation if the booking is already cancelled
    if ($booking->status === 'cancelled') {
        return back()->with('error', 'This booking is already cancelled.');
    }


    // // Prevent cancelling past or currently running bookings
    // // Combine the date and start time into a single datetime string
    // $bookingStart = Carbon::createFromFormat('Y-m-d H:i:s', $booking->date . ' ' . $booking->start_time);

    // // Check if the booking has already started or is in the past
    // if (now()->gte($bookingStart)) {
    //     return back()->with('error', 'You cannot cancel a booking that is running or already completed.');
    // }

    // Cancel the booking (this affects both user and vendor view)
    $booking->status = 'cancelled';
    $booking->save();

    // Return success message
    return back()->with('success', 'Booking cancelled successfully.');
}

}
