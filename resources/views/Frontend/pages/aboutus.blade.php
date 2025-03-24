@extends('Frontend.layouts.Master')
@section('content')
    <div class="container py-5">

        <!-- Welcome Section -->
        <div class="row" style="margin-top: 4rem;">
            <div class="col-lg-6">
                <h2>Welcome to SportEase</h2>
                <p style="text-align: justify;">At SportEase, we provide a seamless and user-friendly platform for booking
                    futsal courts and other sports facilities. Our mission is to make it easy for sports enthusiasts to find
                    and book their favorite sports venues quickly and efficiently, ensuring a smooth experience for both
                    users and facility managers.</p>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('futsal.jpg') }}" class="img-fluid rounded" alt="SportEase Platform"
                    style="width: 100%; object-fit: cover;">
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <h2>Our Mission</h2>
                <p style="text-align: justify;">We aim to revolutionize the sports booking experience by offering a digital
                    solution that simplifies the process. Whether you're a sports enthusiast or a facility manager, we
                    strive to make the booking process as easy as possible, so you can focus on what matters: playing and
                    enjoying the game!</p>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('miss.jpg') }}" class="img-fluid rounded" alt="Our Mission"
                    style="width: 100%; object-fit: cover;">
            </div>
        </div>

        <!-- Our Vision Section -->
        <div class="row mt-4">
            <div class="col-12">
                <h2>Our Vision</h2>
                <p style="text-align: justify;">Our vision is to become the leading platform for sports bookings, offering
                    users a reliable, easy-to-use service that is available at their fingertips. We aim to expand our
                    platform, continually adding new sports facilities and improving user experience with advanced features
                    and integrations.</p>
            </div>
        </div>

        <!-- Our Team Section -->
<!-- Our Team Section -->
<div class="row mt-4">
    <div class="col-12">
        <h2>Meet Our Team</h2>
        <div class="row">
            @if ($teams->isEmpty())
                <p>No team members found.</p>
            @else
                @foreach ($teams as $team)
                    <div class="col-md-4 mb-4">
                        <div class="card team-card">
                            <img src="{{ asset('storage/' . $team->image) }}" class="card-img-top"
                                alt="{{ $team->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body" style="color: #fff;">
                                <h5 class="card-title">{{ $team->name }}</h5>
                                <p class="card-text">{{ $team->role }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>



        <!-- Why Choose Us Section -->
        <div class="row mt-4">
            <div class="col-12">
                <h2>Why Choose SportEase?</h2>
                <ul>
                    <li><i class="fas fa-check-circle" style="color: #008000;"></i> Easy-to-use interface for booking sports
                        facilities.</li>
                    <li><i class="fas fa-check-circle" style="color: #008000;"></i> Real-time availability updates for
                        futsal and other sports venues.</li>
                    <li><i class="fas fa-check-circle" style="color: #008000;"></i> Quick booking process with secure
                        payment options.</li>
                    <li><i class="fas fa-check-circle" style="color: #008000;"></i> Customer support available for
                        assistance.</li>
                    <li><i class="fas fa-check-circle" style="color: #008000;"></i> Continuous updates with new features and
                        improvements.</li>
                </ul>
            </div>
        </div>

        <!-- Get In Touch Section -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h2>Get In Touch</h2>
                <p>If you have any questions or feedback, feel free to contact us. We'd love to hear from you!</p>
                <a href="{{ route('contactus') }}" class="book-now-btn">Contact Us</a>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Style the team cards */
    .team-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .card-body {
        position: absolute;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        width: 100%;
        opacity: 0;
        text-align: center;
        padding: 10px 0;
        transition: opacity 0.4s ease-out;
    }

    .team-card:hover .card-body {
        opacity: 1;
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .card-text {
        font-size: 14px;
    }

    /* Optional: Add a subtle shadow effect on hover */
    .team-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
    }
</style>
