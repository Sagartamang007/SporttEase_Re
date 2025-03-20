<x-app-layout>
    <main id="main" class="main py-5">
        <div class="container">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('futsal.index') }}" class="btn btn-outline-success rounded-pill shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i>Back to All Courts
                </a>
            </div>

            <!-- Heading Section with Banner -->
            <div class="card mb-5 border-0 bg-gradient-success text-white shadow-lg rounded-3 overflow-hidden">
                <div class="card-body p-5 text-center">
                    <h1 class="display-4 fw-bold mb-2">{{ $futsalCourt->futsal_name }}</h1>
                    <p class="lead mb-0">
                        <i class="bi bi-geo-alt-fill me-2"></i>{{ $futsalCourt->futsal_location }}
                    </p>
                    <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
                        <span class="badge bg-white text-success rounded-pill px-3 py-2 fs-6">
                            <i class="bi bi-cash-coin me-1"></i>${{ $futsalCourt->hourly_price }}/hour
                        </span>
                        <span class="badge bg-white text-success rounded-pill px-3 py-2 fs-6">
                            <i class="bi bi-hash me-1"></i>{{ $futsalCourt->num_court }} Courts
                        </span>

                    </div>
                </div>
            </div>


            <div class="row g-4">
                <!-- Futsal Images Section -->
                <div class="col-lg-8 order-lg-1 order-2">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                        <div class="card-header bg-gradient-success text-white p-3 d-flex justify-content-between align-items-center">
                            <h3 class="mb-0"><i class="bi bi-images me-2"></i>Court Images</h3>
                            <span class="badge bg-white text-success rounded-pill px-3 py-2">
                                {{ $futsalCourt->futsal_images ? count(json_decode($futsalCourt->futsal_images)) : 0 }} Photos
                            </span>
                        </div>
                        <div class="card-body p-4">
                            @if ($futsalCourt->futsal_images)
                                <div class="row g-3">
                                    @foreach (json_decode($futsalCourt->futsal_images) as $index => $image)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="position-relative image-hover-zoom">
                                                <img src="{{ Storage::url($image) }}" alt="Court Image"
                                                     class="img-fluid rounded-3 shadow-sm w-100"
                                                     style="height: 200px; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 m-2">
                                                    <a href="{{ Storage::url($image) }}" target="_blank"
                                                       class="btn btn-sm btn-light rounded-circle shadow">
                                                        <i class="bi bi-arrows-fullscreen"></i>
                                                    </a>
                                                </div>
                                                <div class="image-overlay">
                                                    <span class="badge bg-dark bg-opacity-75 rounded-pill px-2 py-1">
                                                        Photo {{ $index + 1 }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-camera-fill text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-3 text-muted">No images available for this court</p>
                                    <a href="{{ route('futsal.edit', $futsalCourt->id) }}" class="btn btn-success btn-sm rounded-pill mt-2">
                                        <i class="bi bi-plus-circle me-1"></i>Add Images
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Futsal Details Section -->
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                        <div class="card-header bg-gradient-success text-white p-3">
                            <h3 class="mb-0"><i class="bi bi-info-circle me-2"></i>Court Details</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-column gap-4">
                                <div>
                                    <h5 class="text-success mb-2"><i class="bi bi-card-text me-2"></i>Description</h5>
                                    <p class="mb-0">{{ $futsalCourt->futsal_description }}</p>
                                </div>

                                <div>
                                    <h5 class="text-success mb-2"><i class="bi bi-clock me-2"></i>Operating Hours</h5>
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-success-subtle rounded-3">
                                        <div>
                                            <i class="bi bi-sunrise text-success me-2"></i>Opens
                                            <div class="fs-5 fw-bold">{{ $futsalCourt->opening_time }}</div>
                                        </div>
                                        <div class="text-muted">to</div>
                                        <div class="text-end">
                                            <i class="bi bi-sunset text-success me-2"></i>Closes
                                            <div class="fs-5 fw-bold">{{ $futsalCourt->closing_time }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="text-success mb-2"><i class="bi bi-currency-dollar me-2"></i>Pricing</h5>
                                    <div class="p-3 bg-success-subtle rounded-3 text-center">
                                        <span class="fs-3 fw-bold text-success">${{ $futsalCourt->hourly_price }}</span>
                                        <span class="text-muted"> / hour</span>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="text-success mb-2"><i class="bi bi-hash me-2"></i>Facilities</h5>
                                    <div class="p-3 bg-success-subtle rounded-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-trophy-fill text-success fs-4 me-3"></i>
                                            <div>
                                                <span class="fw-bold">{{ $futsalCourt->num_court }}</span>
                                                {{ $futsalCourt->num_court > 1 ? 'Courts' : 'Court' }} Available
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Section -->
            <div class="d-flex justify-content-center gap-3 mt-5 flex-wrap">
                <a href="{{ route('futsal.edit', $futsalCourt->id) }}" class="btn btn-warning btn-lg rounded-pill px-4 shadow">
                    <i class="bi bi-pencil-square me-2"></i>Edit Court
                </a>
                <form action="{{ route('futsal.destroy', $futsalCourt->id) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Are you sure you want to delete this futsal court?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg rounded-pill px-4 shadow">
                        <i class="bi bi-trash me-2"></i>Delete Court
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

<style>
/* Main color scheme */
.bg-gradient-success {
    background: linear-gradient(to right, #198754, #0f5132);
}

.text-success {
    color: #198754 !important;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

/* Button styles */
.btn-success {
    background-color: #198754;
    border-color: #198754;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #157347;
    border-color: #146c43;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.2);
}

.btn-outline-success {
    color: #198754;
    border-color: #198754;
    transition: all 0.3s ease;
}

.btn-outline-success:hover {
    background-color: #198754;
    border-color: #198754;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.2);
}

/* Image hover effects */
.image-hover-zoom {
    transition: all 0.3s ease;
    overflow: hidden;
    border-radius: 0.5rem;
    position: relative;
}

.image-hover-zoom:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.image-hover-zoom img {
    transition: all 0.5s ease;
}

.image-hover-zoom:hover img {
    transform: scale(1.1);
}

.image-overlay {
    position: absolute;
    bottom: 10px;
    left: 10px;
    z-index: 2;
    opacity: 0;
    transition: all 0.3s ease;
}

.image-hover-zoom:hover .image-overlay {
    opacity: 1;
}

/* Card enhancements */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

/* Quick actions responsive adjustments */
@media (max-width: 576px) {
    .quick-actions {
        flex-direction: column;
        width: 100%;
    }

    .quick-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .display-4 {
        font-size: 2.5rem;
    }

    .card-body.p-5 {
        padding: 2rem !important;
    }
}

@media (max-width: 767px) {
    .display-4 {
        font-size: 2rem;
    }

    .card-body.p-5 {
        padding: 1.5rem !important;
    }

    .badge.fs-6 {
        font-size: 0.8rem !important;
    }
}

/* Accessibility improvements */
.btn:focus,
.form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

/* Animation for better UX */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Staggered animation for cards */
.row > div:nth-child(1) .card { animation-delay: 0.1s; }
.row > div:nth-child(2) .card { animation-delay: 0.2s; }
</style>
