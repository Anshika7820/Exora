<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-100 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-purple-500 mr-3 shadow-[0_0_10px_rgba(168,85,247,0.5)]"></span>
            {{ __('Stage: Auditorium Orchestration') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Stage Activation -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl">
                        <div class="p-10">
                            <h3 class="text-3xl font-black text-white mb-8 tracking-tighter uppercase">Stage Setup</h3>
                            
                            <form method="POST" action="{{ route('session.store') }}" class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Host Atrium</label>
                                    <select name="exhibition_id" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-purple-500 outline-none transition" required>
                                        @foreach(\App\Models\Exhibition::where('creator_id', auth()->id())->get() as $exhibition)
                                            <option value="{{ $exhibition->_id }}">{{ $exhibition->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Keynote Title</label>
                                    <input type="text" name="title" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-purple-500 outline-none transition" placeholder="e.g. The Future of AI in Digital Worlds" required>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Air Time</label>
                                    <input type="text" name="time" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-purple-500 outline-none transition" placeholder="e.g. 2:00 PM EST Today" required>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Live Feed URL (Optional)</label>
                                    <input type="url" name="video_url" class="w-full bg-black/50 border border-white/10 rounded-2xl text-white px-6 py-4 focus:ring-2 focus:ring-purple-500 outline-none transition" placeholder="https://www.youtube.com/embed/...">
                                    <p class="text-[10px] text-gray-500 mt-2 font-bold italic">Participaters can join the session directly from their dashboards when live.</p>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-5 rounded-2xl text-xs uppercase tracking-widest shadow-[0_0_30px_rgba(168,85,247,0.3)] transition transform active:scale-95">
                                        Broadcast Stage
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right: Audience Forecast -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-gray-900 p-10 rounded-[2rem] border border-white/5">
                        <h4 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-8 text-center">Stage Reach</h4>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-400">Scheduled Sessions</span>
                                <span class="text-xl font-black text-white">{{ \App\Models\Session::count() }}</span>
                            </div>
                            <div class="w-full bg-black h-1.5 rounded-full overflow-hidden border border-white/5">
                                <div class="bg-purple-500 h-full w-[45%] shadow-[0_0_10px_rgba(168,85,247,0.5)]"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-950/20 to-purple-950/20 p-10 rounded-[2rem] border border-purple-500/20">
                        <h4 class="text-xs font-black text-purple-400 uppercase tracking-[0.2em] mb-4">Stage Tip</h4>
                        <p class="text-xs text-gray-500 leading-relaxed font-bold">
                            Live stages with **Active Chat** see an 85% higher retention rate. Ensure your hosters are monitoring the live feed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
