<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: black;width:100%">
    <div class="container-fluid" style="width:80%"> <!-- Added padding to push content inside -->
        <!-- Brand -->
        <a class="navbar-brand" href="/" style="font-size: 24px; font-weight: bold;">
            SportEase
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="gap: 10px;">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('aboutus') }}">About Us</a></li>

                <li class="nav-item"><a class="nav-link" href="{{route('blogs')}}">Blogs</a></li>

                <li class="nav-item"><a class="nav-link" href="{{route('contactus')}}">Contact Us</a></li>

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="signupDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sign Up
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="signupDropdown" style="left: -76px;">
                            <li><a class="dropdown-item" href="{{ route('register') }}">As User</a></li>
                            <li><a class="dropdown-item" href="{{ route('Vendorcreate') }}">As Vendor</a></li>
                        </ul>
                    </li>
                @endguest

                @auth
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Use the icon if the user does not have a profile picture -->
                            @if(auth()->user()->profile_picture)
                                <img src="{{ auth()->user()->profile_picture }}" alt="Profile Picture"
                                     style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                            @else
                                <!-- Default icon when there is no profile picture -->
                                <i class="fa-regular fa-user" style="font-size: 30px;"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#">My Bookings</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Separate Styles -->
<style>
    /* Navbar Dropdown Hover */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    /* Dropdown Toggle Icon */
    .dropdown-icon {
        margin-left: 5px;
        transition: transform 0.3s ease;
    }

    /* Rotate icon on hover */
    .nav-item.dropdown:hover .dropdown-icon {
        transform: rotate(180deg);
    }

    /* Dropdown Items Hover Effect */
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #000;
    }

    /* Navbar Scroll Effects */
    #navbar.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease;
    }

    #navbar.scrolled .navbar-brand {
        color: #000 !important;
    }
</style>

<!-- Script for Scroll Behavior -->
<script>
    // Listen for the scroll event
    window.addEventListener('scroll', function () {
        const navbar = document.getElementById('navbar');
        const navbarBrand = document.querySelector('.navbar-brand');

        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
