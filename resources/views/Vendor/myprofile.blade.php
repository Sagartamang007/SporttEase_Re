<x-app-layout>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container py-4">
                <h4 class="mb-4">My Account</h4>

                <div class="row g-4">
                    <!-- Profile Card -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="avatar-circle mb-3 mx-auto">
                                    <i class="bi bi-person"></i>
                                </div>

                                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                                <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>

                                <div class="user-info text-start mt-4">
                                    <div class="info-item d-flex align-items-center mb-2">
                                        <i class="bi bi-telephone me-2"></i>
                                        <span>{{ auth()->user()->phone ?? 'No phone number' }}</span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="bi bi-calendar me-2"></i>
                                        <span>Joined {{ auth()->user()->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="mb-3">Edit Profile</h5>

                                @if (session('success'))
                                    <div class="alert alert-success py-2">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="row g-3">
                                        <!-- Name Field -->
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Current Password Field -->
                                        <div class="col-12">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password">
                                            @error('current_password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- New Password Field -->
                                        <div class="col-md-6">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password">
                                            @error('new_password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Confirm New Password Field -->
                                        <div class="col-md-6">
                                            <label for="new_password_confirmation" class="form-label">Confirm New
                                                Password</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation">
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
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
            padding: 20px;
        }

        .card {
            border-radius: 10px;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-circle i {
            font-size: 2.5rem;
            color: #6c757d;
        }

        .info-item {
            color: #6c757d;
        }

        .info-item i {
            width: 20px;
            color: #6c757d;
        }

        .form-control {
            padding: 0.5rem 0.75rem;
            border-color: #dee2e6;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</x-app-layout>
