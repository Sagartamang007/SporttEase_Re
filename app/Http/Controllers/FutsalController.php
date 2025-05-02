<?php

namespace App\Http\Controllers;

use App\Models\futsal_court;  // Use the correct model name here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FutsalController extends Controller
{
    // // Display a listing of the resource.
    // public function index()
    // {
    //     // $futsalCourts = futsal_court::all();  // Retrieve all futsal courts
    //     $userId = auth()->id(); // Get the currently logged-in user's ID
    //     $futsalCourts = futsal_court::where('user_id', $userId)->get();
    //     return view('Vendor.Futsals.index', compact('futsal_court'));
    // }
// Display a listing of the resource.
public function index()
{
    // Get the currently logged-in user's ID
    $userId = auth()->id();

    // Retrieve futsal courts for the currently logged-in vendor
    $futsalCourts = futsal_court::where('user_id', $userId)->get();

    // Pass the variable to the view
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
        'futsal_image' => 'required|image',
        'latitude'=> 'required',
        'longitude'=> 'required',
    ]);

    $data = $request->all();

    // Handle single image upload and save publicly
    if ($request->hasFile('futsal_image')) {
        $filename = time() . '_' . $request->file('futsal_image')->getClientOriginalName();
        $imagePath = $request->file('futsal_image')->storeAs('futsal_images', $filename, 'public');
        $data['futsal_image'] = 'storage/futsal_images/' . $filename; // Publicly accessible path
    }

    $data['user_id'] = auth()->id();

    futsal_court::create($data);

    return redirect()->route('futsal.index')->with('success', 'Futsal court created successfully!');
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
            'futsal_image' => 'nullable|image', // Image is optional
            'latitude'=> 'required',
            'longitude'=> 'required',
        ]);

        $data = $request->except('futsal_image'); // Get all fields except the image

        // Handle image upload and replacement
        if ($request->hasFile('futsal_image')) {
            // Delete old image
            if ($futsalCourt->futsal_image) {
                $oldImagePath = str_replace('storage/', 'public/', $futsalCourt->futsal_image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Upload new image
            $filename = time() . '_' . $request->file('futsal_image')->getClientOriginalName();
            $imagePath = $request->file('futsal_image')->storeAs('futsal_images', $filename, 'public');

            // Store new image path
            $data['futsal_image'] = 'storage/futsal_images/' . $filename;
        }

        // Update the futsal court details
        $futsalCourt->update($data);

        return redirect()->route('futsal.index')->with('success', 'Futsal court updated successfully!');
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
