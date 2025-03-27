@extends('Frontend.layouts.master')

@section('content')
<div class="container contact-container">
    <div class="section-header text-center mb-5">
        <h1 class="display-4 fw-bold text-success mb-2">Contact Us</h1>
        <div class="header-underline bg-success mx-auto"></div>
        <p class="text-muted mt-3">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-lg-8 col-md-7 mb-4 mb-md-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4 p-lg-5">
                    <h3 class="card-title text-success mb-4"><i class="fas fa-paper-plane me-2"></i>Get in Touch</h3>
                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <!-- Name -->
                        <div class="form-floating mb-4">
                            <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter your name" required>
                            <label for="name"><i class="fas fa-user text-success me-2"></i>Your Name</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                            <label for="email"><i class="fas fa-envelope text-success me-2"></i>Your Email</label>
                        </div>

                        <!-- Message -->
                        <div class="form-floating mb-4">
                            <textarea id="message" name="message" rows="5" class="form-control form-control-lg" style="height: 150px" placeholder="Write your message here" required></textarea>
                            <label for="message"><i class="fas fa-comment-dots text-success me-2"></i>Your Message</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="book-now-btn send-message-btn">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-lg-4 col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h3 class="card-title text-success mb-4"><i class="fas fa-address-card me-2"></i>Contact Information</h3>

                    <div class="contact-info">
                        <div class="contact-item mb-4">
                            <div class="contact-icon bg-light text-success rounded-circle">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h6 class="mb-1">Our Location</h6>
                                <p class="text-muted mb-0">123 SportEase Street, Cityville</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon bg-light text-success rounded-circle">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h6 class="mb-1">Email Address</h6>
                                <p class="text-muted mb-0">support@sportease.com</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon bg-light text-success rounded-circle">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h6 class="mb-1">Phone Number</h6>
                                <p class="text-muted mb-0">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="text-center mb-3">Follow Us</h5>
                    <div class="social-links d-flex justify-content-center">
                        <a href="#" class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced styling for contact page */
    .contact-container {
        margin-top: 6rem;
        margin-bottom: 6rem;
    }

    .header-underline {
        height: 4px;
        width: 80px;
        border-radius: 2px;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #008000;
        box-shadow: 0 0 0 0.25rem rgba(0, 128, 0, 0.25);
    }

    .book-now-btn {
        background-color: #008000;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .book-now-btn:hover {
        background-color: #006400;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 128, 0, 0.2);
    }

    .send-message-btn {
        padding: 12px 30px;
        font-size: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .contact-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .contact-text {
        flex-grow: 1;
    }

    .social-links {
        gap: 15px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .social-icon:hover {
        background-color: #008000;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 128, 0, 0.2);
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 8px;
        padding: 15px;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .contact-container {
            margin-top: 4rem;
            margin-bottom: 4rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .send-message-btn {
            width: 100%;
        }
    }
</style>

<script>
    // Auto-dismiss success alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });
</script>
@endsection
