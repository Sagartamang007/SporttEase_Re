<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type === 2) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'You do not have admin access');
    }
}
