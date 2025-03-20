<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VendorController; // Ensure this line is included
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home'); // Home route
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus'); // About Us route
Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus'); // Contact Us route
Route::post('/contactus', [PageController::class, 'submit'])->name('contact.submit'); // Form submission
Route::get('/futsals', [PageController::class, 'futsals'])->name('available.futsal'); // Available futsals
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs'); // Blogs page

// Booking Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Show booking form for a specific futsal court by ID
    Route::get('/bookings', [PageController::class, 'booking'])->name('booking'); // Add the ID parameter

    // Store booking
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});


// Vendor Routes (Authenticated Users)
Route::middleware('auth')->prefix('vendor')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Vendor\PageController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/verification', [\App\Http\Controllers\VendorController::class, 'showForm'])->name('vendor.verification');
    Route::post('/verification', [\App\Http\Controllers\VendorController::class, 'submitForm']);


    // Futsal Form for Vendor
    Route::get('/futsal/form', [\App\Http\Controllers\FutsalController::class, 'create'])->name('futsal.create'); // Show form to create futsal
    Route::post('/futsal', [\App\Http\Controllers\FutsalController::class, 'store'])->name('futsal.store');  // Store futsal data

    // Futsal CRUD Routes
    Route::get('/futsals', [\App\Http\Controllers\FutsalController::class, 'index'])->name('futsal.index'); // Display list of futsals
    Route::get('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'show'])->name('futsal.show'); // Show details of a specific futsal
    Route::get('/futsal/{futsalCourt}/edit', [\App\Http\Controllers\FutsalController::class, 'edit'])->name('futsal.edit'); // Show form to edit futsal
    Route::put('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'update'])->name('futsal.update'); // Update futsal data
    Route::delete('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'destroy'])->name('futsal.destroy'); // Delete futsal

    // Vendor Profile Routes
    Route::get('/profile', [\App\Http\Controllers\Vendor\PageController::class, 'myprofile'])->name('vendor.profile');
    Route::patch('/profile/update', [\App\Http\Controllers\Vendor\PageController::class, 'update'])->name('profile.update');

    // Vendor Bookings Routes
    Route::get('/bookings', [\App\Http\Controllers\Vendor\PageController::class, 'bookings'])->name('vendor.bookings');
});

// // Vendor Approval Routes
// Route::middleware('auth')->group(function () {

//     Route::post('/vendor/{id}/approve', [VendorController::class, 'approveVendor'])->name('vendor.approve');
//     Route::post('/vendor/{id}/reject', [VendorController::class, 'rejectVendor'])->name('vendor.reject');
// });

// Authentication Routes
require __DIR__.'/auth.php';
