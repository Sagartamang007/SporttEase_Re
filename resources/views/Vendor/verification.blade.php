<x-app-layout>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-white py-4 border-0">
                            <h5 class="card-title text-center mb-0">
                                <i class="bi bi-shield-check me-2 text-success"></i>
                                <span class="fw-bold">Vendor Verification</span>
                            </h5>
                        </div>
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('vendor.verification') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Vendor Basic Details -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom d-flex align-items-center">
                                        <i class="bi bi-person-badge me-2 text-primary"></i>Basic Information
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label d-flex align-items-center">
                                                <i class="bi bi-person me-2 text-primary"></i>Owner's Full Name
                                            </label>
                                            <input type="text" class="form-control form-control-lg" id="name"
                                                name="name" placeholder="Enter your full name"
                                                value="{{ old('name', $vendor->name ?? $user_name) }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="company_name" class="form-label d-flex align-items-center">
                                                <i class="bi bi-building me-2 text-primary"></i>Company Name
                                            </label>
                                            <input type="text" class="form-control form-control-lg" id="company_name"
                                                name="company_name" placeholder="Enter your company name"
                                                value="{{ old('company_name', $vendor->company_name ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Documents -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>Business Documents
                                    </h6>

                                    <div class="mb-4">
                                        <label for="document" class="form-label d-flex align-items-center">
                                            <i class="bi bi-file-earmark-pdf me-2 text-primary"></i>Registration
                                            Document
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-upload"></i>
                                            </span>
                                            <input type="file" class="form-control" id="document" name="document">
                                        </div>
                                        <div class="form-text mt-2">Upload your business registration certificate (PDF
                                            or image format)</div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label d-flex align-items-center">
                                                <i class="bi bi-credit-card me-2 text-primary"></i>PAN Card Number
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="pan_card"
                                                placeholder="Enter PAN card number"
                                                value="{{ old('pan_card', $vendor->pan_card ?? '') }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label d-flex align-items-center">
                                                <i class="bi bi-image me-2 text-primary"></i>PAN Card Image
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control" name="pan_card_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Citizenship Documents -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom d-flex align-items-center">
                                        <i class="bi bi-card-heading me-2 text-primary"></i>Citizenship Documents
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label for="front_citizenship_document"
                                                class="form-label d-flex align-items-center">
                                                <i class="bi bi-card-image me-2 text-primary"></i>Front Side
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control"
                                                    name="front_citizenship_document">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="back_citizenship_document"
                                                class="form-label d-flex align-items-center">
                                                <i class="bi bi-card-image me-2 text-primary"></i>Back Side
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control"
                                                    name="back_citizenship_document">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="mb-4 p-3 bg-light rounded-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I confirm that all information provided is accurate and I agree to the <a
                                                href="#" class="text-decoration-none fw-bold">Terms and
                                                Conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit"
                                        class="btn btn-lg py-3 d-flex align-items-center justify-content-center"
                                        style="background-color:#198754;color:white">
                                        <i class="bi bi-check-circle me-2"></i>Submit for Verification
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-3">
                            <div class="alert alert-info mb-0 py-2">
                                <i class="bi bi-info-circle me-2"></i>
                                <small>Your information will be reviewed within 24-48 hours</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /* Custom styles */
        .main {
            background-color: #f8f9fa;
            padding: 2rem 0;
            min-height: 100vh;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-body {
            background-color: #ffffff;
            padding: 2rem;
        }

        .card-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: #343a40;
            font-size: 1.2rem;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #ced4da;
        }

        .form-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .btn:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .form-check-label {
            font-size: 0.95rem;
        }

        /* File input styling */
        input[type="file"] {
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: #e9ecef;
            transition: 0.3s;
            margin-right: 1rem;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #dde0e3;
        }

        /* Responsive behavior */
        @media (max-width: 992px) {
            .card-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main {
                padding: 1rem 0;
            }

            .card-body {
                padding: 1.25rem;
            }

            .form-control,
            .input-group-text {
                font-size: 0.95rem;
            }

            .section-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .card {
                border-radius: 10px;
            }

            .card-body {
                padding: 1rem;
            }

            .form-control,
            .input-group-text {
                font-size: 0.9rem;
                padding: 0.5rem 0.75rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .form-label {
                font-size: 0.9rem;
            }
        }
    </style>
</x-app-layout>
