<x-app-layout>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container py-5">
                <h4 class="mb-4 fw-bold text-primary">My Account</h4>

                <div class="row g-4">
                    <!-- Profile Card -->
                    <div class="col-lg-4 col-md-5">
                        <div class="card border-0 shadow h-100 profile-card">
                            <div class="card-header bg-primary text-white p-0">
                                <div class="profile-cover"></div>
                            </div>
                            <div class="card-body text-center p-4 position-relative">
                                <div class="avatar-container">
                                    <div class="avatar-circle">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-1 fw-bold">{{ auth()->user()->name }}</h5>
                                <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>

                                <div class="badge bg-success-subtle text-success mb-3 px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>Verified Account
                                </div>

                                <div class="user-info text-start mt-4">
                                    <div class="info-item d-flex align-items-center mb-3 p-3 rounded hover-bg">
                                        <div class="icon-circle bg-primary-subtle me-3">
                                            <i class="bi bi-telephone text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Phone</small>
                                            <span class="fw-medium">{{ auth()->user()->phone ?? 'No phone number' }}</span>
                                        </div>
                                    </div>
                                    <div class="info-item d-flex align-items-center p-3 rounded hover-bg">
                                        <div class="icon-circle bg-primary-subtle me-3">
                                            <i class="bi bi-calendar text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Member Since</small>
                                            <span class="fw-medium">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="col-lg-8 col-md-7">
                        <div class="card border-0 shadow h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold m-0">
                                        <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Profile
                                    </h5>
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2">Personal Information</span>
                                </div>

                                @if (session('success'))
                                    <div class="alert alert-success py-3 d-flex align-items-center fade-in">
                                        <div class="alert-icon me-3">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </div>
                                        <div>
                                            <strong>Success!</strong> {{ session('success') }}
                                        </div>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('vendor.profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="row g-4">
                                        <!-- Name Field -->
                                        <div class="col-md-6">
                                            <label for="name" class="form-label fw-medium">Full Name</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="bi bi-person text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0 py-2" id="name" name="name"
                                                    value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            @error('name')
                                                <div class="text-danger small mt-2">
                                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-medium">Email Address</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="bi bi-envelope text-primary"></i>
                                                </span>
                                                <input type="email" class="form-control border-start-0 py-2" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}" required>
                                            </div>
                                            @error('email')
                                                <div class="text-danger small mt-2">
                                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="col-12">
                                            <label for="phone" class="form-label fw-medium">Phone Number</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="bi bi-telephone text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0 py-2" id="phone" name="phone"
                                                    value="{{ old('phone', $user->phone) }}" placeholder="+1 (123) 456-7890">
                                            </div>
                                            @error('phone')
                                                <div class="text-danger small mt-2">
                                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="password-section p-4 rounded bg-light mt-3">
                                                <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                    <i class="bi bi-shield-lock me-2 text-primary"></i>Change Password
                                                </h6>

                                                <!-- Current Password Field -->
                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label fw-medium">Current Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white border-end-0">
                                                            <i class="bi bi-lock text-primary"></i>
                                                        </span>
                                                        <input type="password" class="form-control border-start-0" id="current_password"
                                                            name="current_password">
                                                        <button class="btn btn-outline-secondary border-start-0 password-toggle" type="button">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('current_password')
                                                        <div class="text-danger small mt-2">
                                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="row g-3">
                                                    <!-- New Password Field -->
                                                    <div class="col-md-6">
                                                        <label for="new_password" class="form-label fw-medium">New Password</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-white border-end-0">
                                                                <i class="bi bi-key text-primary"></i>
                                                            </span>
                                                            <input type="password" class="form-control border-start-0" id="new_password"
                                                                name="new_password">
                                                            <button class="btn btn-outline-secondary border-start-0 password-toggle" type="button">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                        @error('new_password')
                                                            <div class="text-danger small mt-2">
                                                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <!-- Confirm New Password Field -->
                                                    <div class="col-md-6">
                                                        <label for="new_password_confirmation" class="form-label fw-medium">Confirm New Password</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-white border-end-0">
                                                                <i class="bi bi-check-circle text-primary"></i>
                                                            </span>
                                                            <input type="password" class="form-control border-start-0" id="new_password_confirmation"
                                                                name="new_password_confirmation">
                                                            <button class="btn btn-outline-secondary border-start-0 password-toggle" type="button">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-4 d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-outline-secondary px-4 py-2">
                                                <i class="bi bi-arrow-left me-2"></i>Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4 py-2">
                                                <i class="bi bi-save me-2"></i>Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .main {
            background-color: #f8f9fa;
            padding: 30px 0;
            min-height: 100vh;
        }

        .card {
            border-radius: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
        }

        .profile-card {
            position: relative;
        }

        .profile-cover {
            height: 100px;
            background: linear-gradient(45deg, #4a6bff, #2541b8);
            position: relative;
            overflow: hidden;
        }

        .profile-cover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxjaXJjbGUgY3g9IjIwIiBjeT0iMjAiIHI9IjEiIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMC4yKSIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIgLz4KPC9zdmc+');
            opacity: 0.5;
        }

        .avatar-container {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f5f7fa, #e4e8f0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .avatar-circle:hover {
            transform: scale(1.05);
        }

        .avatar-circle i {
            font-size: 2.5rem;
            background: linear-gradient(45deg, #4a6bff, #2541b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-circle i {
            font-size: 1.2rem;
        }

        .info-item {
            color: #495057;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .hover-bg:hover {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            transform: translateY(-2px);
        }

        .form-control {
            padding: 0.6rem 0.75rem;
            border-color: #dee2e6;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .input-group-text {
            border-color: #dee2e6;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4a6bff, #2541b8);
            border: none;
            transition: all 0.3s;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(74, 107, 255, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #2541b8, #4a6bff);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(74, 107, 255, 0.4);
        }

        .btn-outline-secondary {
            border-color: #dee2e6;
            color: #6c757d;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .password-section {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .password-section:hover {
            background-color: #f1f3f5;
            border-color: #dee2e6;
        }

        .password-toggle {
            background-color: transparent;
            border-color: #dee2e6;
        }

        .password-toggle:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-weight: 500;
        }

        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .alert {
            border-radius: 12px;
            border-left: 4px solid #198754;
        }

        .alert-icon {
            width: 32px;
            height: 32px;
            background-color: rgba(25, 135, 84, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #198754;
            font-size: 1.2rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 767.98px) {
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .avatar-circle {
                width: 80px;
                height: 80px;
            }

            .avatar-circle i {
                font-size: 2rem;
            }

            .profile-cover {
                height: 80px;
            }

            .avatar-container {
                top: -40px;
            }
        }
    </style>

    <script>
        // Add JavaScript for password toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.password-toggle');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            });
        });
    </script>
</x-app-layout>
