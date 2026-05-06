<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-100 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-green-500 mr-3 shadow-[0_0_10px_rgba(74,222,128,0.5)]"></span>
            {{ __('Hosting: Atrium Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Control Panel -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-gray-900 border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
                        <div class="p-10">
                            <h3 class="text-3xl font-black text-white mb-8 tracking-tighter uppercase">Deployment Center</h3>
                            
                            <form action="{{ route('exhibition.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Event Title</label>
                                    <input type="text" name="title" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-green-500 outline-none transition" placeholder="e.g. Future Tech Expo 2026" required>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Vision Statement</label>
                                    <textarea name="description" rows="4" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-green-500 outline-none transition" placeholder="Describe the immersive experience..." required></textarea>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-black py-5 rounded-2xl text-xs uppercase tracking-widest shadow-[0_0_30px_rgba(34,197,94,0.3)] transition transform active:scale-95">
                                        Deploy to Hall
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Live Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-900 p-8 rounded-[2rem] border border-white/5">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Active Participaters</span>
                                <span class="flex h-2 w-2 rounded-full bg-green-500 animate-ping"></span>
                            </div>
                            <div class="text-5xl font-black text-white">1,284</div>
                            <div class="text-[10px] text-green-500 font-bold mt-4">+12% vs last hour</div>
                        </div>
                        <div class="bg-gray-900 p-8 rounded-[2rem] border border-white/5">
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Engagement Score</div>
                            <div class="text-5xl font-black text-white">A+</div>
                            <div class="text-[10px] text-cyan-500 font-bold mt-4">Top 5% on platform</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Analytics & Insights -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-gradient-to-br from-indigo-950/20 to-purple-950/20 p-10 rounded-[2rem] border border-white/10">
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-6">Hoster Insights</h4>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center text-xl">📈</div>
                                <div>
                                    <h5 class="text-sm font-black text-white">Traffic Spike</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Booth #14 is currently trending. Consider adding more hosters to the chat.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-xl">💬</div>
                                <div>
                                    <h5 class="text-sm font-black text-white">Active Discussions</h5>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">48 new messages in the Auditorium Chat. Engagement is high.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900 p-10 rounded-[2rem] border border-white/5">
                        <h4 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6">Quick Previews</h4>
                        <div class="space-y-4">
                            <a href="{{ route('hall') }}" class="block w-full py-4 text-center bg-white/5 hover:bg-white/10 rounded-xl text-[10px] font-black uppercase tracking-widest transition border border-white/10">Preview Atrium</a>
                            <a href="{{ route('booths') }}" class="block w-full py-4 text-center bg-white/5 hover:bg-white/10 rounded-xl text-[10px] font-black uppercase tracking-widest transition border border-white/10">Preview Marketplace</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
