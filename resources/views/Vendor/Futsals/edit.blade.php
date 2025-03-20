<x-app-layout>
    <main id="main" class="main">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="{{ route('futsal.show', $futsalCourt->id) }}" class="btn btn-outline-success rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Back to Court Details
                        </a>
                    </div>

                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <div class="card-header bg-gradient-success text-white p-4" style="background: linear-gradient(to right, #198754, #0f5132);">
                            <h1 class="text-center mb-0 fs-3 fw-bold">
                                <i class="bi bi-pencil-square me-2"></i>Edit Futsal Court
                            </h1>
                            <p class="text-center text-white-50 mb-0 mt-2">Update information for "{{ $futsalCourt->futsal_name }}"</p>
                        </div>

                        <!-- Form Starts -->
                        <form action="{{ route('futsal.update', $futsalCourt->id) }}" method="POST" enctype="multipart/form-data" class="card-body p-4 p-lg-5">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Futsal Name -->
                                <div class="col-md-6">
                                    <label for="futsal_name" class="form-label fw-bold text-success">
                                        <i class="bi bi-building me-1"></i> Futsal Name
                                    </label>
                                    <input type="text" name="futsal_name" id="futsal_name"
                                           class="form-control form-control-lg border-success-subtle rounded-pill shadow-sm"
                                           value="{{ old('futsal_name', $futsalCourt->futsal_name) }}" required>
                                </div>

                                <!-- Futsal Location -->
                                <div class="col-md-6">
                                    <label for="futsal_location" class="form-label fw-bold text-success">
                                        <i class="bi bi-geo-alt me-1"></i> Location
                                    </label>
                                    <input type="text" name="futsal_location" id="futsal_location"
                                           class="form-control form-control-lg border-success-subtle rounded-pill shadow-sm"
                                           value="{{ old('futsal_location', $futsalCourt->futsal_location) }}" required>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mt-4">
                                <label for="futsal_description" class="form-label fw-bold text-success">
                                    <i class="bi bi-card-text me-1"></i> Description
                                </label>
                                <textarea name="futsal_description" id="futsal_description"
                                          class="form-control border-success-subtle rounded-3 shadow-sm" rows="4"
                                          required>{{ old('futsal_description', $futsalCourt->futsal_description) }}</textarea>
                            </div>

                            <div class="row g-4 mt-3">
                                <!-- Number of Courts -->
                                <div class="col-md-6">
                                    <label for="num_court" class="form-label fw-bold text-success">
                                        <i class="bi bi-hash me-1"></i> Number of Courts
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-success text-white border-0"><i class="bi bi-hash"></i></span>
                                        <input type="number" name="num_court" id="num_court"
                                               class="form-control border-success-subtle rounded-end shadow-sm"
                                               value="{{ old('num_court', $futsalCourt->num_court) }}" required>
                                    </div>
                                </div>

                                <!-- Hourly Price -->
                                <div class="col-md-6">
                                    <label for="hourly_price" class="form-label fw-bold text-success">
                                        <i class="bi bi-currency-dollar me-1"></i> Hourly Price
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-success text-white border-0"><i class="bi bi-currency-dollar"></i></span>
                                        <input type="number" name="hourly_price" id="hourly_price"
                                               class="form-control border-success-subtle rounded-end shadow-sm"
                                               value="{{ old('hourly_price', $futsalCourt->hourly_price) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mt-3">
                                <!-- Opening Time -->
                                <div class="col-md-6">
                                    <label for="opening_time" class="form-label fw-bold text-success">
                                        <i class="bi bi-clock me-1"></i> Opening Time
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-success text-white border-0"><i class="bi bi-clock"></i></span>
                                        <input type="time" name="opening_time" id="opening_time"
                                               class="form-control border-success-subtle rounded-end shadow-sm"
                                               value="{{ old('opening_time', $futsalCourt->opening_time) }}" required>
                                    </div>
                                </div>

                                <!-- Closing Time -->
                                <div class="col-md-6">
                                    <label for="closing_time" class="form-label fw-bold text-success">
                                        <i class="bi bi-clock-history me-1"></i> Closing Time
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-success text-white border-0"><i class="bi bi-clock-history"></i></span>
                                        <input type="time" name="closing_time" id="closing_time"
                                               class="form-control border-success-subtle rounded-end shadow-sm"
                                               value="{{ old('closing_time', $futsalCourt->closing_time) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Futsal Images (Upload) -->
                            <div class="mt-4">
                                <label for="futsal_images" class="form-label fw-bold text-success">
                                    <i class="bi bi-cloud-upload me-1"></i> Upload New Images (Optional)
                                </label>
                                <div class="card border-success-subtle rounded-3 p-3 bg-light">
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white border-0"><i class="bi bi-images"></i></span>
                                        <input type="file" name="futsal_images[]" id="futsal_images" class="form-control border-success-subtle" multiple>
                                    </div>
                                </div>
                            </div>

                            <!-- Existing Images Display -->
                            @if ($futsalCourt->futsal_images)
                                <div class="mt-4">
                                    <label class="form-label fw-bold text-success">
                                        <i class="bi bi-images me-1"></i> Existing Images
                                    </label>
                                    <div class="card border-success-subtle rounded-3 p-3">
                                        <div class="row g-3">
                                            @foreach (json_decode($futsalCourt->futsal_images) as $index => $image)
                                                <div class="col-md-3 col-sm-4 col-6">
                                                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                                                        <img src="{{ Storage::url($image) }}" alt="Court Image"
                                                             class="card-img-top" style="height: 120px; object-fit: cover;">
                                                        <div class="card-body p-2 text-center">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="delete_images[]" value="{{ $index }}"
                                                                       id="delete_image_{{ $index }}">
                                                                <label class="form-check-label" for="delete_image_{{ $index }}">
                                                                    Select to delete
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-text mt-3">
                                            <i class="bi bi-exclamation-triangle text-warning me-1"></i>
                                            Check the boxes to delete selected images when updating
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('futsal.show', $futsalCourt->id) }}" class="btn btn-outline-success btn-lg rounded-pill px-4">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                                    <i class="bi bi-check2-circle me-2"></i>Update Court
                                </button>
                            </div>
                        </form>
                        <!-- Form Ends -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
    .bg-gradient-success {
        background: linear-gradient(to right, #198754, #0f5132);
    }

    .text-success {
        color: #198754 !important;
    }

    .border-success-subtle {
        border-color: rgba(25, 135, 84, 0.3) !important;
    }

    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }

    .btn-outline-success {
        color: #198754;
        border-color: #198754;
    }

    .btn-outline-success:hover {
        background-color: #198754;
        border-color: #198754;
        color: white;
    }

    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }

    /* Add a subtle green tint to the card */
    .card {
        border-color: rgba(25, 135, 84, 0.1);
    }

    /* Add a subtle hover effect to the image cards */
    .card:hover img {
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    /* Improve the form controls focus state */
    .form-control:focus,
    .form-check-input:focus {
        border-color: rgba(25, 135, 84, 0.5);
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    </style>
</x-app-layout>
