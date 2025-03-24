<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all(); // Get all vendors
        return view('admin.pages.vendormanagement', compact('vendors'));
    }
    public function showVendor($id) {
        $vendor = Vendor::with('user')->findOrFail($id);
        return view('admin.pages.detailVendor', compact('vendor'));
    }


    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = 'approved';
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

    public function reject($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = 'rejected';
        $vendor->save();

        return redirect()->back()->with('error', 'Vendor rejected.');
    }
    public function pending($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = 'pending';
        $vendor->save();

        return redirect()->back()->with('error', 'Vendor rejected.');
    }
}
