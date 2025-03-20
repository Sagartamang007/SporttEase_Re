<x-guest-layout>
    <!-- Outer Div for Form Container -->
    <div class="flex justify-center items-center w-full h-screen bg-register">
        <div class="register-container">
            <!-- Logo or Title -->
            <div class="register-logo">
                <h2>Vendor Register</h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('vendorStore') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user text-gray-500"></i> <!-- Name Icon -->
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                    <div class="relative">
                        <x-text-input id="name" class="block mt-1 w-full pr-10 pl-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-envelope text-gray-500"></i> <!-- Email Icon -->
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="relative">
                        <x-text-input id="email" class="block mt-1 w-full pr-10 pl-4" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-phone text-gray-500"></i> <!-- Phone Icon -->
                        <x-input-label for="phone" :value="__('Phone')" />
                    </div>
                    <div class="relative">
                        <x-text-input id="phone" class="block mt-1 w-full pr-10 pl-4" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-lock text-gray-500"></i> <!-- Password Icon -->
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full pr-10 pl-4" type="password" name="password" required autocomplete="new-password" />
                        <button type="button" class="absolute transform -translate-y-1/2 text-gray-500" id="togglePassword" onclick="togglePasswordVisibility('password')" style="top: 9px;right:20px">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-lock text-gray-500"></i> <!-- Confirm Password Icon -->
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    </div>
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10 pl-4" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <button type="button" class="absolute transform -translate-y-1/2 text-gray-500" id="toggleConfirmPassword" onclick="togglePasswordVisibility('password_confirmation')" style="top: 10px; right:20px">
                            <i class="fas fa-eye" id="confirmEyeIcon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Footer with Login Link and Register Button -->
                <div class="form-footer mt-4 flex items-center justify-between">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4" style="background: #239123;">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Form Container Styling */
        .register-container {
            width: 100%;
            max-width: 380px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Logo or Title */
        .register-logo h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-footer {
            text-align: center;
        }

        .btn-submit {
            width: 70%;
            justify-content: center;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        /* Icon Styling */
        .fa-user, .fa-envelope, .fa-lock {
            font-size: 18px;
        }

        .fa-eye {
            font-size: 18px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
                padding: 30px;
            }

            .register-logo h2 {
                font-size: 28px;
            }

            .form-group input {
                font-size: 14px;
            }

            .btn-submit {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .register-logo h2 {
                font-size: 24px;
            }

            .form-group input {
                padding: 8px;
                font-size: 14px;
            }

            .btn-submit {
                padding: 10px;
            }

            .fa-user, .fa-envelope, .fa-lock {
                font-size: 16px;
            }
        }
    </style>

    <!-- JavaScript for Password Toggle -->
    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = fieldId === 'password' ? document.getElementById('eyeIcon') : document.getElementById('confirmEyeIcon');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</x-guest-layout>
