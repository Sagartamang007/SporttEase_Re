@extends('admin.layouts.app')

@section('content')
<style>
    /* SportEase Admin Profile - Clean & Responsive */

    /* Main Content */
    .profile-container {
        max-width: 800px;
        margin: auto;
        background: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Page Heading */
    .profile-title {
        font-size: 26px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Success Message */
    .success-message {
        background: rgba(46, 204, 113, 0.1);
        border-left: 5px solid #2ecc71;
        color: #27ae60;
        padding: 12px;
        border-radius: 6px;
        font-weight: 600;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        animation: fadeIn 0.3s ease;
    }

    .success-message:before {
        content: "✓";
        font-size: 20px;
        margin-right: 10px;
        font-weight: bold;
    }

    /* Form Styles */
    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
    }

    .form-group input {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: 0.3s ease;
        background: #f8f9fa;
    }

    .form-group input:focus {
        border-color: #3498db;
        box-shadow: 0px 0px 6px rgba(52, 152, 219, 0.3);
        outline: none;
        background: white;
    }

    /* Submit Button */
    .profile-submit {
        background: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        display: block;
    }

    .profile-submit:hover {
        background: #2980b9;
        box-shadow: 0px 4px 12px rgba(52, 152, 219, 0.3);
        transform: translateY(-2px);
    }

    .profile-submit:active {
        transform: translateY(0);
        box-shadow: 0px 2px 6px rgba(52, 152, 219, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-container {
            padding: 20px;
            margin: 10px;
        }

        .profile-title {
            font-size: 22px;
        }

        .form-group input {
            font-size: 14px;
        }

        .profile-submit {
            font-size: 14px;
        }
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="profile-container">
    <h2 class="profile-title">Admin Profile</h2>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}" class="profile-form">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <div class="form-group">
            <label>New Password (optional)</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">
        </div>
        <button type="submit" class="profile-submit">Update Profile</button>
    </form>
</div>
@endsection
