<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class isVendorRejected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and if they have a vendor
        $vendor = Auth::user()->vendor ?? null;

        // If the vendor does not exist or is not approved, redirect to verification or other page
        if ($vendor && $vendor->status === 'approved') {
            return redirect()->route('vendor.dashboard');
        }

        // Allow the request to proceed if vendor is approved
        return $next($request);
    }
}
