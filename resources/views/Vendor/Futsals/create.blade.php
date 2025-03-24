<x-app-layout>
    <style>
        /* Simple CSS with key enhancements */
        .bg-teal {
            background-color: #197684;
        }

        .text-teal {
            color: #197684;
        }

        .border-teal {
            border-color: #197684 !important;
        }

        .btn-teal {
            background-color: #197684;
            border-color: #197684;
            color: white;
        }

        .btn-teal:hover {
            background-color: #156570;
            color: white;
        }

        .form-control:focus {
            border-color: #197684;
            box-shadow: 0 0 0 0.25rem rgba(25, 118, 132, 0.25);
        }

        .required::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }

        .form-section {
            border-left: 4px solid #197684;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #197684;
            background-color: #e6f3f5;
        }
    </style>

    <main id="main" class="main">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Page Title -->
                    <div class="text-center mb-4">
                        <h1 class="text-teal fw-bold">Create Futsal Court</h1>
                        <div class="d-inline-block mx-auto mt-2" style="width: 80px; height: 3px; background-color: #197684;"></div>
                    </div>

                    <!-- Form Card -->
                    <div class="card border-0 shadow-sm mb-5">
                        <div class="card-header bg-teal text-white py-3">
                            <h5 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>
                                New Court Registration
                            </h5>
                        </div>

                        <!-- Form Starts -->
                        <div class="card-body p-4">
                            <form action="{{ route('futsal.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <h5 class="text-teal mb-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Basic Information
                                    </h5>

                                    <div class="row g-3">
                                        <!-- Futsal Name -->
                                        <div class="col-md-6">
                                            <label for="futsal_name" class="form-label fw-bold required">Futsal Name</label>
                                            <input type="text" name="futsal_name" id="futsal_name" class="form-control @error('futsal_name') is-invalid @enderror" placeholder="Enter court name" required>
                                            @error('futsal_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Futsal Location -->
                                        <div class="col-md-6">
                                            <label for="futsal_location" class="form-label fw-bold required">Futsal Location</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-teal text-white">
                                                    <i class="bi bi-geo-alt"></i>
                                                </span>
                                                <input type="text" name="futsal_location" id="futsal_location" class="form-control @error('futsal_location') is-invalid @enderror" placeholder="Enter court location" required>
                                            </div>
                                            @error('futsal_location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mt-3">
                                        <label for="futsal_description" class="form-label fw-bold required">Description</label>
                                        <textarea name="futsal_description" id="futsal_description" class="form-control @error('futsal_description') is-invalid @enderror" rows="4" placeholder="Describe your futsal court, facilities, and amenities..." required></textarea>
                                        @error('futsal_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="bi bi-lightbulb me-1"></i>
                                            Include details about court surface, lighting, changing rooms, parking, etc.
                                        </div>
                                    </div>
                                </div>

                                <!-- Court Details Section -->
                                <div class="form-section">
                                    <h5 class="text-teal mb-3">
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Court Details & Pricing
                                    </h5>

                                    <div class="row g-3">
                                        <!-- Number of Courts -->
                                        <div class="col-md-4">
                                            <label for="num_court" class="form-label fw-bold required">Number of Courts</label>
                                            <input type="number" name="num_court" id="num_court" class="form-control @error('num_court') is-invalid @enderror" min="1" value="1" required>
                                            @error('num_court')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Opening Time -->
                                        <div class="col-md-4">
                                            <label for="opening_time" class="form-label fw-bold required">Opening Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-teal text-white">
                                                    <i class="bi bi-clock"></i>
                                                </span>
                                                <input type="time" name="opening_time" id="opening_time" class="form-control @error('opening_time') is-invalid @enderror" required>
                                            </div>
                                            @error('opening_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Closing Time -->
                                        <div class="col-md-4">
                                            <label for="closing_time" class="form-label fw-bold required">Closing Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-teal text-white">
                                                    <i class="bi bi-clock-history"></i>
                                                </span>
                                                <input type="time" name="closing_time" id="closing_time" class="form-control @error('closing_time') is-invalid @enderror" required>
                                            </div>
                                            @error('closing_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Hourly Price -->
                                    <div class="mt-3">
                                        <label for="hourly_price" class="form-label fw-bold required">Hourly Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-teal text-white">
                                                <i class="bi bi-currency-dollar"></i>
                                            </span>
                                            <input type="number" name="hourly_price" id="hourly_price" class="form-control @error('hourly_price') is-invalid @enderror" min="0" step="0.01" placeholder="0.00" required>
                                        </div>
                                        @error('hourly_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image Upload Section -->
                                <div class="form-section">
                                    <h5 class="text-teal mb-3">
                                        <i class="bi bi-image me-2"></i>
                                        Court Image
                                    </h5>

                                    <div class="upload-area" id="upload-area">
                                        <div class="text-center mb-3" id="preview-container">
                                            <img id="image-preview" src="#" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px;">
                                        </div>
                                        <div id="upload-placeholder">
                                            <i class="bi bi-cloud-arrow-up text-teal fs-1 mb-2"></i>
                                            <p class="mb-1">Click to upload an image or drag and drop</p>
                                            <p class="text-muted small">JPEG, PNG or WebP (Max. 5MB)</p>
                                        </div>
                                        <input type="file" name="futsal_image" id="futsal_image" class="d-none @error('futsal_image') is-invalid @enderror" accept="image/*">
                                    </div>
                                    @error('futsal_image')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Form Footer -->
                                <div class="d-flex flex-column flex-md-row gap-3 mt-4 pt-3 border-top">
                                    <button type="submit" class="btn btn-teal">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Save Court
                                    </button>
                                    <a href="{{ route('futsal.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>
                                        Back to Index
                                    </a>
                                </div>
                            </form>
                        </div>
                        <!-- Form Ends -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload functionality
            const imageInput = document.getElementById('futsal_image');
            const imagePreview = document.getElementById('image-preview');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const uploadArea = document.getElementById('upload-area');

            // Click on the upload area to trigger file input
            uploadArea.addEventListener('click', function() {
                imageInput.click();
            });

            // File input change handler
            imageInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight drop area when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.style.borderColor = '#197684';
                uploadArea.style.backgroundColor = '#e6f3f5';
            }

            function unhighlight() {
                uploadArea.style.borderColor = '#ccc';
                uploadArea.style.backgroundColor = '#f8f9fa';
            }

            // Handle dropped files
            uploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            });

            function handleFiles(files) {
                if (files && files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                        uploadPlaceholder.style.display = 'none';
                    }

                    reader.readAsDataURL(files[0]);
                }
            }
        });
    </script>
    @endpush
</x-app-layout>

