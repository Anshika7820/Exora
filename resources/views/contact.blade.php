<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-pink-500 mr-3 shadow-[0_0_10px_rgba(236,72,153,0.5)]"></span>
            {{ __('Contact Support') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-8 p-6 bg-green-500/10 border border-green-500/50 rounded-2xl text-green-400 font-bold">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-gray-900 border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2rem] relative">
                <div class="p-12 text-gray-100 relative z-10">
                    <h3 class="text-4xl font-black mb-2 tracking-tighter">Get in <span class="text-pink-400">Touch</span></h3>
                    <p class="text-gray-400 mb-8">Need help with the Exora platform? Send a message to our support team and it will be securely logged in our MongoDB support queue.</p>

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="subject" :value="__('Subject')" class="text-gray-300 font-bold mb-2" />
                            <x-text-input id="subject" class="block mt-1 w-full bg-black border-white/10 text-white rounded-xl focus:border-pink-500 focus:ring-pink-500" type="text" name="subject" required autofocus placeholder="e.g. Issue with 3D Hall Placement" />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="message" :value="__('Message')" class="text-gray-300 font-bold mb-2" />
                            <textarea id="message" name="message" rows="5" class="block mt-1 w-full bg-black border-white/10 text-white rounded-xl focus:border-pink-500 focus:ring-pink-500" required placeholder="Describe your issue or inquiry..."></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-pink-600 hover:bg-pink-500 text-white font-black py-4 px-8 rounded-xl uppercase tracking-widest transition shadow-[0_0_20px_rgba(236,72,153,0.3)]">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
