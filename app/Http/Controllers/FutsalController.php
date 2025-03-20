<?php

namespace App\Http\Controllers;

use App\Models\futsal_court;  // Use the correct model name here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FutsalController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $futsalCourts = futsal_court::all();  // Retrieve all futsal courts
        return view('Vendor.Futsals.index', compact('futsalCourts'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('Vendor.Futsals.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'futsal_name' => 'required',
            'futsal_location' => 'required',
            'futsal_description' => 'required',
            'num_court' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'hourly_price' => 'required|integer',
            'futsal_images.*' => 'required|image',
        ]);

        $data = $request->all();

        // Handle multiple image upload with custom storage path
        $imagePaths = [];
        if ($request->hasFile('futsal_images')) {
            foreach ($request->file('futsal_images') as $image) {
                // Ensure the file is moved to the correct directory after upload
                $imagePath = $image->store('futsal_images', 'public');  // 'public' uses 'storage/app/public'
                $imagePaths[] = $imagePath;
            }
        }

        // Store the images paths as a JSON array in the database
        $data['futsal_images'] = json_encode($imagePaths);
        $data['user_id'] = auth()->id();

        futsal_court::create($data);

        return redirect()->route('futsal.index');
    }


    // Display the specified resource.
    public function show(futsal_court $futsalCourt)
    {
        $futsalCourt->futsal_images = json_decode($futsalCourt->futsal_images);  // Decode images from JSON
        return view('Vendor.Futsals.show', compact('futsalCourt'));
    }

    // Show the form for editing the specified resource.
    public function edit(futsal_court $futsalCourt)
    {
        return view('Vendor.Futsals.edit', compact('futsalCourt'));  // Pass the futsal court to the edit view
    }

    public function update(Request $request, futsal_court $futsalCourt)
    {
        $request->validate([
            'futsal_name' => 'required',
            'futsal_location' => 'required',
            'futsal_description' => 'required',
            'num_court' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'hourly_price' => 'required|integer',
            'futsal_images.*' => 'required|image', // Make images required
        ]);

        $data = $request->all();

        // Handle multiple image upload with custom storage path
        if ($request->hasFile('futsal_images')) {
            // Delete old images from custom path
            $oldImages = json_decode($futsalCourt->futsal_images, true);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    // Check if file exists before attempting to delete it
                    if (Storage::exists('public/' . $oldImage)) {
                        Storage::delete('public/' . $oldImage);
                    }
                }
            }

            // Upload new images
            $imagePaths = [];
            foreach ($request->file('futsal_images') as $image) {
                // Store the new image in the 'futsal_images' directory under 'public'
                $imagePaths[] = $image->store('futsal_images', 'public');
            }

            $data['futsal_images'] = json_encode($imagePaths);  // Store new image paths
        }

        $futsalCourt->update($data);  // Update the futsal court

        return redirect()->route('futsal.index');  // Redirect to the index page
    }


    // Remove the specified resource from storage.
    public function destroy(futsal_court $futsalCourt)
    {
        // Delete the futsal images from custom path
        $oldImages = json_decode($futsalCourt->futsal_images, true);
        if ($oldImages) {
            foreach ($oldImages as $oldImage) {
                // Check if file exists before attempting to delete it
                if (Storage::exists('public/' . $oldImage)) {
                    Storage::delete('public/' . $oldImage);
                }
            }
        }

        $futsalCourt->delete();  // Delete the futsal court

        return redirect()->route('futsal.index');  // Redirect to the index page
    }
}
