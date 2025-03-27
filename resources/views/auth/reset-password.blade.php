<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Enter your new password.') }}
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="email" value="{{ request()->email }}">

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <x-primary-button class="w-full p-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 px-4 py-2 rounded-md bg-green-500 text-white shadow-lg hidden">
        <span id="toast-message">Password reset successful!</span>
    </div>

</x-guest-layout>

<script>
    @if (session('status'))
        // Show Toast on Success
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = "{{ session('status') }}";
        toast.classList.remove('hidden');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 5000);
    @endif
</script>
