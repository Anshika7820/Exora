<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-8 bg-gray-900 shadow-2xl sm:rounded-2xl border border-gray-800 backdrop-blur-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-gray-900 shadow-2xl sm:rounded-2xl border border-gray-800 backdrop-blur-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-gray-900 shadow-2xl sm:rounded-2xl border border-red-900/30 backdrop-blur-sm">
                <div class="max-w-xl text-red-100">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
