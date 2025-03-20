<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('vendor.dashboard')}}" class="logo d-flex align-items-center" style="text-decoration: none;">
            <span class="d-none d-lg-block" id="sidebarName">SportEase</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn" id="toggleSidebarBtn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (auth()->check())
                        <!-- Display User Icon -->
                        <i class="bi bi-person-circle rounded-circle" style="font-size: 20px; margin-right: 10px;"></i>
                        <!-- Display Vendor Name -->
                        <span class="ms-2 nav-profile-name">{{ auth()->user()->name }}</span>
                    @else
                        <!-- Default when not logged in -->
                        <i class="bi bi-person" style="font-size: 30px;"></i>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        @if (auth()->check())
                            <h6>{{ auth()->user()->name }}</h6>
                        @else
                            <h6>Guest</h6>
                        @endif
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @if (auth()->check())
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('vendor.profile')}}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('profile.edit')}}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li> --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>
                    @else
                        <!-- Display Login Link for Guests -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    @endif
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<style>
    /* Header Styles */
    .header {
        background-color: #fff;
        border-bottom: 1px solid #e9ecef;
        height: 60px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 0 1.5rem;
        z-index: 1020;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: #198754;
    }

    .toggle-sidebar-btn {
        font-size: 1.5rem;
        cursor: pointer;
        color: #6c757d;
        transition: color 0.3s ease;
    }

    .toggle-sidebar-btn:hover {
        color: #198754;
    }

    /* Profile Dropdown Styles */
    .nav-profile {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
    }

    .nav-profile-name {
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-profile-name:hover {
        color: #198754 !important;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        padding: 0.5rem 0;
        min-width: 200px;
    }

    .dropdown-header {
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .dropdown-header h6 {
        margin: 0;
        font-weight: 600;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        color: #333;
        transition: all 0.2s ease;
    }

    .dropdown-item i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
        color: #6c757d;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #198754;
    }

    .dropdown-item:hover i {
        color: #198754;
    }

    .dropdown-divider {
        margin: 0.25rem 0;
        border-color: #e9ecef;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .header {
            padding: 0 1rem;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebarBtn');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
    });

    // Set active link based on the URL
    function setActiveNavItem() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar .nav-item .nav-link');

        document.querySelectorAll('.sidebar .nav-item').forEach(item => {
            item.classList.remove('active');
        });

        let activeFound = false;
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            let hrefPath = href;
            if (href && href.includes('://')) {
                const url = new URL(href);
                hrefPath = url.pathname;
            }

            if (hrefPath && (currentPath === hrefPath || currentPath.startsWith(hrefPath) && hrefPath !== '/')) {
                link.closest('.nav-item').classList.add('active');
                activeFound = true;
            }
        });

        if (!activeFound && currentPath.includes('vendor')) {
            const dashboardItem = document.querySelector('.nav-link[href*="dashboard"]');
            if (dashboardItem) {
                dashboardItem.closest('.nav-item').classList.add('active');
            }
        }
    }

    setActiveNavItem();
});
</script>
