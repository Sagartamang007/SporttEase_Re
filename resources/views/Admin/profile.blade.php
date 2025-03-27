@extends('admin.layouts.app')

@section('content')
<style>
    /* SportEase Admin Profile - Fully Responsive */

    /* Main Content */
    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        background: #ffffff;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.08);
        animation: fadeIn 0.6s ease-in-out;
        position: relative;
        overflow: hidden;
        width: calc(100% - 2rem); /* Account for margins */
    }

    .profile-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
    }

    /* Page Heading */
    .profile-title {
        font-size: clamp(22px, 5vw, 28px); /* Responsive font size */
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
        position: relative;
        padding-bottom: 12px;
    }

    .profile-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
        border-radius: 3px;
    }

    /* Success Message */
    .success-message {
        background: rgba(46, 204, 113, 0.12);
        border-left: 5px solid #2ecc71;
        color: #27ae60;
        padding: 16px;
        border-radius: 8px;
        font-weight: 600;
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        animation: slideIn 0.4s ease;
        flex-wrap: wrap;
    }

    .success-message:before {
        content: "✓";
        font-size: 22px;
        margin-right: 12px;
        font-weight: bold;
        background: rgba(46, 204, 113, 0.2);
        min-width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    /* Form Styles */
    .profile-form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 15px;
        transition: 0.3s ease;
    }

    .form-group input {
        padding: 14px 16px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .form-group input:focus {
        border-color: #3498db;
        box-shadow: 0px 0px 8px rgba(52, 152, 219, 0.25);
        outline: none;
        background: white;
    }

    .form-group input:hover {
        border-color: #bdc3c7;
    }

    /* Password Fields */
    .password-fields {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    /* Submit Button */
    .profile-submit {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        display: block;
        width: 100%;
        margin-top: 10px;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 4px 12px rgba(52, 152, 219, 0.3);
    }

    .profile-submit:hover {
        background: linear-gradient(135deg, #2980b9, #3498db);
        box-shadow: 0px 6px 16px rgba(52, 152, 219, 0.4);
        transform: translateY(-3px);
    }

    .profile-submit:active {
        transform: translateY(-1px);
        box-shadow: 0px 3px 8px rgba(52, 152, 219, 0.3);
    }

    .profile-submit::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: -100%;
        background: linear-gradient(90deg,
            rgba(255,255,255,0) 0%,
            rgba(255,255,255,0.2) 50%,
            rgba(255,255,255,0) 100%);
        transition: all 0.6s ease;
    }

    .profile-submit:hover::after {
        left: 100%;
    }

    /* Responsive Design - Multiple Breakpoints */
    /* Large Desktop */
    @media (min-width: 1200px) {
        .profile-container {
            padding: 40px;
            max-width: 900px;
        }
    }

    /* Desktop */
    @media (min-width: 992px) and (max-width: 1199px) {
        .profile-container {
            max-width: 800px;
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 991px) {
        .profile-container {
            max-width: 700px;
            padding: 30px;
        }

        .form-group:not(.password-group) {
            grid-column: span 2;
        }

        .profile-form {
            grid-template-columns: 1fr 1fr;
        }

        .password-fields {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Large Mobile */
    @media (min-width: 576px) and (max-width: 767px) {
        .profile-container {
            padding: 25px;
            margin: 1.5rem auto;
            border-radius: 14px;
            max-width: 540px;
        }

        .profile-title {
            margin-bottom: 20px;
        }

        .password-fields {
            grid-template-columns: 1fr;
        }
    }

    /* Medium Mobile */
    @media (min-width: 480px) and (max-width: 575px) {
        .profile-container {
            padding: 20px;
            margin: 1rem auto;
            border-radius: 12px;
        }

        .profile-title {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .form-group input {
            font-size: 15px;
            padding: 12px 14px;
        }

        .profile-submit {
            font-size: 15px;
            padding: 14px;
        }
    }

    /* Small Mobile */
    @media (max-width: 479px) {
        .profile-container {
            padding: 18px;
            margin: 0.8rem auto;
            border-radius: 10px;
        }

        .profile-title {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .profile-title::after {
            width: 50px;
        }

        .success-message {
            padding: 12px;
            font-size: 14px;
        }

        .success-message:before {
            font-size: 18px;
            min-width: 25px;
            height: 25px;
        }

        .form-group {
            gap: 6px;
        }

        .form-group label {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .form-group input {
            font-size: 14px;
            padding: 10px 12px;
            border-radius: 8px;
        }

        .profile-form {
            gap: 16px;
        }

        .profile-submit {
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 320px) {
        .profile-container {
            padding: 15px;
            margin: 0.5rem auto;
        }

        .profile-title {
            font-size: 18px;
            padding-bottom: 8px;
        }

        .form-group input {
            padding: 8px 10px;
        }
    }

    /* Landscape Mode */
    @media (max-height: 500px) and (orientation: landscape) {
        .profile-container {
            margin: 1rem auto;
            padding: 20px;
        }

        .profile-form {
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group:not(.password-group) {
            grid-column: span 1;
        }

        .password-fields {
            grid-template-columns: 1fr 1fr;
            grid-column: span 2;
        }
    }

    /* High DPI Screens */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .profile-container {
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.07);
        }
    }


    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Print Styles */
    @media print {
        .profile-container {
            box-shadow: none;
            margin: 0;
            padding: 20px;
            max-width: 100%;
        }

        .profile-submit {
            display: none;
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
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <div class="password-fields">
            <div class="form-group password-group">
                <label for="password">New Password (optional)</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group password-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
        </div>
        <button type="submit" class="profile-submit">Update Profile</button>
    </form>
</div>
@endsection
