<x-guest-layout>
    <div class="max-w-sm w-full mx-auto p-5 bg-white dark:bg-gray-800 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="text-center mb-5">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Verify Code') }}</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Enter the 6-digit code sent to your email to reset your password.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('password.verifyCode') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ request()->email }}">

            <div>
                <div class="relative">
                    <x-text-input
                        id="code"
                        class="block w-full px-4 py-3 text-center tracking-widest text-xl font-medium bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 dark:focus:border-indigo-400 dark:text-white transition-all duration-200"
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
                <x-input-error :messages="$errors->get('code')" class="mt-1.5 text-xs text-center" />
            </div>

            <div>
                <x-primary-button class="w-full justify-center py-3 px-4 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-lg transition-colors duration-200 shadow-md">
                    {{ __('Verify Code') }}
                </x-primary-button>
            </div>

            <div class="text-center pt-2 space-y-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Didn't receive the code?") }}
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium ml-1 hover:underline">
                        {{ __('Resend') }}
                    </a>
                </p>
                <a href="{{ route('login') }}" class="inline-block text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline">
                    {{ __('Back to login') }}
                </a>
            </div>
        </form>
    </div>

    <!-- ✅ Success Toast Notification -->
    <div id="toast-notification"
        class="fixed top-5 right-5 md:right-10 z-50 bg-green-600 text-white rounded-lg shadow-lg p-4 flex items-center space-x-3 transition-all transform opacity-0 translate-x-20 md:max-w-xs w-11/12 sm:w-auto"
        style="display: none;">

        <div class="flex items-center justify-center w-8 h-8 bg-white bg-opacity-25 rounded-lg">
            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="text-sm font-medium">
            {{ __('A 6-digit verification code has been sent to your email.') }}
        </div>
        <button type="button"
            class="ml-auto text-white hover:text-gray-100 p-1.5 focus:outline-none"
            onclick="closeToast()">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast();
        });

        function showToast() {
            const toast = document.getElementById('toast-notification');
            toast.style.display = 'flex';
            setTimeout(() => {
                toast.classList.remove('opacity-0', 'translate-x-20');
                toast.classList.add('opacity-100', 'translate-x-0');
            }, 100);

            // Auto-close after 5 seconds
            setTimeout(() => {
                closeToast();
            }, 5000);
        }

        function closeToast() {
            const toast = document.getElementById('toast-notification');
            toast.classList.add('opacity-0', 'translate-x-20');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 300);
        }
    </script>
</x-guest-layout>
