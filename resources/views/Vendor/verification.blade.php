@if(session('success'))
    <div id="alert-success" class="alert alert-success position-fixed top-0 end-0 p-3 fade show" style="z-index: 9999;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="alert-error" class="alert alert-danger position-fixed top-0 end-0 p-3 fade show" style="z-index: 9999;">
        {{ session('error') }}
    </div>
@endif

<!-- Custom CSS -->
<style>
    .alert {
        transition: opacity 0.5s ease-in-out, transform 0.3s ease-in-out;
        max-width: 350px; /* Optional: To limit alert width */
    }

    /* Fade out effect */
    .alert.d-none {
        opacity: 0;
        transform: translateY(-20px);
    }

    /* Success alert specific styles */
    #alert-success {
        background-color: #28a745;
        color: white;
    }

    /* Error alert specific styles */
    #alert-error {
        background-color: #dc3545;
        color: white;
    }
</style>

<script>
    // Hide alert after 5 seconds
    setTimeout(() => {
        // Fade out alert with a custom class after 5 seconds
        const alert = document.getElementById('alert-success') || document.getElementById('alert-error');
        alert?.classList.add('d-none'); // Add d-none class to fade out
    }, 5000);
</script>

<x-app-layout>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card border-0 shadow">
                        <div class="card-header bg-white py-3 border-0">
                            <h5 class="card-title text-center mb-0">
                                <i class="bi bi-shield-check me-2 text-success"></i>
                                <span class="fw-bold">Vendor Verification</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('vendor.verification') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Vendor Basic Details -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom">
                                        <i class="bi bi-person-badge me-2"></i>Basic Information
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                <i class="bi bi-person me-1 text-muted"></i>Owner's Full Name
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="company_name" class="form-label">
                                                <i class="bi bi-building me-1 text-muted"></i>Company Name
                                            </label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Documents -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom">
                                        <i class="bi bi-file-earmark-text me-2"></i>Business Documents
                                    </h6>

                                    <div class="mb-3">
                                        <label for="document" class="form-label">
                                            <i class="bi bi-file-earmark-pdf me-1 text-muted"></i>Registration Document
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-upload"></i>
                                            </span>
                                            <input type="file" class="form-control" id="document" name="document" required>
                                        </div>
                                        <div class="form-text">Upload your business registration certificate (PDF or image format)</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i class="bi bi-credit-card me-1 text-muted"></i>PAN Card Number
                                            </label>
                                            <input type="text" class="form-control" name="pan_card" placeholder="Enter PAN card number" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i class="bi bi-image me-1 text-muted"></i>PAN Card Image
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control" name="pan_card_image" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Citizenship Documents -->
                                <div class="mb-4">
                                    <h6 class="section-title fw-bold mb-3 pb-2 border-bottom">
                                        <i class="bi bi-card-heading me-2"></i>Citizenship Documents
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="front_citizenship_document" class="form-label">
                                                <i class="bi bi-card-image me-1 text-muted"></i>Front Side
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control" name="front_citizenship_document" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="back_citizenship_document" class="form-label">
                                                <i class="bi bi-card-image me-1 text-muted"></i>Back Side
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-upload"></i>
                                                </span>
                                                <input type="file" class="form-control" name="back_citizenship_document" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I confirm that all information provided is accurate and I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-lg px-5 py-2 d-flex align-items-center" style="background-color:#198754;color:white">
                                        <i class="bi bi-check-circle me-2"></i>Submit for Verification
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-3">
                            <small class="text-muted">Your information will be reviewed within 24-48 hours</small>
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
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
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
            color: #495057;
            font-size: 1.1rem;
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
        }

        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
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

        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .form-check-input:checked {
            background-color: #4361ee;
            border-color: #4361ee;
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .verification-progress {
            padding: 1rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .btn-lg {
                width: 100%;
            }

            .verification-progress .badge {
                font-size: 0.7rem;
                padding: 0.35rem 0.5rem;
            }
        }
    </style>
</x-app-layout>
