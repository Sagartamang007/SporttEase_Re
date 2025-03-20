<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;  // Ensure Booking model is imported

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'user_name' => 'required|string',
        ]);

        // Access the input values correctly
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $date = $request->input('date');
        $user_name = $request->input('user_name');

        // Create a new booking entry
        $booking = new Booking();
        $booking->date = $date;
        $booking->start_time = $start_time;
        $booking->end_time = $end_time;
        $booking->user_name = $user_name;
        $booking->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Booking confirmed!');
    }
}
