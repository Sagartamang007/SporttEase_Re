@extends('Frontend.layouts.Master')
@section('content')
    <!-- Hero Section with Background Video -->
    <section class="hero-section">
        <div class="video-wrapper">
            <video autoplay muted loop id="background-video" class="video">
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="overlay"></div>
        <div class="hero-content">
            <div class="container text-center">
                <h1>Welcome to SportEase</h1>
                <p>Your trusted solution for seamless Futsal bookings.</p>
                {{-- <a href="{{Route('booking')}}" class=" nums">Book Now</a> --}}
            </div>
        </div>
    </section>

    <!-- Available Futsal Section -->
    <!-- Swiper Container -->
    <section class="swiper-container py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-xl-8 text-center">
                    <h3 class="mb-4">Available Futsal Courts</h3>
                    <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                        Browse through our futsal courts, check their locations and rates, and book instantly for an
                        exciting game!
                    </p>
                    <a href="{{route('available.futsal')}}" class="btn  mt-3" style="color: #198754;">View Futsals</a>

                </div>
            </div>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse($futsal as $data)
                        <!-- Futsal Card -->
                        <div class="swiper-slide">
                            <div class="card futsal-card shadow-sm">
                                <div class="futsal-image">
                                    @if($data->futsal_images) <!-- Check if images are available -->
                                        <img src="{{ Storage::url(json_decode($data->futsal_images)[0]) }}" alt="Futsal Image"
                                            class="w-100 rounded-top"> <!-- Use the first image as the display -->
                                    @else
                                    <p>No Image</p>
                                    @endif
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="futsal-title mb-3">{{ $data->futsal_name }}</h4> <!-- Futsal Name -->
                                    <p class="futsal-description text-muted">{{ Str::limit($data->futsal_description, 100) }}</p> <!-- Description -->
                                    <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $data->futsal_location }}</p> <!-- Location -->
                                    <p><strong>Number of Courts:</strong> {{ $data->num_court }}</p> <!-- Number of Courts -->
                                    <p><strong>Opening Time:</strong> {{ $data->opening_time }}</p> <!-- Opening Time -->
                                    <p><strong>Closing Time:</strong> {{ $data->closing_time }}</p> <!-- Closing Time -->

                                    <!-- Add Hourly Price -->
                                    <p><strong>Hourly Price:</strong> ${{ number_format($data->hourly_price, 2) }}</p> <!-- Hourly Price -->

                                    <a href="{{ route('booking')}}" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No futsal courts available</p> <!-- Message when no futsal data is available -->
                    @endforelse
                </div>

                <!-- Optional Custom Navigation Arrows -->
                <div class="custom-swiper-button-prev">
                    <i class="fa-solid fa-arrow-left" style="color:rgb(0, 128, 0);"></i>
                </div>
                <div class="custom-swiper-button-next">
                    <i class="fa-solid fa-arrow-right" style="color:rgb(0, 128, 0);"></i>
                </div>
            </div>




    </section>
    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h3 style="color: #198754;">Why Choose SportEase?</h3>
                    <p>Discover the benefits of using our platform for your futsal bookings.</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h5>Seamless Booking</h5>
                        <p>Book futsal courts instantly with just a few clicks.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="fas fa-map-marker-alt fa-3x text-success mb-3"></i>
                        <h5>Convenient Locations</h5>
                        <p>Find futsal courts near you with detailed information.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="fas fa-clock fa-3x text-success mb-3"></i>
                        <h5>Flexible Scheduling</h5>
                        <p>Choose a time slot that fits your schedule and enjoy uninterrupted gameplay.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h3 style="color: #198754;">What Our Users Say</h3>
                    <p>Hear from the players who love SportEase.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 bg-white shadow-sm text-center">
                        <p class="testimonial-text">"SportEase made booking futsal courts so much easier. Highly
                            recommend!"</p>
                        <h6 class="mt-3">- John Doe</h6>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 bg-white shadow-sm text-center">
                        <p class="testimonial-text">"Great platform! I found the best futsal court near me in minutes."</p>
                        <h6 class="mt-3">- Jane Smith</h6>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 bg-white shadow-sm text-center">
                        <p class="testimonial-text">"The seamless booking process is a game changer for futsal lovers."</p>
                        <h6 class="mt-3">- Michael Brown</h6>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 bg-white shadow-sm text-center">
                        <p class="testimonial-text">"The seamless booking process is a game changer for futsal lovers."</p>
                        <h6 class="mt-3">- Michael Brown</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- Call to Action Section -->
    <section class="cta-section py-5 text-white" style="background-color:rgb(0, 128, 0);">
        <div class="container text-center">
            <h3 class="mb-3">Ready to Play?</h3>
            <p>Don't wait! Book your futsal court now and enjoy an amazing game with your friends.</p>
            <a href="{{Route('booking')}}" class="btn btn-light btn-lg">Book Now</a>
        </div>
    </section> --}}



@endsection
