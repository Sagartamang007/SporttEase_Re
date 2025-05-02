<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated vendor
        $vendor = Auth::user();

        // Total bookings for the vendor (all-time bookings)
        $totalBookings = $vendor->vendorBookings()->count();

        // Total bookings for today
        $today = Carbon::today();
        $todayBookings = $vendor->vendorBookings()
            ->whereDate('created_at', $today)
            ->count();

        // $totalVendorsUsers = Booking::where(user_id, $vendor->id)->Count();

        // Returning the view with required data
        return view('Vendor.dashboard', compact('totalBookings', 'todayBookings', 'totalVendorUsers'));
    }
}
