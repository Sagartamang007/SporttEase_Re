<?php

namespace App\Http\Controllers;

use App\Models\futsal_court;
use Illuminate\Http\Request;
use App\Models\Testimonial;

use App\Models\ContactUs;

class PageController extends Controller
{
    public function home()
    {
        $futsal = futsal_court::get();
        return view('Frontend.pages.home', compact('futsal'));
    }

    public function aboutus()
    {
        return view('Frontend.pages.aboutus');
    }
    public function booking($id)
    {
        $futsal = futsal_court::find($id);

        if (!$futsal) {
            return redirect()->route('futsals')->with('error', 'Futsal Court not found');
        }

        return view('frontend.pages.booking', compact('futsal'));
    }


    public function contactus()
    {
        return view('Frontend.pages.contactus');
    }
    public function futsals()
    {
        $futsals = futsal_court::get();  // Fetch futsal courts from the database

        return view('Frontend.pages.futsals', compact('futsals'));
    }

    public function blogs()
    {
        return view('Frontend.pages.blogs');
    }


    // Add the submit method to handle form submission
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Store the data in the database
        ContactUs::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Redirect back to the contact page with a success message
        return redirect()->route('contactus')->with('success', 'Message sent successfully!');
    }

}
