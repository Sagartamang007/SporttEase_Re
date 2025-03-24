<style>
    /* SportEase Admin Sidebar Styles */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: linear-gradient(180deg, #2c3e50, #1a252f);
    color: #fff;
    padding: 20px 0;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar h2 {
    color: #fff;
    text-align: center;
    margin: 0 0 30px;
    padding: 0 20px 20px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 5px;
}

.sidebar ul li a {
    display: block;
    padding: 12px 20px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 16px;
    position: relative;
    overflow: hidden;
}

.sidebar ul li a:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background-color: #3498db;
    transform: scaleY(0);
    transition: transform 0.2s, width 0.4s cubic-bezier(1, 0, 0, 1) 0.2s;
    z-index: -1;
}

.sidebar ul li a:hover {
    color: #fff;
    padding-left: 24px;
    background-color: rgba(255, 255, 255, 0.05);
}

.sidebar ul li a:hover:before {
    transform: scaleY(1);
    width: 100%;
}

/* Active state */
.sidebar ul li a.active {
    background-color: rgba(52, 152, 219, 0.2);
    color: #fff;
    border-left: 3px solid #3498db;
}

/* Logout specific styling */
.sidebar ul li:last-child a {
    margin-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: #e74c3c;
}

.sidebar ul li:last-child a:hover:before {
    background-color: #e74c3c;
}

/* Responsive styles */
@media (max-width: 768px) {
    .sidebar {
        width: 70px;
        padding: 10px 0;
    }

    .sidebar h2 {
        font-size: 0;
        padding: 15px 0;
        position: relative;
    }

    .sidebar h2:after {
        content: "SE";
        font-size: 18px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .sidebar ul li a {
        padding: 15px 0;
        text-align: center;
    }

    .sidebar ul li a span {
        display: none;
    }

    /* Add icons with content property for mobile view */
    .sidebar ul li:nth-child(1) a:after {
        content: "👤";
        font-size: 18px;
    }

    .sidebar ul li:nth-child(2) a:after {
        content: "📊";
        font-size: 18px;
    }

    .sidebar ul li:nth-child(3) a:after {
        content: "🏪";
        font-size: 18px;
    }

    .sidebar ul li:nth-child(4) a:after {
        content: "🚪";
        font-size: 18px;
        color: #e74c3c;
    }

    .sidebar ul li a:hover {
        padding-left: 0;
    }
}

/* Toggle button for mobile (you'll need to add this to your HTML) */
.sidebar-toggle {
    display: none;
}

@media (max-width: 768px) {
    .sidebar-toggle {
        display: block;
        position: fixed;
        left: 10px;
        top: 10px;
        z-index: 1001;
        background: #2c3e50;
        color: white;
        border: none;
        border-radius: 3px;
        padding: 5px 8px;
        cursor: pointer;
    }

    .sidebar.collapsed {
        left: -70px;
    }
}

/* Main content adjustment (add to your main content container) */
.main-content {
    margin-left: 250px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 70px;
    }

    .main-content.expanded {
        margin-left: 0;
    }
}
    </style>

<div class="sidebar">
    <h2>SportEase Admin</h2>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.profile') }}">Profile</a></li>
        <li><a href="{{ route('admin.vendors') }}">Manage Vendors</a></li>
        <li><a href="{{ route('admin.blogs') }}">Manage Blogs</a></li>
        <li><a href="{{ route('team.index') }}">Manage Team</a></li>
    </ul>

</div>
<script>
    // Add this to your JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Create toggle button
    const toggle = document.createElement('button');
    toggle.className = 'sidebar-toggle';
    toggle.innerHTML = '☰';
    document.body.appendChild(toggle);

    // Toggle sidebar
    toggle.addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });

    // Add active class to current page
    const currentLocation = window.location.href;
    const menuItems = document.querySelectorAll('.sidebar ul li a');

    menuItems.forEach(item => {
        if(item.href === currentLocation) {
            item.classList.add('active');
        }
    });
});
    </script>
