<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
        public function index()
        {
            // Retrieve all testimonials from the database
            $testimonials = Testimonial::all();

            // Pass testimonials to the view
            return view('Frontend.pages.testimonial', compact('testimonials'));
        }

        public function store(Request $request)
        {
            // Validate the incoming request
            $request->validate([
                'content' => 'required',
                'author_name' => 'required',
            ]);

            // Create a new testimonial
            Testimonial::create([
                'content' => $request->content,
                'author_name' => $request->author_name,
                'user_id' => auth()->id(), // You can store the user ID if logged in
            ]);

            // Redirect back with success message
            return redirect()->route('Frontend.pages.testimonial')->with('success', 'Testimonial submitted successfully!');
        }
    }
     

