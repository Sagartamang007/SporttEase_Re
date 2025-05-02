<?php

namespace App\Http\Controllers;

use App\Models\futsal_court;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\Team;
use App\Models\User;
use App\Models\Booking;


class PageController extends Controller
{

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $relatedBlogs = Blog::where('id', '!=', $id)->latest()->limit(5)->get();
        return view('Frontend.pages.show-blogs', compact('blog','relatedBlogs'));

    }
    public function showFutsal($id)
    {
        $futsal = futsal_court::findOrFail($id);
        return view('Frontend.pages.futsal-details', compact('futsal'));
    }


    // Home page with futsal courts
    public function home()
    {


        // Fetch futsal courts data
        $futsal = futsal_court::get();

        // Return the home page view with futsal data
        return view('Frontend.pages.home', compact('futsal'));
    }

    // About Us page
    public function aboutus()
    {
        $teams = Team::all(); // Fetch all team members
        return view('Frontend.pages.aboutus', compact('teams'));
    }

    // Booking page for a specific futsal court
    public function booking($id)
    {
        $futsal = futsal_court::find($id);

        if (!$futsal) {
            return redirect()->route('futsals')->with('error', 'Futsal Court not found');
        }

        $bookings = Booking::where('futsal_court_id', $id)
            ->get()
            ->map(function ($booking) {
                return [
                    'date' => $booking->date,
                    'start_time' => \Carbon\Carbon::parse($booking->start_time)->format('H:i'),
                    'end_time' => \Carbon\Carbon::parse($booking->end_time)->format('H:i'),
                ];
            });

        return view('frontend.pages.booking', compact('futsal', 'bookings'));
    }



    // Contact Us page
    public function contactus()
    {
        return view('Frontend.pages.contactus');
    }

    // List all futsal courts
    public function futsals()
    {
        // Fetch all futsal courts
        $futsals = futsal_court::get();

        // Return the futsals page view, passing the futsal data
        return view('Frontend.pages.futsals', compact('futsals'));
    }

    // List all blogs (with pagination)
    public function blogs()
    {
        // Fetch latest blogs with pagination (6 blogs per page)
        $blogs = Blog::latest()->paginate(6);


        // Return the blogs page view, passing the blog data
        return view('Frontend.pages.blogs', compact('blogs'));
    }

    // Handle form submission from the Contact Us page
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Store the validated data in the database
        ContactUs::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Redirect back to the contact page with a success message
        return redirect()->route('contactus')->with('success', 'Message sent successfully!');
    }
}
