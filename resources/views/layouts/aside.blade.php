<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('vendor.dashboard')}}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Verification -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('vendor.verification')}}">
                <i class="bi bi-shield-lock"></i>
                <span>Verification</span>
            </a>
        </li>

        <!-- Futsal Form -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('futsal.index')}}">
                <i class="bi bi-pencil-square"></i>
                <span>Futsal Form</span>
            </a>
        </li>

        <!-- Bookings -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('vendor.bookings')}}">
                <i class="bi bi-calendar-check"></i>
                <span>Bookings</span>
            </a>
        </li>
    </ul>
</aside>

<!-- Sidebar Toggle Button -->
<button id="toggleSidebarBtn" class="toggle-btn">☰</button>

<style>
    /* General Sidebar Styling */
    (max-width: 1199px) {
    .sidebar {
     display:none;
    }
}
    .sidebar {
        background-color: #f8f9fa;
        position: fixed;
        left: 0;
        top: 3rem;
        padding-top: 20px;
        color: #333;
        border-right: 2px solid #ddd;
        height: calc(100vh - 3rem);
        z-index: 100;
        transition: width 0.3s ease-in-out;
    }

    .sidebar .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar .nav-item {
        position: relative;
        margin: 15px 0;
        padding: 5px 0;
    }
/* Collapsed Sidebar */
.sidebar.collapsed {
    width: 0;
    overflow: hidden;
    transition: width 0.3s ease-in-out;
}

/* Adjust main content when sidebar is collapsed */
.sidebar.collapsed + .main-content {
    margin-left: 0;
}

    /* Sidebar Links */
    .sidebar .nav-link {
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 0 10px;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        color: black;
    }

    .sidebar .nav-link:hover {
        background-color: #198754;
        color: white;
    }

    .sidebar .nav-link:hover i {
        color: white;
    }

    /* Active State */
    .sidebar .nav-item.active {
        border-left: 4px solid #198754;
    }

    .sidebar .nav-item.active .nav-link {
        background-color: #198754;
        color: white;
    }

    .sidebar .nav-item.active .nav-link i {
        color: white;
    }


</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebarBtn');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
        });

        // Function to set active link based on URL
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
