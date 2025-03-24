@extends('admin.layouts.app')

@section('content')
<style>
    /* SportEase Admin Dashboard Styles */

/* Dashboard container */
.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

/* Dashboard heading */
h2 {
    color: #2c3e50;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(44, 62, 80, 0.1);
    position: relative;
}

h2:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 60px;
    height: 2px;
    background-color: #3498db;
}

/* Dashboard cards */
.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 25px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border-top: 3px solid #3498db;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.card:nth-child(2) {
    border-top-color: #2ecc71;
}

.card:nth-child(3) {
    border-top-color: #f39c12;
}

.card:nth-child(4) {
    border-top-color: #9b59b6;
}

.card:nth-child(5) {
    border-top-color: #e74c3c;
}

.card:nth-child(6) {
    border-top-color: #34495e;
}

.card h3 {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin-top: 0;
    margin-bottom: 15px;
}

.card p {
    font-size: 32px;
    font-weight: 700;
    color: #3498db;
    margin: 0;
    line-height: 1.2;
}

.card:nth-child(2) p {
    color: #2ecc71;
}

.card:nth-child(3) p {
    color: #f39c12;
}

.card:nth-child(4) p {
    color: #9b59b6;
}

.card:nth-child(5) p {
    color: #e74c3c;
}

.card:nth-child(6) p {
    color: #34495e;
}

/* Add icons to cards */
.card:before {
    position: absolute;
    right: 20px;
    top: 20px;
    font-size: 48px;
    opacity: 0.1;
    transition: all 0.3s ease;
}

.card:nth-child(1):before {
    content: "⏳";
}

.card:nth-child(2):before {
    content: "✓";
}

.card:nth-child(3):before {
    content: "❌";
}

.card:nth-child(4):before {
    content: "👥";
}

.card:nth-child(5):before {
    content: "🏪";
}

.card:hover:before {
    opacity: 0.2;
    transform: scale(1.1);
}

/* Add a subtle pattern to cards */
.card:after {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle at bottom right, rgba(52, 152, 219, 0.1) 0%, transparent 70%);
    border-radius: 100% 0 0 0;
}

.card:nth-child(2):after {
    background: radial-gradient(circle at bottom right, rgba(46, 204, 113, 0.1) 0%, transparent 70%);
}

.card:nth-child(3):after {
    background: radial-gradient(circle at bottom right, rgba(243, 156, 18, 0.1) 0%, transparent 70%);
}

.card:nth-child(5):after {
    background: radial-gradient(circle at bottom right, rgba(231, 76, 60, 0.1) 0%, transparent 70%);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-cards {
        grid-template-columns: 1fr;
    }

    h2 {
        font-size: 22px;
        text-align: center;
    }

    h2:after {
        left: 50%;
        transform: translateX(-50%);
    }

    .card {
        padding: 20px;
    }

    .card h3 {
        font-size: 16px;
    }

    .card p {
        font-size: 28px;
    }
}

/* For larger screens, make a more impressive layout */
@media (min-width: 1200px) {
    .dashboard-cards {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Animation for cards when they load */
@keyframes cardFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: cardFadeIn 0.5s ease forwards;
}

.card:nth-child(2) {
    animation-delay: 0.1s;
}

.card:nth-child(3) {
    animation-delay: 0.2s;
}

.card:nth-child(4) {
    animation-delay: 0.3s;
}

.card:nth-child(5) {
    animation-delay: 0.4s;
}

.card:nth-child(6) {
    animation-delay: 0.5s;
}

/* Main content container (assuming it wraps the dashboard) */
.content-wrapper {
    padding: 25px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* If you're using the sidebar from earlier, this will ensure proper spacing */
@media (min-width: 769px) {
    .content-wrapper {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }
}

@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 70px;
        padding: 15px;
    }

    .content-wrapper.expanded {
        margin-left: 0;
    }
}
</style>

<h2>Admin Dashboard</h2>
<div class="dashboard-cards">
    <div class="card">
        <h3>Pending Vendors</h3>
        <p>{{ $pendingVendors }}</p>
    </div>
    <div class="card">
        <h3>Approved Vendors</h3>
        <p>{{ $approvedVendors }}</p>
    </div>
    <div class="card">
        <h3>Rejected Vendors</h3>
        <p>{{ $rejectedVendors }}</p>
    </div>
    <div class="card">
        <h3>Users</h3>
        <p>{{ $totalUsers }}</p>
    </div>
    <div class="card">
        <h3>Total Vendors</h3>
        <p>{{ $totalVendors }}</p>
    </div>
</div>

@endsection
