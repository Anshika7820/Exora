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
                <a href="{{ route('hall') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-cyan-400/50 hover:shadow-[0_0_30px_rgba(34,211,238,0.15)] hover:-translate-y-2 hover:scale-[1.02] transition-all duration-500 group">
                    <div class="text-5xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">🏛️</div>
                    <h4 class="text-2xl font-black text-white mb-2">Exhibition Hall</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">Explore immersive 3D galleries and view high-resolution exhibits in 7 unique halls.</p>
                </a>

                <a href="{{ route('auditorium') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-purple-400/50 hover:shadow-[0_0_30px_rgba(192,132,252,0.15)] hover:-translate-y-2 hover:scale-[1.02] transition-all duration-500 group">
                    <div class="text-5xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">🎤</div>
                    <h4 class="text-2xl font-black text-white mb-2">Auditorium</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">Watch live keynote sessions and interact with global hosters in real-time.</p>
                </a>

                <a href="{{ route('booths') }}" class="block p-10 bg-gray-900 rounded-[2rem] border border-white/5 hover:border-pink-400/50 hover:shadow-[0_0_30px_rgba(244,114,182,0.15)] hover:-translate-y-2 hover:scale-[1.02] transition-all duration-500 group">
                    <div class="text-5xl mb-6 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500">🎪</div>
                    <h4 class="text-2xl font-black text-white mb-2">Virtual Booths</h4>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-400 transition-colors">Discover products and interact with virtual stalls to collect your stamps.</p>
                </a>
            </div>

            <!-- Activity & Recommendations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                <div class="bg-gray-900 p-10 rounded-[2rem] border border-white/5">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 flex justify-between items-center">
                        <span>Latest Platform Activity</span>
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></span>
                    </h3>
                    <div class="space-y-4">
                        @foreach(\App\Models\Exhibition::latest()->take(3)->get() as $exhibition)
                        <div class="flex items-center gap-4 bg-black/40 p-4 rounded-2xl border border-white/5">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-xs">{{ substr($exhibition->title, 0, 1) }}</div>
                            <div>
                                <p class="text-white text-sm font-bold">{{ $exhibition->title }}</p>
                                <p class="text-gray-500 text-xs mt-0.5">A new exhibition just went live!</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gradient-to-br from-cyan-950/20 to-blue-950/20 p-10 rounded-[2rem] border border-cyan-500/20 flex flex-col justify-center relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 text-[150px] opacity-10 blur-sm pointer-events-none group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700">🚀</div>
                    <h4 class="text-xs font-black text-cyan-400 uppercase tracking-[0.2em] mb-4">Passport Progress</h4>
                    <div class="flex items-end gap-4 mb-4">
                        <span class="text-6xl font-black text-white">0</span>
                        <span class="text-sm font-bold text-gray-400 mb-2 uppercase tracking-widest">Points</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed font-bold">
                        Visit more booths, attend auditorium sessions, and interact with 3D exhibits to earn points and unlock special badges!
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('hall') }}" class="inline-block bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3 px-6 rounded-xl text-xs uppercase tracking-widest transition-all shadow-[0_0_15px_rgba(34,211,238,0.4)] hover:shadow-[0_0_25px_rgba(34,211,238,0.6)] hover:-translate-y-1">Start Exploring →</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- How To Use Exora (For Presentation) -->
            <div class="mt-8 bg-gray-900 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-white/5 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 opacity-50"></div>
                <div class="p-10 text-gray-100 relative z-10">
                    <h3 class="text-2xl font-black mb-6 tracking-tighter">How to Explore <span class="text-cyan-400">Exora</span></h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-cyan-400 mb-2">1. 3D Halls</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Navigate 7 distinctly themed 3D environments. Look around in 360 degrees and view dynamic artwork placed by Hosters.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-purple-400 mb-2">2. Live Auditorium</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Join scheduled sessions, watch embedded live streams, and chat in real-time with other attendees.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-pink-400 mb-2">3. Interactive Booths</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Browse the marketplace, click on digital stalls, and view embedded video pitches from creators.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-amber-400 mb-2">4. AI Assistant</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Click the chat bubble anytime to ask our context-aware AI for directions, schedules, or help.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
