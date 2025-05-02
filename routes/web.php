<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\isVendor;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\KhaltiPaymentController;

use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PasswordResetCodeController;
use App\Http\Controllers\Auth\NewPasswordController;

// -------------------------
// 🔹 Public Routes
// -------------------------
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus');
Route::post('/contactus', [PageController::class, 'submit'])->name('contact.submit');
Route::get('/futsals', [PageController::class, 'futsals'])->name('available.futsal');
Route::get('/futsal/{id}', [PageController::class, 'showFutsal'])->name('futsal.details');

Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blog/{id}', [PageController::class, 'show'])->name('blogs.show');


Route::post('/purchase/{booking_id}', [KhaltiPaymentController::class, 'purchase'])->name('khalti.purchase');
Route::get('/verify-payment', [KhaltiPaymentController::class, 'verifyPayment']);
Route::post('/khalti/verify', [BookingController::class, 'verifyKhalti'])->name('khalti.verify');
Route::get('/bookings/success', function () {
    return view('Frontend.booking_success');
})->name('bookings.success');

Route::post('/bookings/store-with-payment/{futsal}', [BookingController::class, 'storeWithPayment'])->name('bookings.store.with.payment');


// -------------------------
// 🔹 Authenticated User Routes (Profile & Booking)
// -------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bookings/{id}', [PageController::class, 'booking'])->name('booking');
    Route::get('/my-bookings', [UserBookingController::class, 'index'])->name('user.bookings');
    // In routes/web.php

    Route::patch('booking/cancel/{id}', [UserBookingController::class, 'cancelBooking'])->name('booking.cancel');
    Route::post('/bookings/{id}', [BookingController::class, 'store'])->name('bookings.store');

    Route::get('pre/bookings', [BookingController::class, 'preBooking'])->name('pre.booking');
    Route::get('pre/futsal/{id}', [BookingController::class, 'showFutsal'])->name('pre.futsal.details');
    Route::post('pre/bookings/{id}', [BookingController::class, 'preStore'])->name('pre.booking.store');
});

// -------------------------
// 🔹 Vendor Verification Routes (Before Approval)
// -------------------------
Route::middleware(['auth', 'isVendor'])->prefix('vendor')->group(function () {
    Route::get('/verification', [VendorController::class, 'showForm'])->name('vendor.verification');
    Route::post('/verification', [VendorController::class, 'submitForm']);
});

// -------------------------
// 🔹 Vendor Routes (Approved Vendors)
// -------------------------
Route::middleware(['auth', 'isVendor', 'isVendorApproved'])->prefix('vendor')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Vendor\PageController::class, 'dashboard'])->name('vendor.dashboard');


            // Futsal Form for Vendor
            Route::get('/futsal/form', [\App\Http\Controllers\FutsalController::class, 'create'])->name('futsal.create');
            Route::post('/futsal', [\App\Http\Controllers\FutsalController::class, 'store'])->name('futsal.store');
        // Futsal CRUD Routes
        Route::get('/futsals', [\App\Http\Controllers\FutsalController::class, 'index'])->name('futsal.index');
        Route::get('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'show'])->name('futsal.show');
        Route::get('/futsal/{futsalCourt}/edit', [\App\Http\Controllers\FutsalController::class, 'edit'])->name('futsal.edit');
        Route::put('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'update'])->name('futsal.update');
        Route::delete('/futsal/{futsalCourt}/delete', [\App\Http\Controllers\FutsalController::class, 'destroy'])->name('futsal.destroy');

    // ✅ Vendor Profile
    Route::get('/profile', [\App\Http\Controllers\Vendor\PageController::class, 'myprofile'])->name('vendor.profile');
    Route::patch('/profile/update', [\App\Http\Controllers\Vendor\PageController::class, 'update'])->name('vendor.profile.update');

    // ✅ Vendor Bookings
    Route::get('/bookings', [\App\Http\Controllers\Vendor\PageController::class, 'bookings'])->name('vendor.bookings');
    Route::put('/vendor/cancel-booking/{id}', [\App\Http\Controllers\Vendor\PageController::class, 'cancelBooking'])->name('vendor.cancelBooking');

});

// -------------------------
// 🔹 Admin Authentication Routes
// -------------------------
Route::get('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

// -------------------------
// 🔹 Admin Panel Routes (Authenticated Admins)
// -------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // ✅ Manage Blogs
    Route::prefix('blogs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blogs.index'); // List all blogs
        Route::get('/create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])->name('blogs.create'); // Show create form
        Route::post('/', [\App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blogs.store'); // Store new blog
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('blogs.edit'); // Show edit form
        Route::put('/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blogs.update'); // Update blog
        Route::delete('/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('blogs.destroy'); // Delete blog
    });

    // ✅ Manage Vendors
    Route::prefix('vendors')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\VendorController::class, 'index'])->name('admin.vendors');
        Route::get('/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'showVendor'])->name('admin.vendors.show');
        Route::post('/approve/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'approve'])->name('admin.approveVendor');
        Route::post('/reject/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'reject'])->name('admin.rejectVendor');
        Route::post('/pending/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'pending'])->name('admin.pendingVendor');
    });

    // ✅ Manage Teams
    Route::prefix('team')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('team.index');
        Route::get('/create', [TeamController::class, 'create'])->name('team.create');
        Route::post('/', [TeamController::class, 'store'])->name('team.store');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('team.edit');
        Route::put('/{team}', [TeamController::class, 'update'])->name('team.update');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('team.destroy');
    });

    // ✅ Admin Profile
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
});

// -------------------------
// 🔹 Password Reset Using 6-Digit Code
// -------------------------
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/verify-code', [PasswordResetCodeController::class, 'showCodeVerificationForm'])->name('password.verifyCodeForm');
    Route::post('/verify-code', [PasswordResetCodeController::class, 'verifyCode'])->name('password.verifyCode');
    Route::get('/reset-password', [PasswordResetCodeController::class, 'showResetForm'])->name('password.resetForm');
    Route::post('/reset-password', [PasswordResetCodeController::class, 'resetPassword'])->name('password.update');
});

// -------------------------
// 🔹 404 Fallback
// -------------------------
Route::fallback(fn () => response()->view('404', [], 404));

// 🔹 Authentication Routes
require __DIR__ . '/auth.php';
