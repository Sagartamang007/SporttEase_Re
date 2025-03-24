<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; // ✅ Import the middleware
use App\Http\Middleware\isVendor; // ✅ Import the middleware
use App\Http\Middleware\isVendorApproved; // ✅ Import the middleware
use App\Http\Middleware\isVendorRejected; // ✅ Import the middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class, // ✅ Register Admin Middleware
            'isVendor' => isVendor::class, // ✅ Register Admin Middleware
            'isVendorApproved' => isVendorApproved::class, // ✅ Register Admin Middleware
            'isVendorRejected' => isVendorRejected::class, // ✅ Register Admin Middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
