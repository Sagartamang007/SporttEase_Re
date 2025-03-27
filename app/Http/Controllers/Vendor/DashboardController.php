<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated vendor
        $vendor = Auth::user();

        // Get total users associated with this vendor
        $totalVendorUsers = User::where('vendor_id', $vendor->id)->count();

        // Get total bookings for this vendor
        $totalBookings = Booking::where('vendor_id', $vendor->id)->count();

        return view('Vendor.dashboard', compact('totalVendorUsers', 'totalBookings'));
    }
}
