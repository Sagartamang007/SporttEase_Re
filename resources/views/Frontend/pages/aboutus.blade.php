@extends('Frontend.layouts.Master')
@section('content')
<style>
    /* Global Styles */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: #197641; /* SportEase green */
        border-radius: 2px;
    }

    .section-title.text-center::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .section-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 2rem;
    }

    .about-section {
        padding: 5rem 0;
        position: relative;
    }

    .about-section:nth-child(even) {
        background-color: #f8f9fa;
    }

    .about-image {
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.5s ease;
        overflow: hidden;
        height: 100%;
        min-height: 300px;
    }

    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .about-image:hover img {
        transform: scale(1.05);
    }

    /* Team Section Styles */
    .team-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 6rem 0;
        position: relative;
        overflow: hidden;
    }

    .team-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23197641' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .team-section-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .team-section-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #197641, #25a55f);
        margin: 1rem auto 2rem;
        border-radius: 2px;
    }

    .team-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        border: none;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .team-image-wrapper {
        height: 350px;
        overflow: hidden;
        position: relative;
    }

    .team-image {
        transition: transform 0.6s ease;
    }

    .team-card:hover .team-image {
        transform: scale(1.08);
    }

    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(25, 118, 65, 0.85);
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .team-card:hover .team-overlay {
        opacity: 1;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #197641;
        font-size: 1.2rem;
        margin: 0 8px;
        transition: all 0.3s ease;
        transform: translateY(20px);
        opacity: 0;
    }

    .team-card:hover .social-icon {
        transform: translateY(0);
        opacity: 1;
    }

    .team-card:hover .social-icon:nth-child(1) {
        transition-delay: 0.1s;
    }

    .team-card:hover .social-icon:nth-child(2) {
        transition-delay: 0.2s;
    }

    .team-card:hover .social-icon:nth-child(3) {
        transition-delay: 0.3s;
    }

    .social-icon:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        color: white;
        background: #197641;
    }

    .team-info {
        padding: 1.5rem;
        text-align: center;
    }

    .team-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .team-position {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: linear-gradient(to right, #197641, #25a55f);
        color: white;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(25, 118, 65, 0.3);
    }

    /* Why Choose Us Section */
    .why-choose-us {
        padding: 5rem 0;
        background-color: white;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(25, 118, 65, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        color: #197641;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .feature-content h4 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .feature-content p {
        color: #555;
        margin-bottom: 0;
    }

    /* Contact Section */
    .contact-section {
        background: linear-gradient(135deg, #197641 0%, #25a55f 100%);
        padding: 5rem 0;
        color: white;
        text-align: center;
        border-radius: 0 0 50% 50% / 100px;
        margin-bottom: -10px;
    }

    .contact-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }

    .contact-description {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 2rem;
        opacity: 0.9;
    }

    .contact-btn {
        display: inline-block;
        padding: 1rem 2.5rem;
        background: white;
        color: #197641;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        font-size: 1.1rem;
    }

    .contact-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
    }

    /* Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-in.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .section-title {
            font-size: 2.2rem;
        }

        .about-image {
            margin-top: 2rem;
            min-height: 250px;
        }

        .about-section {
            padding: 4rem 0;
        }

        .team-section {
            padding: 4rem 0;
        }
    }

    @media (max-width: 767px) {
        .section-title {
            font-size: 2rem;
        }

        .team-image-wrapper {
            height: 300px;
        }

        .about-section {
            padding: 3rem 0;
        }

        .feature-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .feature-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .contact-section {
            border-radius: 0 0 30% 30% / 50px;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.8rem;
        }

        .team-image-wrapper {
            height: 250px;
        }

        .contact-title {
            font-size: 2rem;
        }

        .contact-description {
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="about-hero position-relative" style="background: linear-gradient(135deg, #197641 0%, #25a55f 100%); padding: 6rem 0 8rem; color: white; overflow: hidden;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-in">
                <h1 style="font-size: 3.5rem; font-weight: 800; margin-bottom: 1.5rem;">About SportEase</h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 2rem; line-height: 1.8;">
                    We're revolutionizing the way sports enthusiasts book and manage their favorite sports facilities.
                </p>
                <a href="#mission" class="btn btn-light btn-lg px-4 py-2" style="font-weight: 600; border-radius: 50px;">
                    Learn More
                    <i class="fas fa-arrow-down ms-2"></i>
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('futsal.jpg') }}" class="img-fluid rounded-3 shadow-lg" alt="SportEase Platform"
                     style="transform: perspective(1000px) rotateY(-15deg) rotateX(5deg); box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
            </div>
        </div>
    </div>
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100px; background: white; border-radius: 100% 100% 0 0;"></div>
</div>

<div class="container">
    <!-- Welcome Section -->
    <section class="about-section" id="mission">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-in">
                <h2 class="section-title">Welcome to SportEase</h2>
                <p class="section-description">
                    At SportEase, we provide a seamless and user-friendly platform for booking futsal courts and other sports facilities. Our mission is to make it easy for sports enthusiasts to find and book their favorite sports venues quickly and efficiently, ensuring a smooth experience for both users and facility managers.
                </p>
                <div class="d-flex align-items-center mb-4">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                        <i class="fas fa-users" style="color: #197641; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; margin-bottom: 5px;">User-Centered Design</h5>
                        <p class="mb-0" style="color: #555;">Built with the user experience as our top priority.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                        <i class="fas fa-bolt" style="color: #197641; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; margin-bottom: 5px;">Fast & Efficient</h5>
                        <p class="mb-0" style="color: #555;">Book your favorite sports venue in just a few clicks.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 fade-in">
                <div class="about-image">
                    <img src="{{ asset('futsal.jpg') }}" alt="SportEase Platform">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="about-section">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 fade-in">
                <h2 class="section-title">Our Mission</h2>
                <p class="section-description">
                    We aim to revolutionize the sports booking experience by offering a digital solution that simplifies the process. Whether you're a sports enthusiast or a facility manager, we strive to make the booking process as easy as possible, so you can focus on what matters: playing and enjoying the game!
                </p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div style="background: rgba(25, 118, 65, 0.1); border-radius: 10px; padding: 20px; height: 100%;">
                            <i class="fas fa-calendar-check mb-3" style="color: #197641; font-size: 2rem;"></i>
                            <h5 style="font-weight: 700;">Simplified Booking</h5>
                            <p class="mb-0" style="color: #555; font-size: 0.9rem;">Easy-to-use interface for quick reservations</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div style="background: rgba(25, 118, 65, 0.1); border-radius: 10px; padding: 20px; height: 100%;">
                            <i class="fas fa-clock mb-3" style="color: #197641; font-size: 2rem;"></i>
                            <h5 style="font-weight: 700;">Real-time Updates</h5>
                            <p class="mb-0" style="color: #555; font-size: 0.9rem;">Live availability of all sports facilities</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1 fade-in">
                <div class="about-image">
                    <img src="{{ asset('miss.jpg') }}" alt="Our Mission">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Vision Section -->
    <section class="about-section">
        <div class="row fade-in">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title text-center">Our Vision</h2>
                <p class="section-description">
                    Our vision is to become the leading platform for sports bookings, offering users a reliable, easy-to-use service that is available at their fingertips. We aim to expand our platform, continually adding new sports facilities and improving user experience with advanced features and integrations.
                </p>
                <div class="row mt-5">
                    <div class="col-md-4 mb-4">
                        <div style="background: white; border-radius: 15px; padding: 30px 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); height: 100%;">
                            <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-globe" style="color: #197641; font-size: 2rem;"></i>
                            </div>
                            <h5 style="font-weight: 700;">Global Reach</h5>
                            <p style="color: #555; font-size: 0.95rem;">Expanding our services worldwide</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div style="background: white; border-radius: 15px; padding: 30px 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); height: 100%;">
                            <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-chart-line" style="color: #197641; font-size: 2rem;"></i>
                            </div>
                            <h5 style="font-weight: 700;">Continuous Growth</h5>
                            <p style="color: #555; font-size: 0.95rem;">Adding new features and facilities</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div style="background: white; border-radius: 15px; padding: 30px 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); height: 100%;">
                            <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="fas fa-handshake" style="color: #197641; font-size: 2rem;"></i>
                            </div>
                            <h5 style="font-weight: 700;">Strong Partnerships</h5>
                            <p style="color: #555; font-size: 0.95rem;">Collaborating with sports facilities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Our Team Section -->
<section class="team-section">
    <div class="container">
        <div class="row mb-5 fade-in">
            <div class="col-12 text-center">
                <h2 class="team-section-title">Meet Our Team</h2>
                <div class="team-section-divider"></div>
                <p class="section-description text-center" style="max-width: 700px; margin: 0 auto;">
                    Our talented professionals are dedicated to excellence and innovation, working together to provide you with the best sports booking experience.
                </p>
            </div>
        </div>

        <div class="row">
            @if ($teams->isEmpty())
                <div class="col-12 text-center py-5 fade-in">
                    <div style="background: white; border-radius: 16px; padding: 4rem 2rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: rgba(25, 118, 65, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                            <i class="fas fa-users" style="color: #197641; font-size: 3rem;"></i>
                        </div>
                        <h3 style="font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">Our Team is Growing</h3>
                        <p style="color: #555; max-width: 500px; margin: 0 auto 2rem;">
                            We're currently building our team of passionate professionals. Check back soon to meet the people behind SportEase!
                        </p>
                        <a href="{{ route('contactus') }}" class="btn btn-outline-success px-4 py-2" style="border-radius: 50px; font-weight: 600;">
                            Join Our Team
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            @else
                @foreach ($teams as $team)
                    <div class="col-lg-4 col-md-6 mb-4 fade-in">
                        <div class="team-card">
                            <div class="team-image-wrapper">
                                <img src="{{ asset('storage/' . $team->image) }}" class="team-image w-100 h-100" alt="{{ $team->name }}" style="object-fit: cover;">
                                {{-- <div class="team-overlay">
                                    <a href="#" class="social-icon">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="social-icon">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="social-icon">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div> --}}
                            </div>
                            <div class="team-info">
                                <h4 class="team-name">{{ $team->name }}</h4>
                                <div class="team-position">{{ $team->designation }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us">
    <div class="container">
        <div class="row mb-5 fade-in">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title text-center">Why Choose SportEase?</h2>
                <p class="section-description text-center">
                    We're committed to providing the best sports booking experience with features designed to make your life easier.
                </p>
            </div>
        </div>

        <div class="row fade-in">
            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>User-Friendly Interface</h4>
                        <p>Our intuitive platform makes booking sports facilities quick and hassle-free, saving you time and effort.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Real-Time Availability</h4>
                        <p>Get instant updates on facility availability, ensuring you always have the most current information.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Secure Payments</h4>
                        <p>Our platform offers multiple secure payment options, giving you peace of mind with every transaction.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Dedicated Support</h4>
                        <p>Our customer support team is always ready to assist you with any questions or concerns.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Regular Updates</h4>
                        <p>We continuously improve our platform with new features and enhancements based on user feedback.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Facility Locations</h4>
                        <p>Easily find sports venues near you with our integrated mapping and location services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section fade-in">
    <div class="container">
        <h2 class="contact-title">Get In Touch With Us</h2>
        <p class="contact-description">
            Have questions or feedback? We'd love to hear from you! Our team is ready to assist you with any inquiries.
        </p>
        <a href="{{ route('contactus') }}" class="contact-btn">
            Contact Us
            <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<script>
    // Fade-in animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in');

        const fadeInOnScroll = function() {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        };

        // Initial check
        fadeInOnScroll();

        // Check on scroll
        window.addEventListener('scroll', fadeInOnScroll);
    });
</script>
@endsection
