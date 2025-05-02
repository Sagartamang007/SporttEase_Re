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
                    <a href="{{ route('available.futsal') }}" class="btn  mt-3" style="color: #198754;">View Futsals</a>

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
                                        <img src="{{ asset($data->futsal_image) }}" alt="Futsal Image" class="futsal-img">
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="futsal-title mb-3">{{ $data->futsal_name }}</h4> <!-- Futsal Name -->
                                        <p class="futsal-description text-muted">
                                            {{ Str::limit($data->futsal_description, 100) }}</p> <!-- Description -->
                                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i>
                                            {{ $data->futsal_location }}</p> <!-- Location -->
                                        <p><strong>Number of Courts:</strong> {{ $data->num_court }}</p>
                                        <!-- Number of Courts -->
                                        <p><strong>Opening Time:</strong> {{ $data->opening_time }}</p>
                                        <!-- Opening Time -->
                                        <p><strong>Closing Time:</strong> {{ $data->closing_time }}</p>
                                        <!-- Closing Time -->
                                        <p><strong>Hourly Price:</strong> NRs.{{ number_format($data->hourly_price, 2) }}</p>
                                        <!-- Hourly Price -->

                                        <a href="{{ route('booking', $data->id) }}" class="book-now-btn">Book Now</a>
                                        <a href="{{ route('futsal.details', $data->id) }}" class="book-now-btn">View Details</a>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p>No futsal courts available</p>
                    @endforelse
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
<!-- Testimonials Section -->
<section class="testimonials-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23197641\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.5;"></div>

    <div class="container position-relative">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem; position: relative; display: inline-block;">
                    What Our Users Say
                    <div style="width: 80px; height: 4px; background: linear-gradient(to right, #197641, #25a55f); margin: 1rem auto 0; border-radius: 2px;"></div>
                </h2>
                <p style="font-size: 1.1rem; color: #555; max-width: 700px; margin: 1rem auto 0;">Hear from the players and facility managers who love using SportEase for their sports booking needs.</p>
            </div>
        </div>

        <div class="testimonial-wrapper position-relative" style="margin: 0 auto; max-width: 1200px;">
            <!-- Testimonial Container with Enhanced Styling -->
            <div class="testimonial-container" style="overflow: hidden; position: relative; padding: 10px 0;">
                <div class="testimonial-track d-flex" style="transition: transform 0.5s ease-in-out;">
                    <!-- Testimonial 1 -->
                    <div class="testimonial-item" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box;">
                        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #555; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1;">
                                "SportEase made booking futsal courts so much easier. The interface is intuitive, and I can book my favorite court in seconds. Highly recommend to all sports enthusiasts!"
                            </p>

                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #197641; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 15px;">JD</div>
                                <div>
                                    <h5 style="font-weight: 700; margin-bottom: 0; color: #2c3e50;">John Doe</h5>
                                    <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">Regular Player</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial-item" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box;">
                        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #555; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1;">
                                "As a facility manager, SportEase has streamlined our booking process. We've seen a 40% increase in court utilization since implementing the system."
                            </p>

                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #197641; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 15px;">SJ</div>
                                <div>
                                    <h5 style="font-weight: 700; margin-bottom: 0; color: #2c3e50;">Sarah Johnson</h5>
                                    <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">Facility Manager</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial-item" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box;">
                        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #555; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1;">
                                "The real-time availability feature is a game-changer. No more calling to check if courts are free - I can see everything at a glance!"
                            </p>

                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #197641; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 15px;">MC</div>
                                <div>
                                    <h5 style="font-weight: 700; margin-bottom: 0; color: #2c3e50;">Michael Chen</h5>
                                    <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">Basketball Coach</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="testimonial-item" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box;">
                        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #555; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1;">
                                "Our tennis club uses SportEase for all our court bookings. The recurring booking feature saves us so much time every month."
                            </p>

                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #197641; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 15px;">LR</div>
                                <div>
                                    <h5 style="font-weight: 700; margin-bottom: 0; color: #2c3e50;">Lisa Rodriguez</h5>
                                    <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">Tennis Club President</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box;">
                        <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #555; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1;">
                                "Our tennis club uses SportEase for all our court bookings. The recurring booking feature saves us so much time every month."
                            </p>

                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #197641; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 15px;">LR</div>
                                <div>
                                    <h5 style="font-weight: 700; margin-bottom: 0; color: #2c3e50;">Lisa Rodriguez</h5>
                                    <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">Tennis Club President</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Controls - Visible on all devices -->
            <div class="text-center mt-4" style="display: flex; justify-content: center; gap: 10px;">
                <button id="prevTestimonial" class="btn btn-sm rounded-circle me-2" style="width: 40px; height: 40px; background: white; color: #197641; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border: none; cursor: pointer; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Pagination Dots -->
                <div class="pagination-dots" style="display: flex; align-items: center; gap: 8px;">
                    <span class="dot active" style="height: 8px; width: 8px; background-color: #197641; border-radius: 50%; display: inline-block; cursor: pointer; transition: all 0.3s ease;"></span>
                    <span class="dot" style="height: 8px; width: 8px; background-color: #e2e8f0; border-radius: 50%; display: inline-block; cursor: pointer; transition: all 0.3s ease;"></span>
                    <span class="dot" style="height: 8px; width: 8px; background-color: #e2e8f0; border-radius: 50%; display: inline-block; cursor: pointer; transition: all 0.3s ease;"></span>
                    <span class="dot" style="height: 8px; width: 8px; background-color: #e2e8f0; border-radius: 50%; display: inline-block; cursor: pointer; transition: all 0.3s ease;"></span>
                </div>

                <button id="nextTestimonial" class="btn btn-sm rounded-circle" style="width: 40px; height: 40px; background: #197641; color: white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border: none; cursor: pointer; transition: all 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>


</section>
    <!-- JavaScript for Slider Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.testimonial-track');
            const items = document.querySelectorAll('.testimonial-item');
            const dots = document.querySelectorAll('.dot');
            const prevButton = document.getElementById('prevTestimonial');
            const nextButton = document.getElementById('nextTestimonial');

            let currentIndex = 0;
            let itemWidth = 0;
            let itemsPerView = 1;
            let autoSlideInterval;

            // Function to update slider based on screen size
            function updateSlider() {
                const containerWidth = track.parentElement.clientWidth;

                // Determine items per view based on screen width
                if (window.innerWidth >= 1200) {
                    itemsPerView = 3;
                } else if (window.innerWidth >= 768) {
                    itemsPerView = 2;
                } else {
                    itemsPerView = 1;
                }

                // Set item width based on container and items per view
                itemWidth = containerWidth / itemsPerView;

                // Update item widths
                items.forEach(item => {
                    item.style.flex = `0 0 ${100 / itemsPerView}%`;
                    item.style.maxWidth = `${100 / itemsPerView}%`;
                });

                // Move to current slide without animation
                goToSlide(currentIndex, false);
            }

            // Function to go to a specific slide
            function goToSlide(index, animate = true) {
                if (index < 0) {
                    index = items.length - itemsPerView;
                } else if (index > items.length - itemsPerView) {
                    index = 0;
                }

                currentIndex = index;

                // If not animating, temporarily remove transition
                if (!animate) {
                    track.style.transition = 'none';
                } else {
                    track.style.transition = 'transform 0.5s ease-in-out';
                }

                // Move the track
                track.style.transform = `translateX(-${currentIndex * (itemWidth)}px)`;

                // Update dots
                dots.forEach((dot, i) => {
                    dot.style.backgroundColor = i === currentIndex ? '#197641' : '#e2e8f0';
                });

                // Re-enable transition after a small delay if it was disabled
                if (!animate) {
                    setTimeout(() => {
                        track.style.transition = 'transform 0.5s ease-in-out';
                    }, 50);
                }
            }

            // Initialize slider
            updateSlider();

            // Start auto-sliding
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    goToSlide(currentIndex + 1);
                }, 5000); // Change slide every 5 seconds
            }

            // Stop auto-sliding
            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Event listeners
            prevButton.addEventListener('click', () => {
                goToSlide(currentIndex - 1);
                stopAutoSlide();
                startAutoSlide(); // Restart timer after manual navigation
            });

            nextButton.addEventListener('click', () => {
                goToSlide(currentIndex + 1);
                stopAutoSlide();
                startAutoSlide(); // Restart timer after manual navigation
            });

            // Add click events to dots
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    goToSlide(i);
                    stopAutoSlide();
                    startAutoSlide(); // Restart timer after manual navigation
                });
            });

            // Pause auto-sliding when hovering over the slider
            track.parentElement.addEventListener('mouseenter', stopAutoSlide);
            track.parentElement.addEventListener('mouseleave', startAutoSlide);

            // Update slider on window resize
            window.addEventListener('resize', updateSlider);

            // Start auto-sliding
            startAutoSlide();

            // If transition was removed, re-add it
            setTimeout(() => {
                track.style.transition = 'transform 0.5s ease-in-out';
            }, 100);
        });
    </script>

@endsection
