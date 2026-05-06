<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-cyan-500 mr-3 shadow-[0_0_10px_rgba(34,211,238,0.5)]"></span>
            {{ __('Participater Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Participater Header -->
            <div class="bg-gray-900 border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2rem] mb-8 relative">
                <div class="p-12 text-gray-100">
                    <h3 class="text-5xl font-black mb-4 tracking-tighter">Your <span class="text-cyan-400">Journey</span> Starts Here</h3>
                    <p class="text-gray-400 max-w-xl text-xl leading-relaxed">Welcome back, Participater. The Exora halls are open and waiting for your exploration. Visit booths and attend live sessions to earn points.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('hall') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-cyan-400/50 hover:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all group">
                    <div class="text-5xl mb-6 group-hover:scale-110 transition-transform">🏛️</div>
                    <h4 class="text-2xl font-black text-white mb-2">Exhibition Hall</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Explore immersive 3D galleries and view high-resolution exhibits in Hall A & B.</p>
                </a>

                <a href="{{ route('auditorium') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-purple-400/50 hover:shadow-[0_0_20px_rgba(192,132,252,0.2)] transition-all group">
                    <div class="text-5xl mb-6 group-hover:scale-110 transition-transform">🎤</div>
                    <h4 class="text-2xl font-black text-white mb-2">Auditorium</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Watch live keynote sessions and interact with global hosters in real-time.</p>
                </a>

                <a href="{{ route('booths') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-pink-400/50 hover:shadow-[0_0_20px_rgba(244,114,182,0.2)] transition-all group">
                    <div class="text-5xl mb-6 group-hover:scale-110 transition-transform">🎪</div>
                    <h4 class="text-2xl font-black text-white mb-2">Virtual Booths</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Discover products and interact with virtual stalls to collect your stamps.</p>
                </a>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
