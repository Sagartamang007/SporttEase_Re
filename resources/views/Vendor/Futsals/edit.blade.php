<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <main id="main" class="main py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="{{ route('futsal.show', $futsalCourt->id) }}" class="btn btn-outline-dark rounded-3 shadow-sm">
                            <i class="bi bi-arrow-left me-2"></i>Back to Court Details
                        </a>
                    </div>

                    <!-- Form Card -->
                    <div class="card border-0 shadow-sm rounded-3 mb-5">
                        <!-- Header with Progress -->
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box bg-success text-white me-3">
                                    <i class="bi bi-pencil"></i>
                                </div>
                                <div>
                                    <h1 class="fs-4 fw-bold mb-0">Edit Futsal Court</h1>
                                    <p class="text-muted mb-0">{{ $futsalCourt->futsal_name }}</p>
                                </div>
                            </div>

                            <!-- Progress Tabs -->
                            <ul class="nav nav-tabs form-tabs" id="formTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-selected="true">
                                        <i class="bi bi-info-circle me-2"></i>Basic Info
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#court-details" type="button" role="tab" aria-selected="false">
                                        <i class="bi bi-gear me-2"></i>Court Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#court-images" type="button" role="tab" aria-selected="false">
                                        <i class="bi bi-images me-2"></i>Images
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Form Starts -->
                        <form action="{{ route('futsal.update', $futsalCourt->id) }}" method="POST" enctype="multipart/form-data" id="courtForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="latitude" id="latitude" value="{{ $futsalCourt->latitude }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ $futsalCourt->longitude }}">
                            <div class="mt-4">
                                <label for="map" class="form-label fw-bold">Update Location on Map</label>
                                <div id="map" style="height: 300px; border-radius: 8px;"></div>
                                <small class="text-muted">Drag the marker or click on the map to update location.</small>
                            </div>

                            <div class="card-body p-4">
                                <div class="tab-content" id="formTabContent">
                                    <!-- Basic Information Tab -->
                                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab">
                                        <div class="p-2">
                                            <div class="row g-4">
                                                <!-- Futsal Name -->
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="futsal_name" id="futsal_name"
                                                            class="form-control"
                                                            value="{{ old('futsal_name', $futsalCourt->futsal_name) }}" required>
                                                        <label for="futsal_name">Futsal Name</label>
                                                    </div>
                                                </div>

                                                <!-- Futsal Location -->
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="futsal_location" id="futsal_location"
                                                            class="form-control"
                                                            value="{{ old('futsal_location', $futsalCourt->futsal_location) }}" required>
                                                        <label for="futsal_location">Location</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="mt-4">
                                                <div class="form-floating">
                                                    <textarea name="futsal_description" id="futsal_description"
                                                            class="form-control" style="height: 120px"
                                                            required>{{ old('futsal_description', $futsalCourt->futsal_description) }}</textarea>
                                                    <label for="futsal_description">Description</label>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4 pt-3">
                                                <div></div>
                                                <button type="button" class="btn btn-success px-4 next-tab" data-next="details-tab">
                                                    Next <i class="bi bi-arrow-right ms-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Court Details Tab -->
                                    <div class="tab-pane fade" id="court-details" role="tabpanel" aria-labelledby="details-tab">
                                        <div class="p-2">
                                            <div class="row g-4">
                                                <!-- Number of Courts -->
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" name="num_court" id="num_court"
                                                            class="form-control"
                                                            value="{{ old('num_court', $futsalCourt->num_court) }}" required>
                                                        <label for="num_court">Number of Courts</label>
                                                    </div>
                                                </div>

                                                <!-- Hourly Price -->
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" name="hourly_price" id="hourly_price"
                                                            class="form-control"
                                                            value="{{ old('hourly_price', $futsalCourt->hourly_price) }}" required>
                                                        <label for="hourly_price">Hourly Price (NRs.)</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-4 mt-3">
                                                <!-- Opening Time -->
                                                <div class="col-md-4">
                                                    <label class="form-label">Opening Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-sunrise"></i></span>
                                                        <input type="time" name="opening_time" id="opening_time"
                                                            class="form-control"
                                                            value="{{ old('opening_time', $futsalCourt->opening_time) }}" required>
                                                    </div>
                                                </div>

                                                <!-- Closing Time -->
                                                <div class="col-md-4">
                                                    <label class="form-label">Closing Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-sunset"></i></span>
                                                        <input type="time" name="closing_time" id="closing_time"
                                                            class="form-control"
                                                            value="{{ old('closing_time', $futsalCourt->closing_time) }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4 pt-3">
                                                <button type="button" class="btn btn-outline-secondary px-4 prev-tab" data-prev="basic-tab">
                                                    <i class="bi bi-arrow-left me-2"></i> Previous
                                                </button>
                                                <button type="button" class="btn btn-success px-4 next-tab" data-next="images-tab">
                                                    Next <i class="bi bi-arrow-right ms-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Court Images Tab -->
                                    <div class="tab-pane fade" id="court-images" role="tabpanel" aria-labelledby="images-tab">
                                        <div class="p-2">
                                            <!-- Futsal Images (Upload) -->
                                            <div class="mb-4">
                                                <div class="upload-area p-4 text-center border rounded-3 bg-light position-relative">
                                                    <i class="bi bi-cloud-arrow-up display-4 text-success mb-2"></i>
                                                    <h5>Upload New Images</h5>
                                                    <p class="text-muted mb-3">Drag and drop files here or click to browse</p>
                                                    <input type="file" name="futsal_images[]" id="futsal_images" class="form-control position-absolute top-0 left-0 opacity-0 w-100 h-100" multiple>
                                                    <div id="file-preview" class="d-flex flex-wrap gap-2 mt-3 justify-content-center"></div>
                                                </div>
                                            </div>

                                            <!-- Existing Images Display -->
                                            @if ($futsalCourt->futsal_images)
                                                <div class="mt-4">
                                                    <h5 class="mb-3">Existing Images</h5>
                                                    <div class="row g-3">
                                                        @foreach (json_decode($futsalCourt->futsal_images) as $index => $image)
                                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                                                <div class="card h-100 border image-card">
                                                                    <div class="position-relative">
                                                                        <img src="{{ Storage::url($image) }}" alt="Court Image"
                                                                            class="card-img-top" style="height: 160px; object-fit: cover;">
                                                                        <div class="image-actions">
                                                                            <a href="{{ Storage::url($image) }}" target="_blank" class="btn btn-sm btn-light rounded-circle">
                                                                                <i class="bi bi-eye"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer bg-white p-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="delete_images[]" value="{{ $index }}"
                                                                                id="delete_image_{{ $index }}">
                                                                            <label class="form-check-label" for="delete_image_{{ $index }}">
                                                                                Remove this image
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="d-flex justify-content-between mt-4 pt-3">
                                                <button type="button" class="btn btn-outline-secondary px-4 prev-tab" data-prev="details-tab">
                                                    <i class="bi bi-arrow-left me-2"></i> Previous
                                                </button>
                                                <button type="submit" class="btn btn-success px-5">
                                                    <i class="bi bi-check2-circle me-2"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Form Ends -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>

// Initialize Leaflet map with saved coords or fallback
const savedLat = parseFloat(document.getElementById('latitude').value) || 27.7172;
const savedLng = parseFloat(document.getElementById('longitude').value) || 85.3240;

const map = L.map('map').setView([savedLat, savedLng], 13);

// Add OSM tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Draggable marker
const marker = L.marker([savedLat, savedLng], { draggable: true }).addTo(map);

// Update inputs on drag
marker.on('dragend', function (e) {
    const pos = marker.getLatLng();
    document.getElementById('latitude').value = pos.lat;
    document.getElementById('longitude').value = pos.lng;
});

// Update marker & inputs on map click
map.on('click', function (e) {
    marker.setLatLng(e.latlng);
    document.getElementById('latitude').value = e.latlng.lat;
    document.getElementById('longitude').value = e.latlng.lng;
});
        </script>

    <style>
    /* Modern, clean styling */
    :root {
        --primary: #198754;
        --primary-dark: #157347;
        --primary-light: #d1e7dd;
        --secondary: #6c757d;
        --light: #f8f9fa;
        --dark: #212529;
        --border-color: #dee2e6;
        --border-radius: 0.375rem;
        --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        --transition: all 0.2s ease-in-out;
    }

    body {
        background-color: var(--light);
        color: var(--dark);
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Icon box */
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Form tabs styling */
    .form-tabs {
        border-bottom: 1px solid var(--border-color);
    }

    .form-tabs .nav-link {
        color: var(--secondary);
        border: none;
        padding: 0.75rem 1rem;
        margin-right: 0.5rem;
        border-bottom: 3px solid transparent;
        border-radius: 0;
        transition: var(--transition);
    }

    .form-tabs .nav-link:hover {
        color: var(--dark);
        background-color: transparent;
        border-bottom-color: var(--border-color);
    }

    .form-tabs .nav-link.active {
        color: var(--primary);
        background-color: transparent;
        border-bottom-color: var(--primary);
        font-weight: 500;
    }

    /* Form controls */
    .form-control {
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    .form-floating > .form-control {
        padding: 1rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--primary);
    }

    .input-group-text {
        background-color: var(--light);
        border: 1px solid var(--border-color);
    }

    /* Upload area */
    .upload-area {
        border: 2px dashed var(--border-color);
        transition: var(--transition);
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: var(--primary);
        background-color: rgba(25, 135, 84, 0.05);
    }

    /* Image card styling */
    .image-card {
        transition: var(--transition);
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .image-actions {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .image-card:hover .image-actions {
        opacity: 1;
    }

    /* Button styling */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        transition: var(--transition);
    }

    .btn-success {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-success:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.5rem rgba(25, 135, 84, 0.2);
    }

    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .form-tabs .nav-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .form-tabs {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .form-tabs .nav-link {
            padding: 0.5rem;
            margin-right: 0.25rem;
            font-size: 0.85rem;
        }

        .form-tabs .nav-link i {
            margin-right: 0 !important;
        }

        .form-tabs .nav-link span {
            display: none;
        }

        .card-body {
            padding: 1rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab navigation
        document.querySelectorAll('.next-tab').forEach(button => {
            button.addEventListener('click', function() {
                const nextTab = this.getAttribute('data-next');
                document.getElementById(nextTab).click();
            });
        });

        document.querySelectorAll('.prev-tab').forEach(button => {
            button.addEventListener('click', function() {
                const prevTab = this.getAttribute('data-prev');
                document.getElementById(prevTab).click();
            });
        });

        // File upload preview
        const fileInput = document.getElementById('futsal_images');
        const filePreview = document.getElementById('file-preview');

        if (fileInput && filePreview) {
            fileInput.addEventListener('change', function() {
                filePreview.innerHTML = '';

                if (this.files) {
                    Array.from(this.files).forEach(file => {
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const preview = document.createElement('div');
                                preview.className = 'position-relative';
                                preview.innerHTML = `
                                    <img src="${e.target.result}" alt="${file.name}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    <span class="position-absolute top-0 end-0 badge bg-success rounded-circle">
                                        <i class="bi bi-check"></i>
                                    </span>
                                `;
                                filePreview.appendChild(preview);
                            }

                            reader.readAsDataURL(file);
                        }
                    });
                }
            });
        }
    });
    </script>
</x-app-layout>
