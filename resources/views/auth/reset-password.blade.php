<x-guest-layout>
    <div class="d-flex justify-content-center align-items-center" style="background: linear-gradient(120deg, #e0f7fa, #e0ffe0); height:100vh">
        <div class="card glass-card shadow-lg border-0 p-4 rounded-4" style="max-width: 420px; width: 100%;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-key fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ __('Reset Your Password') }}</h4>
                    <p class="text-muted small">{{ __('Enter your new password below.') }}</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="alert alert-success small text-center py-2 fade show rounded-3 mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- New Password Field -->
                    <div class="mb-4">
                        <label for="password" class="form-label text-dark">{{ __('New Password') }}</label>
                        <div class="input-group rounded-3 shadow-sm overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-lock text-success"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control border-0 @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Enter your new password">
                            <button type="button" class="input-group-text bg-white border-0 toggle-password" data-target="password">
                                <i class="fas fa-eye text-success"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <div class="password-strength mt-1 text-xs text-muted small">
                            <span>Password must be at least 6 characters</span>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-dark">{{ __('Confirm Password') }}</label>
                        <div class="input-group rounded-3 shadow-sm overflow-hidden">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-lock text-success"></i>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-0 @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password" placeholder="Confirm your new password">
                            <button type="button" class="input-group-text bg-white border-0 toggle-password" data-target="password_confirmation">
                                <i class="fas fa-eye text-success"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Reset Password Button -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success py-3 fw-semibold rounded-3">
                            <i class="fas fa-check-circle me-1"></i> {{ __('Reset Password') }}
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none text-success">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('Back to login') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification for Success Message (Bootstrap 5) -->
    @if (session('status'))
        <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 1050">
            <div id="toast-notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success bg-opacity-10 border-bottom border-success border-opacity-25">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <strong class="me-auto text-success">Success</strong>
                    <small class="text-muted">Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-white">
                    <span id="toast-message">{{ session('status') }}</span>
                </div>
            </div>
        </div>
    @endif

    <style>
        .toast {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-left: 4px solid #28a745;
            animation: slideIn 0.5s ease forwards;
            width: 350px;
            max-width: 90vw;
        }
        @keyframes slideIn {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <script>
        // Password toggle functionality
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Show toast if session status exists
            const toastMessage = "{{ session('status') }}";
            if (toastMessage) {
                const toastElement = document.getElementById('toast-notification');
                const toastMessageElement = document.getElementById('toast-message');
                toastMessageElement.textContent = toastMessage;

                const toast = new bootstrap.Toast(toastElement, {
                    autohide: true,
                    delay: 5000
                });
                toast.show();
            }
        });
    </script>
</x-guest-layout>
