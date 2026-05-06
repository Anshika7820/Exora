<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-green-500 mr-3 shadow-[0_0_10px_rgba(74,222,128,0.5)]"></span>
            {{ __('Hoster Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hoster Header -->
            <div class="bg-gray-900 border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2rem] mb-8 relative">
                <div class="p-12 text-gray-100">
                    <h3 class="text-5xl font-black mb-4 tracking-tighter">Manage Your <span class="text-green-400">Empire</span></h3>
                    <p class="text-gray-400 max-w-xl text-xl leading-relaxed">As an Exora Hoster, you have full control over the digital experience. Create galleries, manage booths, and analyze visitor engagement.</p>
                </div>
            </div>

            <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-white/5 mb-8">
                <div class="p-10 text-gray-100">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-8">Content Orchestration</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <a href="{{ route('exhibition.create') }}" class="block p-8 bg-black/50 rounded-2xl border border-white/5 hover:border-green-400/50 hover:shadow-[0_0_20px_rgba(74,222,128,0.2)] transition-all group">
                            <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">💎</div>
                            <h4 class="text-xl font-black text-green-400 mb-2">Create Exhibition</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Deploy new 3D galleries and interactive hall content.</p>
                        </a>

                        <a href="{{ route('booth.create') }}" class="block p-8 bg-black/50 rounded-2xl border border-white/5 hover:border-blue-400/50 hover:shadow-[0_0_20px_rgba(96,165,250,0.2)] transition-all group">
                            <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">🎪</div>
                            <h4 class="text-xl font-black text-blue-400 mb-2">Manage Booths</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Configure exhibitor stalls and brand placements.</p>
                        </a>

                        <a href="{{ route('session.create') }}" class="block p-8 bg-black/50 rounded-2xl border border-white/5 hover:border-yellow-400/50 hover:shadow-[0_0_20px_rgba(250,204,21,0.2)] transition-all group">
                            <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">🎤</div>
                            <h4 class="text-xl font-black text-yellow-400 mb-2">Schedule Sessions</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Organize live keynotes and auditorium events.</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Analytics Quick View -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-gray-900 p-10 rounded-[2rem] border border-white/5">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-8">Platform Analytics</h3>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="bg-black/30 p-6 rounded-2xl border border-white/5">
                            <div class="text-xs font-bold text-gray-500 mb-2">Total Impressions</div>
                            <div class="text-4xl font-black text-white">{{ \App\Models\Exhibition::sum('views') ?? 0 }}</div>
                        </div>
                        <div class="bg-black/30 p-6 rounded-2xl border border-white/5">
                            <div class="text-xs font-bold text-gray-500 mb-2">Active Sessions</div>
                            <div class="text-4xl font-black text-white">12</div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-950/20 to-emerald-950/20 p-10 rounded-[2rem] border border-green-500/20 flex flex-col justify-center">
                    <h4 class="text-xs font-black text-green-400 uppercase tracking-[0.2em] mb-4">Hoster Tip</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-bold">
                        Regularly update your **Hall B** assets to keep visitors engaged and maintain a high engagement score.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
