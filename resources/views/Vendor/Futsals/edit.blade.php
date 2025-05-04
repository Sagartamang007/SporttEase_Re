<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>````plaintext
<main id="main" class="main py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <a href="{{ route('futsal.show', $futsalCourt->id) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="card shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white p-3">
                        <h5 class="mb-0"><i class="fas fa-edit text-success me-2"></i>Edit Futsal Court</h5>
                    </div>

                    <form action="{{ route('futsal.update', $futsalCourt->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="latitude" id="latitude" value="{{ $futsalCourt->latitude }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ $futsalCourt->longitude }}">

                        <div class="card-body p-4">
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Basic Information</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="futsal_name" class="form-label">Futsal Name</label>
                                        <input type="text" name="futsal_name" id="futsal_name"
                                            class="form-control"
                                            value="{{ old('futsal_name', $futsalCourt->futsal_name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="futsal_location" class="form-label">Location</label>
                                        <input type="text" name="futsal_location" id="futsal_location"
                                            class="form-control"
                                            value="{{ old('futsal_location', $futsalCourt->futsal_location) }}" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="futsal_description" class="form-label">Description</label>
                                        <textarea name="futsal_description" id="futsal_description"
                                                class="form-control" rows="3"
                                                required>{{ old('futsal_description', $futsalCourt->futsal_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Court Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="num_court" class="form-label">Number of Courts</label>
                                        <input type="number" name="num_court" id="num_court"
                                            class="form-control"
                                            value="{{ old('num_court', $futsalCourt->num_court) }}" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="hourly_price" class="form-label">Hourly Price (NRs.)</label>
                                        <input type="number" name="hourly_price" id="hourly_price"
                                            class="form-control"
                                            value="{{ old('hourly_price', $futsalCourt->hourly_price) }}" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="opening_time" class="form-label">Opening Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            <input type="time" name="opening_time" id="opening_time"
                                                class="form-control"
                                                value="{{ old('opening_time', $futsalCourt->opening_time) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="closing_time" class="form-label">Closing Time</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            <input type="time" name="closing_time" id="closing_time"
                                                class="form-control"
                                                value="{{ old('closing_time', $futsalCourt->closing_time) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Court Location</h6>
                                <div id="map" style="height: 250px; border-radius: 4px;"></div>
                                <small class="text-muted">Drag the marker or click on the map to update location.</small>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Court Image</h6>

                                <div class="mb-3">
                                    <label for="futsal_image" class="form-label">Upload New Image</label>
                                    <input type="file" name="futsal_image" id="futsal_image" class="form-control">
                                </div>

                                @if ($futsalCourt->futsal_image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div class="border rounded p-2 d-inline-block">
                                            <img src="{{ asset($futsalCourt->futsal_image) }}" alt="Court Image"
                                                class="img-thumbnail" style="height: 120px; width: auto;">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
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
    /* Simple, clean styling */
    body {
        background-color: #f8f9fa;
        color: #212529;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .card-header {
        border-bottom: 1px solid #e9ecef;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .text-success {
        color: #28a745 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 0 10px;
        }

        .card-body {
            padding: 1rem;
        }
    }
</style>


</x-app-layout>
</Actions>`
