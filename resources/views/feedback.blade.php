<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leave Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    <h3 class="text-2xl font-bold mb-6 text-cyan-400">We Value Your Experience</h3>
                    
                    @if (session('status'))
                        <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded mb-6">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('feedback.store') }}" class="max-w-2xl">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Your Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="w-full bg-gray-800 border border-gray-700 rounded-md text-white px-4 py-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                        </div>
                        
                        <!-- Message -->
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                            <textarea name="message" id="message" rows="4" class="w-full bg-gray-800 border border-gray-700 rounded-md text-white px-4 py-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Tell us what you liked or how we can improve..." required></textarea>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded shadow">
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
