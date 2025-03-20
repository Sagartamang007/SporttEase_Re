<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    // Show the vendor form
    public function showForm()
    {
        return view('vendor.verification');
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
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

        // Handle file uploads and store only the image name
        $documentPath = $request->file('document')->storeAs('', $request->file('document')->getClientOriginalName());
        $panCardImagePath = $request->file('pan_card_image')->storeAs('', $request->file('pan_card_image')->getClientOriginalName());
        $frontCitizenshipPath = $request->file('front_citizenship_document')->storeAs('', $request->file('front_citizenship_document')->getClientOriginalName());
        $backCitizenshipPath = $request->file('back_citizenship_document')->storeAs('', $request->file('back_citizenship_document')->getClientOriginalName());

        // Create Vendor record
        Vendor::create([
            'name' => $validatedData['name'],
            'company_name' => $validatedData['company_name'],
            'document' => $documentPath, // Store the file name only
            'pan_card' => $validatedData['pan_card'],
            'pan_card_image' => $panCardImagePath, // Store the file name only
            'front_citizenship_document' => $frontCitizenshipPath, // Store the file name only
            'back_citizenship_document' => $backCitizenshipPath, // Store the file name only
            'status' => 'pending', // Default status
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
