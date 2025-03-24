<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    // Show the vendor form
    public function showForm()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
$user_name = Auth::user()->name;

        return view('vendor.verification', ['vendor' => $vendor,'user_name' => $user_name]);
    }


    // Handle form submission
    public function submitForm(Request $request) {

        // Validate the form inputs
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'pan_card' => 'required|string|max:50',
            'pan_card_image' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'front_citizenship_document' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'back_citizenship_document' => 'required|file|mimes:jpg,png,jpeg|max:2048',

        ]);

        // Get the logged-in user's ID
        $userId = auth()->id();
        $storagePath = "uploads/{$userId}"; // Folder named after the user ID

        // Handle file uploads and store inside the user-specific folder
        $documentPath = $request->file('document')->storeAs($storagePath, $request->file('document')->getClientOriginalName(), 'public');
        $panCardImagePath = $request->file('pan_card_image')->storeAs($storagePath, $request->file('pan_card_image')->getClientOriginalName(), 'public');
        $frontCitizenshipPath = $request->file('front_citizenship_document')->storeAs($storagePath, $request->file('front_citizenship_document')->getClientOriginalName(), 'public');
        $backCitizenshipPath = $request->file('back_citizenship_document')->storeAs($storagePath, $request->file('back_citizenship_document')->getClientOriginalName(), 'public');

        // Create Vendor record
        Vendor::create([
            'name' => $validatedData['name'],
            'company_name' => $validatedData['company_name'],
            'document' => $documentPath, // Store the file path
            'pan_card' => $validatedData['pan_card'],
            'pan_card_image' => $panCardImagePath, // Store the file path
            'front_citizenship_document' => $frontCitizenshipPath, // Store the file path
            'back_citizenship_document' => $backCitizenshipPath, // Store the file path
            'status' => 'pending', // Default status
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully! Awaiting approval.');
    }


    // Approve Vendor
    public function approveVendor($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'approved']);

        return back()->with('success', 'Vendor approved successfully!');
    }

    // Reject Vendor
    public function rejectVendor($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['status' => 'rejected']);

        return back()->with('error', 'Vendor rejected.');
    }
}
