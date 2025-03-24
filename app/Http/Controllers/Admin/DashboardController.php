<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'pendingVendors' => Vendor::where('status', 'pending')->count(),
            'approvedVendors' => Vendor::where('status', 'approved')->count(),
            'rejectedVendors' => Vendor::where('status', 'rejected')->count(),
            'totalVendors' => Vendor::count(),
            'totalUsers' => User::where('type', 1)->count(),
        ]);
    }
}
