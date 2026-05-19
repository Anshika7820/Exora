<section>
    <header>
        <h2 class="text-lg font-medium text-amber-500">
            {{ __('Become a Host / Creator') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Enter the exclusive creator access code to upgrade your account and start hosting your own exhibitions.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.upgrade') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="creator_code" :value="__('Access Code')" class="text-gray-300" />
            <x-text-input id="creator_code" name="creator_code" type="password" class="mt-1 block w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-amber-500 focus:ring-amber-500" placeholder="Enter Host ID / Password" required />
            <x-input-error :messages="$errors->upgrade->get('creator_code')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-lg shadow-[0_0_15px_rgba(217,119,6,0.4)] transition-all duration-300 transform hover:scale-105">{{ __('Upgrade Account') }}</x-primary-button>

            @if (session('status') === 'role-upgraded')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm text-green-400 font-semibold"
                >{{ __('Successfully upgraded to Creator!') }}</p>
            @endif
        </div>
    </form>
</section>
