<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;  // Ensure Booking model is imported
use App\Models\futsal_court;  // Ensure Futsal Court model is imported
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'booking_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
        ]);

        // Ensure that the start time is before the end time
        if ($request->start_time >= $request->end_time) {
            return back()->with('error', 'End time must be after start time.');
        }

        // Parse times as DateTime objects
        $startTime = \Carbon\Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $endTime = \Carbon\Carbon::parse($request->booking_date . ' ' . $request->end_time);

        // Check if the time slot is already booked for the selected futsal court and the booking is not cancelled
        $existingBooking = Booking::where('futsal_court_id', $id)
            ->where('date', $request->booking_date)
            ->where('status', '!=', 'cancelled')  // Exclude cancelled bookings
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<', $startTime)
                            ->where('end_time', '>', $endTime);
                      });
            })
            ->exists();

        // If the time slot is already booked, return with an error
        if ($existingBooking) {
            return back()->with('error', 'The selected time slot is already booked.');
        }

        // Save the new booking to the database
        Booking::create([
            'date' => $request->booking_date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'user_id' => Auth::id(),
            'futsal_court_id' => $id,
            'status' => 'confirmed',  // The booking status is set to confirmed initially
        ]);

        return redirect()->back()->with('success', 'Booking created successfully!');
    }

    // List all futsal courts
    public function preBooking()
    {
        // Fetch all futsal courts
        $futsals = futsal_court::get();

        // Return the futsals page view, passing the futsal data
        return view('Frontend.pages.Prefutsals', compact('futsals'));
    }

    // Show futsal details along with the available bookings
    public function showFutsal($id)
    {
        $futsal = futsal_court::find($id);

        if (!$futsal) {
            return redirect()->route('futsals')->with('error', 'Futsal Court not found');
        }

        // Fetch all bookings for the futsal court
        $bookings = Booking::where('futsal_court_id', $id)
            ->get()
            ->map(function ($booking) {
                return [
                    'date' => $booking->date,
                    'start_time' => \Carbon\Carbon::parse($booking->start_time)->format('H:i'),
                    'end_time' => \Carbon\Carbon::parse($booking->end_time)->format('H:i'),
                ];
            });

        // Return the futsal details page with the bookings
        return view('Frontend.pages.prefutsal-details', compact('futsal', 'bookings'));
    }

    // Store multiple bookings for a duration (e.g., weekly or monthly bookings)
    public function preStore(Request $request, $id)
    {
        // Validate inputs
        $validated = $request->validate([
            'booking_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'recurrence_type' => 'required|string',
        ]);

        // Ensure start time is before end time
        if ($request->start_time >= $request->end_time) {
            return back()->with('error', 'End time must be after start time.');
        }

        $startDate = \Carbon\Carbon::parse($request->booking_date);
        $recurrenceType = $request->recurrence_type;
        $datesToBook = [];
        $conflictDates = [];

        // Determine the recurrence count (based on the type selected)
        $recurrenceCount = ($recurrenceType === 'daily') ? 1 : (($recurrenceType === 'weekly') ? 7 : 30);

        // Loop over recurrence count and generate booking dates
        for ($i = 0; $i < 4; $i++) {  // Booking for up to 4 instances (daily, weekly, or monthly)
            $currentDate = $startDate->copy()->addDays($i * $recurrenceCount);

            // Check if the slot is already booked
            $existingBooking = Booking::where('futsal_court_id', $id)
                ->where('date', $currentDate->format('Y-m-d'))
                ->where('status', '!=', 'cancelled')
                ->where(function ($query) use ($startDate, $request) {
                    $query->whereBetween('start_time', [$startDate, $request->end_time])
                        ->orWhereBetween('end_time', [$startDate, $request->end_time])
                        ->orWhere(function ($q) use ($startDate, $request) {
                            $q->where('start_time', '<', $startDate)
                                ->where('end_time', '>', $request->end_time);
                        });
                })
                ->exists();

            if ($existingBooking) {
                $conflictDates[] = $currentDate->format('Y-m-d');
            } else {
                $datesToBook[] = $currentDate;
            }
        }

        // Handle conflicts
        if (!empty($conflictDates)) {
            return back()->with('error', 'The time slot is already booked on these dates: ' . implode(', ', $conflictDates));
        }

        // Create bookings for all available dates
        foreach ($datesToBook as $date) {
            Booking::create([
                'date' => $date->format('Y-m-d'),
                'start_time' => \Carbon\Carbon::parse($date->format('Y-m-d') . ' ' . $request->start_time),
                'end_time' => \Carbon\Carbon::parse($date->format('Y-m-d') . ' ' . $request->end_time),
                'user_id' => Auth::id(),
                'futsal_court_id' => $id,
                'status' => 'Pending/Cash',
            ]);
        }

        return redirect()->back()->with('success', 'Booking created successfully!');
    }


    public function storeWithPayment(Request $request, $futsalId)
    {
        // Save booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'futsal_court_id' => $futsalId,
            'date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
            'payment_method' => 'khalti',
        ]);
        $booking->load("futsal_Court");
        // Return view with Khalti popup
        return view('Frontend.khalti_payment', compact('booking'));
    }


}
