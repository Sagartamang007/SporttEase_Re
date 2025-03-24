    <?php

    use App\Http\Controllers\PageController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\TestimonialController;
    use App\Http\Controllers\BookingController;
    use App\Http\Controllers\VendorController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Middleware\isVendor;
    use App\Http\Controllers\Admin\TeamController;


    // Public Routes
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
    Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus');
    Route::post('/contactus', [PageController::class, 'submit'])->name('contact.submit');
    Route::get('/futsals', [PageController::class, 'futsals'])->name('available.futsal');
    Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{id}', [PageController::class, 'show'])->name('blogs.show');


    // Booking Routes (Authenticated Users)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Show booking form for a specific futsal court by ID
        Route::get('/bookings/{id}', [PageController::class, 'booking'])->name('booking');

        // Store booking
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    });
    Route::middleware(['auth','isVendor','isVendorRejected'])->prefix('vendor')->group(function () {

    Route::get('/verification', [VendorController::class, 'showForm'])->name('vendor.verification');
    Route::post('/verification', [VendorController::class, 'submitForm']);
    });
    // Vendor Routes (Authenticated Users)
    Route::middleware(['auth','isVendor','isVendorApproved'])->prefix('vendor')->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Vendor\PageController::class, 'dashboard'])->name('vendor.dashboard');

        // Futsal Form for Vendor
        Route::get('/futsal/form', [\App\Http\Controllers\FutsalController::class, 'create'])->name('futsal.create');
        Route::post('/futsal', [\App\Http\Controllers\FutsalController::class, 'store'])->name('futsal.store');

        // Futsal CRUD Routes
        Route::get('/futsals', [\App\Http\Controllers\FutsalController::class, 'index'])->name('futsal.index');
        Route::get('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'show'])->name('futsal.show');
        Route::get('/futsal/{futsalCourt}/edit', [\App\Http\Controllers\FutsalController::class, 'edit'])->name('futsal.edit');
        Route::put('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'update'])->name('futsal.update');
        Route::delete('/futsal/{futsalCourt}', [\App\Http\Controllers\FutsalController::class, 'destroy'])->name('futsal.destroy');

        // Vendor Profile Routes
        Route::get('/profile', [\App\Http\Controllers\Vendor\PageController::class, 'myprofile'])->name('vendor.profile');
        Route::patch('/profile/update', [\App\Http\Controllers\Vendor\PageController::class, 'update'])->name('vendor.profile.update');

        // Vendor Bookings Routes
        Route::get('/bookings', [\App\Http\Controllers\Vendor\PageController::class, 'bookings'])->name('vendor.bookings');
    });

    // Admin Authentication Routes
    Route::get('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/admin/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    // Admin Routes (Authenticated Admins)
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
             // Dashboard
            Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

            // ✅ Manage Blogs
            Route::get('/blogs', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blogs');
            Route::get('/blogs/create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blogs.create');
            Route::post('/blogs/store', [\App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blogs.store');
            Route::get('/blogs/edit/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blogs.edit');
            // Change this route from POST to PUT or PATCH for blog update
            Route::put('/blogs/update/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blogs.update');
            Route::delete('/blogs/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blogs.destroy');

         // Vendor Management
        Route::get('/vendors', [\App\Http\Controllers\Admin\VendorController::class, 'index'])->name('admin.vendors');
        Route::get('/vendors/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'showVendor'])->name('admin.vendors.show');


        Route::post('/vendors/approve/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'approve'])->name('admin.approveVendor');
        Route::post('/vendors/reject/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'reject'])->name('admin.rejectVendor');
        Route::post('/vendors/pending/{id}', [\App\Http\Controllers\Admin\VendorController::class, 'pending'])->name('admin.pendingVendor');
        //Team managemnt
    Route::get('/team', [\App\Http\Controllers\Admin\TeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [\App\Http\Controllers\Admin\TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [\App\Http\Controllers\Admin\TeamController::class, 'store'])->name('team.store');
    Route::get('/team/{team}/edit', [\App\Http\Controllers\Admin\TeamController::class, 'edit'])->name('team.edit');
    Route::put('/team/{team}', [\App\Http\Controllers\Admin\TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{team}', [\App\Http\Controllers\Admin\TeamController::class, 'destroy'])->name('team.destroy');

        // Admin Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile/update', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    });
    Route::fallback(function () {
        return response()->view('404', [], 404);
    });
    // Authentication Routes
    require __DIR__.'/auth.php';
