<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-cyan-500 mr-3 shadow-[0_0_10px_rgba(34,211,238,0.5)]"></span>
            {{ __('Exora Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Score & Passport Header -->
            <div class="bg-gray-900 border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2rem] mb-8 relative">
                <div class="absolute top-0 right-0 p-6">
                    <div class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 px-6 py-2 rounded-full font-black text-xs uppercase tracking-widest animate-pulse">
                        ⭐ EXORA SCORE: {{ auth()->user()->expo_score ?? 0 }}
                    </div>
                </div>
                <div class="p-12 text-gray-100">
                    <h3 class="text-5xl font-black mb-4 tracking-tighter">Welcome to <span class="gradient-text">Exora</span>, {{ explode(' ', auth()->user()->name)[0] }}!</h3>
                    <p class="text-gray-400 max-w-xl text-xl leading-relaxed">Your digital gateway to the infinite exhibition is ready. Discover halls, engage with brands, and collect your unique stamps.</p>
                </div>
                <!-- Live Ticker -->
                <div class="bg-black/50 border-t border-white/5 px-12 py-3 flex items-center">
                    <span class="flex h-2 w-2 rounded-full bg-cyan-500 mr-4 shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                    <marquee class="text-xs font-black text-gray-500 uppercase tracking-[0.2em]">
                        DISCOVERY ACTIVE • HALL B (TECH-EXPANSE) IS NOW FEATURED • COLLECT 1,000 POINTS FOR ELITE STATUS • LIVE KEYNOTE STARTING SOON IN AUDITORIUM 1
                    </marquee>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Navigation Cards -->
                <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('hall') }}" class="info-card group border-white/5 hover:border-cyan-500/50 transition-all duration-500 bg-gray-900/50 p-10">
                        <div class="w-16 h-16 bg-cyan-500/10 rounded-2xl flex items-center justify-center text-4xl mb-8 border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-black transition-all">🏛️</div>
                        <h4 class="text-2xl font-black text-white mb-3">Exhibition Hall</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Step into immersive 3D galleries. Explore Hall A and Hall B with high-fidelity assets.</p>
                        <div class="mt-8 flex items-center text-[10px] text-cyan-500 font-black tracking-widest uppercase">
                            EXPLORE NOW <svg class="w-3 h-3 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </a>

                    <a href="{{ route('auditorium') }}" class="info-card group border-white/5 hover:border-purple-500/50 transition-all duration-500 bg-gray-900/50 p-10">
                        <div class="w-16 h-16 bg-purple-500/10 rounded-2xl flex items-center justify-center text-4xl mb-8 border border-purple-500/20 group-hover:bg-purple-500 group-hover:text-black transition-all">🎤</div>
                        <h4 class="text-2xl font-black text-white mb-3">Auditorium</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Join live keynote sessions and interact with global speakers in real-time chat environments.</p>
                        <div class="mt-8 flex items-center text-[10px] text-purple-500 font-black tracking-widest uppercase">
                            JOIN SESSION <svg class="w-3 h-3 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </a>

                    <a href="{{ route('booths') }}" class="info-card group border-white/5 hover:border-pink-500/50 transition-all duration-500 bg-gray-900/50 p-10">
                        <div class="w-16 h-16 bg-pink-500/10 rounded-2xl flex items-center justify-center text-4xl mb-8 border border-pink-500/20 group-hover:bg-pink-500 group-hover:text-black transition-all">🎪</div>
                        <h4 class="text-2xl font-black text-white mb-3">Virtual Booths</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Discover interactive brand stalls. Earn stamps for your passport and unlock exclusive content.</p>
                        <div class="mt-8 flex items-center text-[10px] text-pink-500 font-black tracking-widest uppercase">
                            VISIT BOOTHS <svg class="w-3 h-3 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </a>
                </div>

                <!-- Info Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-8 bg-gray-900 rounded-[2rem] border border-white/5">
                        <h4 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6">Discovery Progress</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-black uppercase tracking-widest mb-2">
                                    <span class="text-gray-400">Hall Experience</span>
                                    <span class="text-cyan-400">60%</span>
                                </div>
                                <div class="w-full bg-black h-1.5 rounded-full overflow-hidden border border-white/5">
                                    <div class="bg-cyan-500 h-full w-[60%] shadow-[0_0_10px_rgba(34,211,238,0.5)]"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-black uppercase tracking-widest mb-2">
                                    <span class="text-gray-400">Booth Stamps</span>
                                    <span class="text-pink-400">25%</span>
                                </div>
                                <div class="w-full bg-black h-1.5 rounded-full overflow-hidden border border-white/5">
                                    <div class="bg-pink-500 h-full w-[25%] shadow-[0_0_10px_rgba(236,72,153,0.5)]"></div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('profile.show') }}" class="block mt-10 text-center text-[10px] font-black uppercase tracking-[0.2em] text-white bg-white/5 py-3 rounded-xl border border-white/10 hover:bg-white/10 transition">
                            Open Full Passport
                        </a>
                    </div>

                    <div class="p-8 bg-gradient-to-br from-cyan-950/20 to-purple-950/20 rounded-[2rem] border border-cyan-500/20">
                        <h4 class="text-xs font-black text-cyan-400 uppercase tracking-[0.2em] mb-3">Exora Intel</h4>
                        <p class="text-xs text-gray-500 leading-relaxed font-bold">
                            Visit the <span class="text-white">Feedback Center</span> to share your journey insights. Top contributors receive the "Elite Visionary" digital badge.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Ticker or Actions -->
            <div class="mt-16 flex flex-wrap gap-4 items-center">
                <span class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em]">Immediate Actions:</span>
                <a href="{{ route('feedback') }}" class="px-8 py-3 bg-white/5 hover:bg-white/10 text-white text-[10px] font-black uppercase tracking-widest rounded-full border border-white/10 transition">Report Insight</a>
                <a href="{{ route('hall') }}" class="px-8 py-3 bg-cyan-600 hover:bg-cyan-500 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-[0_0_20px_rgba(8,145,178,0.3)] transition">Enter Atrium</a>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
