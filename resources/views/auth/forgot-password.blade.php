    <x-guest-layout>
        <div class="d-flex justify-content-center align-items-center"
            style="background: linear-gradient(120deg, #e0f7fa, #e0ffe0); height:100vh">
            <div class="card glass-card shadow-lg border-0 p-4 rounded-4" style="max-width: 420px; width: 100%;">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-lock fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ __('Forgot Password') }}</h4>
                        <p class="text-muted small">
                            {{ __("Enter your email and we'll send you an OTP to reset your password.") }}</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success small text-center py-2 fade show rounded-3" role="alert">
                            <i class="fas fa-check-circle me-1 text-success"></i> {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark">{{ __('Email address') }}</label>
                            <div class="input-group rounded-3 shadow-sm overflow-hidden">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-envelope text-success"></i>
                                </span>
                                <input type="email" name="email" id="email"
                                    class="form-control border-0 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Submit -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success py-3 fw-semibold rounded-3">
                                <i class="fas fa-paper-plane me-1"></i> {{ __('Send OTP') }}
                            </button>
                        </div>

                        <!-- Back to login -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-success">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('Back to login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            }

            .icon-circle {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, #28a745, #218838);
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 5px 15px rgba(33, 136, 56, 0.3);
            }

            .form-control {
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #198754;
                box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.2);
            }

            .btn-success {
                transition: all 0.3s ease;
            }

            .btn-success:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 12px rgba(25, 135, 84, 0.25);
            }

            .alert {
                animation: fadeIn 0.4s ease-in-out;
            }

            .input-group .form-control,
            .input-group .input-group-text {
                background-color: #fff;
                border-radius: 0 !important;
            }

            .input-group {
                border: 1px solid #ced4da;
                border-radius: 0.5rem;
                transition: box-shadow 0.3s ease;
            }

            .input-group:focus-within {
                box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
                border-color: #198754;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </x-guest-layout>
