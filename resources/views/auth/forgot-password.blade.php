<x-guest-layout>
    <div class="max-w-sm w-full mx-auto p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Forgot Password') }}</h2>
            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-xs font-medium text-gray-700 dark:text-gray-300" />
                <x-text-input
                    id="email"
                    class="mt-1 block w-full px-3 py-1.5 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 dark:focus:border-indigo-400 dark:text-white"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="your@email.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <div>
                <x-primary-button class="w-full justify-center py-1.5 px-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-500 rounded-md">
                    {{ __('Send Code') }}
                </x-primary-button>
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                    {{ __('Back to login') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
