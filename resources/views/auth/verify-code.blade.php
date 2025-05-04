<x-guest-layout>
    <div class="d-flex justify-content-center align-items-center"
        style="background: linear-gradient(120deg, #e0f7fa, #e0ffe0); height:100vh">
        <div class="card glass-card shadow-lg border-0 p-4 rounded-4" style="max-width: 420px; width: 100%;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-shield-alt fs-2 text-white"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ __('Verify Code') }}</h4>
                    <p class="text-muted small">
                        {{ __('Enter the 6-digit code sent to your email to reset your password.') }}</p>
                </div>
            <form method="POST" action="{{ route('password.verifyCode') }}">
                @csrf
                <input type="hidden" name="email" value="{{ request()->email }}">

                <div class="mb-4">
                    <label for="code" class="form-label text-dark">{{ __('Verification Code') }}</label>
                    <div class="input-group rounded-3 shadow-sm overflow-hidden">
                        <span class="input-group-text bg-white border-0">
                            <i class="fas fa-lock text-success"></i>
                        </span>
                        <x-text-input
                            id="code"
                            class="form-control border-0 text-center fw-bold fs-4 letter-spacing"
                            type="text"
                            name="code"
                            maxlength="6"
                            pattern="[0-9]{6}"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            placeholder="• • • • • •"
                            required
                            autofocus
                        />
                    </div>
                    <x-input-error :messages="$errors->get('code')" class="invalid-feedback d-block mt-1" />
                </div>

                <div class="d-grid mb-3">
                    <x-primary-button class="btn btn-success py-3 fw-semibold rounded-3">
                        <i class="fas fa-check-circle me-1"></i> {{ __('Verify Code') }}
                    </x-primary-button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small mb-2">
                        {{ __("Didn't receive the code?") }}
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-success fw-semibold">
                            {{ __('Resend') }}
                            <i class="fas fa-sync-alt ms-1"></i>
                        </a>
                    </p>
                    <a href="{{ route('login') }}" class="text-decoration-none text-success">
                        <i class="fas fa-arrow-left me-1"></i> {{ __('Back to login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
    <div id="toast-notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success bg-opacity-10 border-bottom border-success border-opacity-25">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto text-success">Success</strong>
            <small class="text-muted">Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast()"></button>
        </div>
        <div class="toast-body bg-white">
            <p class="mb-1">{{ __('A 6-digit verification code has been sent to your email.') }}</p>
            <p class="mb-0 small text-muted">{{ __('Please check your inbox and spam folder.') }}</p>
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
        position: relative;
        z-index: 1;
    }

    .icon-circle::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745, #218838);
        opacity: 0.3;
        z-index: -1;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.3;
        }
        50% {
            transform: scale(1.2);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 0.3;
        }
    }

    .form-control {
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.2);
    }

    .letter-spacing {
        letter-spacing: 0.5rem;
    }

    .btn-success {
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(25, 135, 84, 0.25);
    }

    .btn-success:active {
        transform: translateY(1px);
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
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .progress-bar {
        transition: width 1s linear;
    }

    .invalid-feedback {
        display: flex;
        align-items: center;
    }

    .invalid-feedback::before {
        content: "\f071";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        margin-right: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap toast
        const toastElement = document.getElementById('toast-notification');
        const toast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 6000
        });

        // Show toast
        toast.show();

        // Format code input
        const codeInput = document.getElementById('code');

        codeInput.addEventListener('input', function(e) {
            let value = e.target.value;

            // Remove non-digits
            value = value.replace(/[^\d]/g, '');

            // Limit to 6 digits
            if (value.length > 6) {
                value = value.slice(0, 6);
            }

            e.target.value = value;

            // Add visual feedback when typing
            if (value.length > 0) {
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
            }
        });

        // Countdown timer with progress bar
        startCountdown(5 * 60); // 5 minutes
    });

    function startCountdown(duration) {
        let timer = duration;
        const countdownEl = document.getElementById('countdown');
        const progressBar = document.getElementById('countdown-progress');

        const interval = setInterval(function() {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;

            // Update text
            countdownEl.textContent = `Code expires in ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            // Update progress bar
            const percentLeft = (timer / duration) * 100;
            progressBar.style.width = percentLeft + '%';

            // Change color as time runs out
            if (percentLeft < 30) {
                progressBar.classList.remove('bg-success');
                progressBar.classList.add('bg-danger');
            }

            if (--timer < 0) {
                clearInterval(interval);
                countdownEl.textContent = 'Code expired';
                countdownEl.classList.add('text-danger');
                progressBar.style.width = '0%';
            }
        }, 1000);
    }

    function closeToast() {
        const toastElement = document.getElementById('toast-notification');
        const toast = bootstrap.Toast.getInstance(toastElement);
        if (toast) {
            toast.hide();
        }
    }
</script>

</x-guest-layout>
