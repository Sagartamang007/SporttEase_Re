<x-app-layout>
    <main id="main" class="main py-4">
        <div class="container">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('futsal.index') }}" class="btn btn-outline-secondary rounded-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to All Courts
                </a>
            </div>

            <!-- Heading Section -->
            <div class="card mb-4 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="fw-bold mb-2">{{ $futsalCourt->futsal_name }}</h1>
                            <p class="mb-2 text-muted">
                                <i class="bi bi-geo-alt me-1"></i>{{ $futsalCourt->futsal_location }}
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="badge bg-success rounded-3 px-3 py-2">
                                    <i class="bi bi-cash-coin me-1"></i>NRs.{{ $futsalCourt->hourly_price }}/hour
                                </span>
                                <span class="badge bg-success rounded-3 px-3 py-2">
                                    <i class="bi bi-hash me-1"></i>{{ $futsalCourt->num_court }} Courts
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <a href="{{ route('futsal.edit', $futsalCourt->id) }}" class="btn btn-outline-success">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('futsal.destroy', $futsalCourt->id) }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this futsal court?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Court Details Section -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow rounded-3 h-100">
                        <div class="card-header bg-light border-0 py-3">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Court Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Description</h6>
                                <p>{{ $futsalCourt->futsal_description }}</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Operating Hours</h6>
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                    <div>
                                        <small class="text-muted">Opens</small>
                                        <div class="fw-bold">{{ $futsalCourt->opening_time }}</div>
                                    </div>
                                    <div class="text-muted">—</div>
                                    <div class="text-end">
                                        <small class="text-muted">Closes</small>
                                        <div class="fw-bold">{{ $futsalCourt->closing_time }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Pricing</h6>
                                <div class="p-3 bg-light rounded-3 text-center">
                                    <span class="fs-3 fw-bold text-success">${{ $futsalCourt->hourly_price }}</span>
                                    <span class="text-muted"> per hour</span>
                                </div>
                            </div>

                            <div>
                                <h6 class="text-muted mb-2">Facilities</h6>
                                <div class="p-3 bg-light rounded-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-trophy text-success me-2"></i>
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

                <!-- Futsal Images Section -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow rounded-3 h-100">
                        <div class="card-header bg-light border-0 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-images me-2"></i>Court Images</h5>

                        </div>
                        <img src="{{ asset($futsalCourt->futsal_image) }}" alt="Futsal Image" class="w-100 rounded-top">

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<style>
/* Base styles */
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #333;
}

.main {
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Card styles */
.card {
    transition: all 0.2s ease;
}

.card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
}

/* Button styles */
.btn {
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-success, .bg-success {
    background-color: #198754 !important;
    border-color: #198754 !important;
}

.btn-success:hover {
    background-color: #157347 !important;
    border-color: #146c43 !important;
}

.btn-outline-success {
    color: #198754;
    border-color: #198754;
}

.btn-outline-success:hover {
    background-color: #198754;
    color: white;
}

.text-success {
    color: #198754 !important;
}

/* Image styles */
.court-image {
    overflow: hidden;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.court-image:hover img {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.court-image img {
    transition: transform 0.3s ease;
}

.court-image .btn {
    opacity: 0.7;
}

.court-image:hover .btn {
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    h1 {
        font-size: 1.75rem;
    }

    h5 {
        font-size: 1.1rem;
    }

    .card-body {
        padding: 1rem;
    }

    .court-image img {
        height: 160px !important;
    }
}

@media (max-width: 575.98px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .court-image img {
        height: 200px !important;
    }

    .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
}
</style>
