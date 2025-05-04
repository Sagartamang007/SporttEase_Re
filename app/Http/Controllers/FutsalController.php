<?php

namespace App\Http\Controllers;

use App\Models\futsal_court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FutsalController extends Controller
{
    // List all futsal courts for logged-in vendor
    public function index()
    {
        $userId = auth()->id();
        $futsalCourts = futsal_court::where('user_id', $userId)->get();
        return view('Vendor.Futsals.index', compact('futsalCourts'));
    }

    // Show form to create futsal court
    public function create()
    {
        return view('Vendor.Futsals.create');
    }

    // Store a new futsal court
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

        // Handle image upload
        if ($request->hasFile('futsal_image')) {
            $filename = time() . '_' . $request->file('futsal_image')->getClientOriginalName();
            $path = $request->file('futsal_image')->storeAs('futsal_images', $filename, 'public');
            $data['futsal_image'] = 'storage/futsal_images/' . $filename;
        }

        // Assign user_id
        $data['user_id'] = auth()->id();

        // Create the futsal court
        futsal_court::create($data);

        return redirect()->route('futsal.index')->with('success', 'Futsal court created successfully!');
    }

    // Show futsal court details
    public function show(futsal_court $futsalCourt)
    {
        return view('Vendor.Futsals.show', compact('futsalCourt'));
    }

    // Show form to edit futsal court
    public function edit(futsal_court $futsalCourt)
    {
        return view('Vendor.Futsals.edit', compact('futsalCourt'));
    }

    // Update futsal court
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
            'futsal_image' => 'nullable|image',  // Image is optional in update
            'latitude'=> 'required',
            'longitude'=> 'required',
        ]);

        $data = $request->except('futsal_image');  // Exclude the image if not uploaded

        // Handle image update
        if ($request->hasFile('futsal_image')) {
            // Delete old image if it exists
            if ($futsalCourt->futsal_image) {
                $oldImagePath = str_replace('storage/', 'public/', $futsalCourt->futsal_image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Store new image
            $filename = time() . '_' . $request->file('futsal_image')->getClientOriginalName();
            $path = $request->file('futsal_image')->storeAs('futsal_images', $filename, 'public');
            $data['futsal_image'] = 'storage/futsal_images/' . $filename;
        }

        // Update futsal court data
        $futsalCourt->update($data);

        return redirect()->route('futsal.index')->with('success', 'Futsal court updated successfully!');
    }

    // Delete futsal court
    public function destroy(futsal_court $futsalCourt)
    {
        // Delete the image if it exists
        if ($futsalCourt->futsal_image) {
            $imagePath = str_replace('storage/', 'public/', $futsalCourt->futsal_image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Delete the futsal court record
        $futsalCourt->delete();

        return redirect()->route('futsal.index')->with('success', 'Futsal court deleted.');
    }
}
