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

            <!-- Extended Analytics & Content Management -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                <div class="lg:col-span-2 bg-gray-900 p-10 rounded-[2rem] border border-white/5">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-8">Recent Exhibitions</h3>
                    <div class="space-y-4">
                        @forelse(\App\Models\Exhibition::where('creator_id', auth()->id())->latest()->take(3)->get() as $exhibition)
                        <div class="bg-black/30 p-6 rounded-2xl border border-white/5 flex justify-between items-center hover:border-green-400/30 transition-all cursor-pointer">
                            <div>
                                <h4 class="text-white font-bold">{{ $exhibition->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $exhibition->description }}</p>
                            </div>
                            <span class="bg-green-500/10 text-green-400 text-[10px] font-black px-3 py-1 rounded-full uppercase">Active</span>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 text-sm">No exhibitions hosted yet. <a href="{{ route('exhibition.create') }}" class="text-green-400 hover:underline">Create your first one!</a></div>
                        @endforelse
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-950/20 to-emerald-950/20 p-10 rounded-[2rem] border border-green-500/20 flex flex-col justify-center">
                    <h4 class="text-xs font-black text-green-400 uppercase tracking-[0.2em] mb-4">Hoster Tip</h4>
                    <p class="text-sm text-gray-400 leading-relaxed font-bold mb-6">
                        Take advantage of the new <span class="text-white">3D Placement Mode</span>. Visit your exhibition halls to dynamically place artworks, 3D models, and videos directly onto the walls of the virtual space!
                    </p>
                    <a href="{{ route('hall') }}" class="inline-block bg-green-600 hover:bg-green-500 text-white font-black py-3 px-6 rounded-xl text-xs uppercase tracking-widest transition text-center shadow-lg">Enter 3D Halls</a>
                </div>
            </div>
            </div>

            <!-- How To Manage Exora (For Presentation) -->
            <div class="mt-8 bg-gray-900 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-white/5 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-blue-500/10 opacity-50"></div>
                <div class="p-10 text-gray-100 relative z-10">
                    <h3 class="text-2xl font-black mb-6 tracking-tighter">Platform <span class="text-green-400">Capabilities</span> Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-green-400 mb-2">3D Placement Mode</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Enter any 3D Hall and toggle "Placement Mode". Click directly on the walls to inject database-driven artwork into the scene for all visitors to see.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-blue-400 mb-2">Rich Media Booths</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">When creating Booths, add YouTube embed links. The marketplace will dynamically render a video player or an image gallery based on the content.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-yellow-400 mb-2">Live Session Hosting</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Schedule keynotes for the Auditorium. Provide stream links and interact with the live AJAX-powered chat to engage your audience.</p>
                        </div>
                        <div class="p-6 bg-black/40 rounded-2xl border border-white/5">
                            <h4 class="text-lg font-bold text-purple-400 mb-2">Data Persistence</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">All exhibits, chat messages, and user points are persistently stored in the cloud (MongoDB), ensuring a seamless, stateful experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
