{{-- <x-app-layout>
    <main id="main" class="main">
        <section class="section dashboard">
            <!-- Header Section with Title and Add Button -->
            <div class="row mb-4">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon me-3">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Futsal Management</h2>
                            <p class="text-muted">Manage your futsal courts and information</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-md-end d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                    <!-- Add Futsal Button -->
                    <button id="addFutsalBtn" class="btn btn-success btn-lg shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> Add Futsal
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <!-- Futsal Information Table -->
                    <div id="futsalTableSection" class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <h5 class="fw-bold mb-0"><i class="bi bi-building me-2 text-success"></i>Futsal Facilities</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search facilities...">
                                        <button class="btn btn-outline-success" type="button">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="noDataMessage" class="text-center py-5">
                                <div class="empty-state-container">
                                    <div class="empty-state-icon bg-light rounded-circle mb-3">
                                        <i class="bi bi-building-x text-muted"></i>
                                    </div>
                                    <h4 class="fw-bold">No Futsal Facilities</h4>
                                    <p class="text-muted mb-4">You haven't added any futsal facilities yet.</p>
                                    <button id="emptyStateAddBtn" class="btn btn-success px-4 py-2">
                                        <i class="bi bi-plus-circle me-2"></i> Add Your First Futsal
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="futsalTable" class="table align-middle" style="display: none;">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Facility</th>
                                            <th>Location</th>
                                            <th>Courts</th>
                                            <th>Operating Hours</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end pe-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample row (This will be added dynamically using JS) -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <p class="text-muted mb-0 small">Showing <span id="itemCount" class="fw-bold">0</span> facilities</p>
                                </div>
                                <div class="col-md-6">
                                    <nav aria-label="Futsal facilities pagination" class="d-flex justify-content-md-end">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Futsal Form Section -->
                    <div id="futsalFormSection" style="display: none;">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0">
                                        <i class="bi bi-building-add me-2 text-success"></i>Add Futsal Information
                                    </h5>
                                    <button id="backToTableBtn" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i> Back to List
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="futsalForm" action="{{route('vendor.submit') }}"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Basic Information Section -->
                                    <div class="mb-4">
                                        <div class="form-section-header d-flex align-items-center mb-3">
                                            <div class="section-icon me-2">
                                                <i class="bi bi-info-circle text-success"></i>
                                            </div>
                                            <h6 class="fw-bold mb-0">Basic Information</h6>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="futsal_name" class="form-label">Name of Futsal</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-building"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="futsal_name" name="futsal_name" placeholder="Enter futsal name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="futsal_location" class="form-label">Location</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-geo-alt"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="futsal_location" name="futsal_location" placeholder="Enter location" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Facility Details Section -->
                                    <div class="mb-4">
                                        <div class="form-section-header d-flex align-items-center mb-3">
                                            <div class="section-icon me-2">
                                                <i class="bi bi-card-checklist text-success"></i>
                                            </div>
                                            <h6 class="fw-bold mb-0">Facility Details</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label for="futsal_description" class="form-label">Description</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-text-paragraph"></i>
                                                </span>
                                                <textarea class="form-control" id="futsal_description" name="futsal_description" rows="4" placeholder="Provide futsal description" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="num_courts" class="form-label">Number of Courts</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-hash"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="num_courts" name="num_court" placeholder="Enter number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="opening_time" class="form-label">Opening Time</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <input type="time" class="form-control" id="opening_time" name="opening_time" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="closing_time" class="form-label">Closing Time</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-clock-history"></i>
                                                    </span>
                                                    <input type="time" class="form-control" id="closing_time" name="closing_time" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="hourly_price" class="form-label">Hourly Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-hash"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="hourly_price" name="hourly_price" placeholder="Enter number" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Media Section -->
                                    <div class="mb-4">
                                        <div class="form-section-header d-flex align-items-center mb-3">
                                            <div class="section-icon me-2">
                                                <i class="bi bi-image text-success"></i>
                                            </div>
                                            <h6 class="fw-bold mb-0">Media</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label for="futsal_image" class="form-label">Futsal Image</label>
                                            <div class="file-drop-area">
                                                <div class="file-message text-center">
                                                    <i class="bi bi-cloud-arrow-up display-4 mb-2 text-muted"></i>
                                                    <p class="mb-1">Drag and drop an image here or click to browse</p>
                                                    <small class="text-muted">Supported formats: JPG, PNG, WEBP (Max 5MB)</small>
                                                </div>
                                                <input type="file" class="file-input" id="futsal_image" name="futsal_image" accept="image/*" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-success btn-lg px-5">
                                            <i class="bi bi-check-circle me-2"></i> Submit Futsal Information
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            background-color: #f8f9fa;
            color: #212529;
        }

        .main {
            padding: 2rem;
        }

        /* Dashboard Header */
        .dashboard-icon {
            width: 50px;
            height: 50px;
            background-color: #e9f7ef;
            color: #198754;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Card Styles */
        .card {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* Empty State */
        .empty-state-container {
            padding: 2rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2rem;
        }

        /* Form Styles */
        .form-section-header {
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .section-icon {
            width: 28px;
            height: 28px;
            background-color: #e9f7ef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.6rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        .input-group-text {
            border-radius: 0.375rem 0 0 0.375rem;
        }

        /* File Upload */
        .file-drop-area {
            position: relative;
            width: 100%;
            min-height: 200px;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-size: cover;
            background-position: center;
            transition: all 0.3s ease;
        }

        .file-drop-area:hover {
            border-color: #198754;
            background-color: #f8f9fa;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-message {
            width: 100%;
            z-index: 1;
        }

        .file-drop-area.has-file .file-message {
            width: 90%;
        }

        /* Table Styles */
        .table thead th {
            font-weight: 600;
            color: #495057;
        }

        .table tbody tr {
            border-bottom: 1px solid #f2f2f2;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Facility Icon */
        .facility-icon {
            width: 40px;
            height: 40px;
            background-color: #e9f7ef;
            color: #198754;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }

        .bg-success-subtle {
            background-color: #d1e7dd !important;
        }

        /* Button Styles */
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
            color: #fff;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .main {
                padding: 1rem;
            }

            .dashboard-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            .file-drop-area {
                min-height: 150px;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const addFutsalBtn = document.getElementById("addFutsalBtn");
    const emptyStateAddBtn = document.getElementById("emptyStateAddBtn"); // When no futsal exists
    const backToTableBtn = document.getElementById("backToTableBtn");

    const futsalTableSection = document.getElementById("futsalTableSection");
    const futsalFormSection = document.getElementById("futsalFormSection");

    function showFutsalForm() {
        futsalTableSection.style.display = "none";  // Hide the table section
        futsalFormSection.style.display = "block";  // Show the form section
    }

    function showFutsalTable() {
        futsalTableSection.style.display = "block"; // Show the table section
        futsalFormSection.style.display = "none";   // Hide the form section
    }

    // Click event to show form
    addFutsalBtn.addEventListener("click", showFutsalForm);
    emptyStateAddBtn.addEventListener("click", showFutsalForm);

    // Click event to go back to the table
    backToTableBtn.addEventListener("click", showFutsalTable);
});

        </script>
</x-app-layout> --}}
