@extends('Frontend.layouts.master')

@section('content')
<div class="container" style="margin-top:5rem;">
    <h1 class="text-center mb-4" style="color: #008000">Contact Us</h1>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-8" style="margin-bottom: 2rem;">
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title" style="color: #008000">Get in Touch</h5>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label"><i class="fas fa-comment-dots"></i> Message</label>
                            <textarea id="message" name="message" rows="5" class="form-control" placeholder="Write your message here" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class=" nums-but">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title" style="color: #008000">Contact Information</h5>
                    <p class="card-text">
                        <strong>Address:</strong> 123 SportEase Street, Cityville<br>
                        <strong>Email:</strong> support@sportease.com<br>
                        <strong>Phone:</strong> +1 (555) 123-4567<br>
                    </p>
                    <h6>Follow Us:</h6>
                    <div>
                        <a href="#" class="btn btn-outline-dark btn-sm me-2 social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-dark btn-sm me-2 social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-dark btn-sm social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <style>
        .social-icon:hover {
            background-color: #008000;
            color: white;
        }
    </style>

@endsection
