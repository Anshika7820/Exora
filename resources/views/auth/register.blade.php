<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" class="block mt-1 w-full bg-gray-800/50 border-gray-700 text-white focus:border-cyan-500 focus:ring-cyan-500 rounded-xl shadow-sm" required>
                <option value="visitor" class="bg-gray-900">Participater</option>
                <option value="creator" class="bg-gray-900">Hoster</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <a class="text-sm text-gray-500 hover:text-white transition" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" id="reg-btn">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const btn = document.getElementById('reg-btn');
        
        function validate() {
            if (confirm.value && password.value !== confirm.value) {
                confirm.style.borderColor = '#ef4444';
                confirm.style.boxShadow = '0 0 10px rgba(239, 68, 68, 0.2)';
            } else if (confirm.value) {
                confirm.style.borderColor = '#22d3ee';
                confirm.style.boxShadow = '0 0 10px rgba(34, 211, 238, 0.2)';
            }
        }

        password.addEventListener('input', validate);
        confirm.addEventListener('input', validate);
    </script>
</x-guest-layout>
