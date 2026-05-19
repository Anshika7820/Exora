<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-amber-600/10 rounded-full blur-3xl mix-blend-screen pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-[30rem] h-[30rem] bg-orange-700/10 rounded-full blur-3xl mix-blend-screen pointer-events-none"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            <!-- Header section for descriptiveness -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-600 drop-shadow-lg mb-2">Your Profile</h1>
                <p class="text-gray-400 text-lg">Manage your account settings, update your details, or elevate your experience to become a Host.</p>
            </div>

            <div class="p-8 bg-gray-900/80 shadow-2xl sm:rounded-2xl border border-gray-800 backdrop-blur-md transition-all hover:border-gray-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-gray-900/80 shadow-2xl sm:rounded-2xl border border-gray-800 backdrop-blur-md transition-all hover:border-gray-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if(auth()->user()->role !== 'creator')
            <div class="p-8 bg-gradient-to-br from-gray-900 to-gray-800 shadow-2xl sm:rounded-2xl border border-amber-500/30 backdrop-blur-md relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.become-creator-form')
                </div>
            </div>
            @endif

            <div class="p-8 bg-gray-900/80 shadow-2xl sm:rounded-2xl border border-red-900/30 backdrop-blur-md transition-all hover:border-red-900/50">
                <div class="max-w-xl text-red-100">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
