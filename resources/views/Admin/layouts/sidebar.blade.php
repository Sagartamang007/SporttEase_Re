<style>
    /* SportEase Admin Sidebar - Modern & Fully Responsive */
    :root {
        --sidebar-width: 260px;
        --sidebar-collapsed-width: 70px;
        --sidebar-bg-gradient: linear-gradient(135deg, #2c3e50, #1a252f);
        --sidebar-accent: #197641; /* SportEase green */
        --sidebar-hover: rgba(255, 255, 255, 0.1);
        --sidebar-active: rgba(25, 118, 65, 0.2); /* Updated to match new accent */
        --sidebar-text: rgba(255, 255, 255, 0.85);
        --sidebar-text-muted: rgba(255, 255, 255, 0.6);
        --sidebar-border: rgba(255, 255, 255, 0.1);
        --sidebar-icon-size: 20px;
        --sidebar-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --sidebar-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        --danger-color: #e74c3c;
    }

    /* Base Sidebar Styles */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: var(--sidebar-bg-gradient);
        color: var(--sidebar-text);
        padding: 0;
        box-shadow: var(--sidebar-shadow);
        transition: var(--sidebar-transition);
        z-index: 1000;
        overflow-x: hidden;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        scrollbar-width: thin;
        scrollbar-color: var(--sidebar-border) transparent;
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: var(--sidebar-border);
        border-radius: 10px;
    }

    /* Header Section */
    .sidebar-header {
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--sidebar-border);
        min-height: 70px;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-logo-icon {
        width: 36px;
        height: 36px;
        background: var(--sidebar-accent);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }

    .sidebar-logo-text {
        color: white;
        font-size: 18px;
        font-weight: 600;
        white-space: nowrap;
        transition: var(--sidebar-transition);
    }

    /* Navigation Section */
    .sidebar-nav {
        flex: 1;
        padding: 20px 0;
    }

    .sidebar-nav-section {
        margin-bottom: 20px;
    }

    .sidebar-section-title {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--sidebar-text-muted);
        padding: 0 20px;
        margin: 15px 0 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav-item {
        margin: 2px 0;
    }

    .sidebar-nav-link {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: var(--sidebar-text);
        text-decoration: none;
        transition: var(--sidebar-transition);
        border-radius: 0;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .sidebar-nav-link:hover {
        background-color: var(--sidebar-hover);
        color: #fff;
    }

    .sidebar-nav-link.active {
        background-color: var(--sidebar-active);
        color: #fff;
        border-left: 3px solid var(--sidebar-accent);
    }

    .sidebar-nav-link.active .sidebar-icon {
        color: var(--sidebar-accent);
    }

    .sidebar-icon {
        width: var(--sidebar-icon-size);
        height: var(--sidebar-icon-size);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        transition: var(--sidebar-transition);
        flex-shrink: 0;
        font-size: 18px;
    }

    .sidebar-link-text {
        transition: var(--sidebar-transition);
        opacity: 1;
    }

    /* Danger Link (Logout) */
    .sidebar-nav-link.danger {
        color: var(--danger-color);
    }

    .sidebar-nav-link.danger:hover {
        background-color: rgba(231, 76, 60, 0.1);
    }

    .sidebar-nav-link.danger .sidebar-icon {
        color: var(--danger-color);
    }

    /* Footer Section */
    .sidebar-footer {
        padding: 15px 20px;
        border-top: 1px solid var(--sidebar-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: var(--sidebar-transition);
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--sidebar-accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .sidebar-user-info {
        transition: var(--sidebar-transition);
    }

    .sidebar-user-name {
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .sidebar-user-role {
        font-size: 12px;
        color: var(--sidebar-text-muted);
        white-space: nowrap;
    }

    /* Toggle Button */
    .sidebar-toggle {
        position: fixed;
        z-index: 1001;
        background: var(--sidebar-accent);
        color: white;
        border: none;
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: var(--sidebar-transition);
        opacity: 1;
        visibility: visible;
    }

    .sidebar-toggle:hover {
        background: var(--sidebar-accent);
        opacity: 0.9;
    }

    .sidebar-toggle:active {
        transform: scale(0.95);
    }

    /* Hamburger Icon */
    .hamburger-icon {
        width: 22px;
        height: 16px;
        position: relative;
        transform: rotate(0deg);
        transition: .5s ease-in-out;
        cursor: pointer;
    }

    .hamburger-icon span {
        display: block;
        position: absolute;
        height: 2px;
        width: 100%;
        background: white;
        border-radius: 2px;
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: .25s ease-in-out;
    }

    .hamburger-icon span:nth-child(1) {
        top: 0px;
    }

    .hamburger-icon span:nth-child(2), .hamburger-icon span:nth-child(3) {
        top: 7px;
    }

    .hamburger-icon span:nth-child(4) {
        top: 14px;
    }

    /* Hamburger Icon Animation */
    .sidebar.collapsed ~ .sidebar-toggle .hamburger-icon span:nth-child(1) {
        top: 7px;
        width: 0%;
        left: 50%;
    }

    .sidebar.collapsed ~ .sidebar-toggle .hamburger-icon span:nth-child(2) {
        transform: rotate(45deg);
    }

    .sidebar.collapsed ~ .sidebar-toggle .hamburger-icon span:nth-child(3) {
        transform: rotate(-45deg);
    }

    .sidebar.collapsed ~ .sidebar-toggle .hamburger-icon span:nth-child(4) {
        top: 7px;
        width: 0%;
        left: 50%;
    }

    /* Toggle button position and appearance */
    .sidebar-toggle {
        left: calc(var(--sidebar-width) - 20px);
        top: 20px;
    }

    /* Toggle button when sidebar is collapsed */
    .sidebar.collapsed ~ .sidebar-toggle {
        left: 20px;
    }

    /* Badge */
    .sidebar-badge {
        background-color: var(--sidebar-accent);
        color: white;
        border-radius: 10px;
        padding: 2px 8px;
        font-size: 12px;
        margin-left: auto;
        transition: var(--sidebar-transition);
    }

    .sidebar-badge.danger {
        background-color: var(--danger-color);
    }

    /* Main Content Adjustment */
    .main-content {
        margin-left: var(--sidebar-width);
        padding: 20px;
        transition: var(--sidebar-transition);
        min-height: 100vh;
    }

    /* Collapsed State */
    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar.collapsed .sidebar-logo-text,
    .sidebar.collapsed .sidebar-section-title,
    .sidebar.collapsed .sidebar-link-text,
    .sidebar.collapsed .sidebar-user-info {
        opacity: 0;
        visibility: hidden;
    }

    /* Fixed icon display in collapsed state */
    .sidebar.collapsed .sidebar-nav-link {
        justify-content: center;
        padding: 15px 0;
        width: 100%;
        box-sizing: border-box;
    }

    .sidebar.collapsed .sidebar-icon {
        margin-right: 0;
        margin-left: 0;
        font-size: 24px; /* Larger icons when collapsed */
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 24px;
        position: relative;
        left: 0;
    }

    .sidebar.collapsed .sidebar-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        margin-left: 0;
        padding: 2px 5px;
        font-size: 10px;
    }

    .sidebar.collapsed .sidebar-footer {
        justify-content: center;
        padding: 15px 0;
    }

    /* Tooltip for menu items when collapsed */
    .sidebar.collapsed .sidebar-nav-link::after {
        content: attr(data-title);
        position: absolute;
        left: 70px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease;
        white-space: nowrap;
        z-index: 1002;
    }

    .sidebar.collapsed .sidebar-nav-link:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* Tooltip for toggle button */
    .sidebar-toggle::after {
        content: "Hide Menu";
        position: absolute;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        left: 50px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease;
    }

    .sidebar.collapsed ~ .sidebar-toggle::after {
        content: "Show Menu";
    }

    .sidebar-toggle:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* Responsive Breakpoints */
    /* Large Desktop */
    @media (min-width: 1400px) {
        :root {
            --sidebar-width: 280px;
        }
    }

    /* Desktop and Laptop */
    @media (min-width: 992px) and (max-width: 1399px) {
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 991px) {
        :root {
            --sidebar-width: 240px;
        }

        .sidebar {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            transform: translateX(calc(-1 * var(--sidebar-width)));
            width: var(--sidebar-width);
        }

        .sidebar.collapsed .sidebar-logo-text,
        .sidebar.collapsed .sidebar-section-title,
        .sidebar.collapsed .sidebar-link-text,
        .sidebar.collapsed .sidebar-user-info {
            opacity: 1;
            visibility: visible;
        }

        .sidebar.collapsed .sidebar-nav-link {
            justify-content: flex-start;
            padding: 12px 20px;
        }

        .sidebar.collapsed .sidebar-icon {
            margin-right: 12px;
            font-size: 18px;
            width: auto;
        }

        .main-content {
            margin-left: var(--sidebar-width);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Fixed toggle position for tablet */
        .sidebar-toggle {
            left: 20px;
            top: 20px;
        }

        .sidebar.collapsed ~ .sidebar-toggle {
            left: 20px;
        }
    }

    /* Mobile Landscape */
    @media (max-width: 767px) {
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 0;
        }

        .sidebar {
            transform: translateX(0);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            transform: translateX(calc(-1 * var(--sidebar-width)));
            width: var(--sidebar-width);
        }

        .sidebar.collapsed .sidebar-logo-text,
        .sidebar.collapsed .sidebar-section-title,
        .sidebar.collapsed .sidebar-link-text,
        .sidebar.collapsed .sidebar-user-info {
            opacity: 1;
            visibility: visible;
        }

        .sidebar.collapsed .sidebar-nav-link {
            justify-content: flex-start;
            padding: 12px 20px;
        }

        .sidebar.collapsed .sidebar-icon {
            margin-right: 12px;
            font-size: 18px;
            width: auto;
        }

        .main-content {
            margin-left: var(--sidebar-width);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Fixed toggle position for mobile */
        .sidebar-toggle {
            left: 20px;
            top: 20px;
        }

        .sidebar.collapsed ~ .sidebar-toggle {
            left: 20px;
        }
    }

    /* Small Mobile */
    @media (max-width: 480px) {
        .sidebar-toggle {
            top: 15px;
            left: 15px;
            width: 36px;
            height: 36px;
        }
    }

    /* Animation for sidebar toggle */
    @keyframes slideIn {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }

    .sidebar.animate {
        animation: slideIn 0.3s forwards;
    }

    /* Accessibility Focus Styles */
    .sidebar-nav-link:focus,
    .sidebar-toggle:focus {
        outline: 2px solid var(--sidebar-accent);
        outline-offset: -2px;
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">SE</div>
            <h2 class="sidebar-logo-text">SportEase</h2>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="sidebar-nav-section">
            <h3 class="sidebar-section-title">Main Navigation</h3>
            <ul>
                <li class="sidebar-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link" data-title="Dashboard">
                        <span class="sidebar-icon">📊</span>
                        <span class="sidebar-link-text">Dashboard</span>
                        <span class="sidebar-badge">New</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('admin.profile') }}" class="sidebar-nav-link" data-title="Profile">
                        <span class="sidebar-icon">👤</span>
                        <span class="sidebar-link-text">Profile</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-nav-section">
            <h3 class="sidebar-section-title">Management</h3>
            <ul>
                <li class="sidebar-nav-item">
                    <a href="{{ route('admin.vendors') }}" class="sidebar-nav-link" data-title="Manage Vendors">
                        <span class="sidebar-icon">🏪</span>
                        <span class="sidebar-link-text">Manage Vendors</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('blogs.index') }}" class="sidebar-nav-link" data-title="Manage Blogs">
                        <span class="sidebar-icon">📝</span>
                        <span class="sidebar-link-text">Manage Blogs</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('team.index') }}" class="sidebar-nav-link" data-title="Manage Team">
                        <span class="sidebar-icon">👥</span>
                        <span class="sidebar-link-text">Manage Team</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">A</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">Admin User</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>
    </div>
</div>

<button class="sidebar-toggle">
    <div class="hamburger-icon">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const toggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        // Function to toggle sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');

            if(mainContent) {
                mainContent.classList.toggle('expanded');
            }

            // Save state to localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // Check for saved state
        const sidebarState = localStorage.getItem('sidebarCollapsed');

        // Apply saved state on page load
        if(sidebarState === 'true') {
            sidebar.classList.add('collapsed');
            if(mainContent) mainContent.classList.add('expanded');
        }

        // Toggle sidebar when button is clicked
        if(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleSidebar();
            });
        }

        // Add active class to current page
        const currentLocation = window.location.href;
        const menuItems = document.querySelectorAll('.sidebar-nav-link');

        menuItems.forEach(item => {
            if(item.href === currentLocation) {
                item.classList.add('active');
            }
        });

        // Handle swipe gestures on mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            const swipeThreshold = 100;

            // Right swipe (open sidebar)
            if(touchEndX - touchStartX > swipeThreshold && sidebar.classList.contains('collapsed')) {
                toggleSidebar();
            }

            // Left swipe (close sidebar)
            if(touchStartX - touchEndX > swipeThreshold && !sidebar.classList.contains('collapsed')) {
                toggleSidebar();
            }
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if(window.innerWidth > 992) {
                // On desktop, reset to default state
                sidebar.classList.remove('collapsed');
                if(mainContent) mainContent.classList.remove('expanded');
                localStorage.removeItem('sidebarCollapsed');
            } else if(window.innerWidth <= 768 && !sidebar.classList.contains('collapsed')) {
                // On mobile, collapse by default
                sidebar.classList.add('collapsed');
                if(mainContent) mainContent.classList.add('expanded');
                localStorage.setItem('sidebarCollapsed', 'true');
            }
        });

        // Initial check for mobile
        if(window.innerWidth <= 768 && !sidebar.classList.contains('collapsed')) {
            sidebar.classList.add('collapsed');
            if(mainContent) mainContent.classList.add('expanded');
        }

    });
</script>
