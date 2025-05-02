<x-guest-layout>
    <div class="max-w-lg w-full mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Forgot Password') }}</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No worries, just enter your email below and we’ll send you a link to reset your password.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                <x-text-input
                    id="email"
                    class="mt-2 block w-full px-4 py-3 text-sm bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 dark:focus:border-indigo-400 dark:text-white"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="your@email.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Send Code Button -->
            <div>
                <x-primary-button class="w-full py-3 px-4 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md shadow-md">
                    {{ __('Send Reset Link') }}
                </x-primary-button>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                    {{ __('Remembered your password? Back to login') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
