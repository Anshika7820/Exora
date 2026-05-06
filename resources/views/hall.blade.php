<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-100 leading-tight tracking-tighter uppercase">
                {{ __('Exhibition Hall') }}
            </h2>
            <div class="flex bg-black p-1 rounded-full border border-white/10">
                <button onclick="switchHall('A')" id="btn-hall-a" class="px-8 py-2 rounded-full text-[10px] font-black transition-all bg-cyan-600 text-white shadow-[0_0_15px_rgba(8,145,178,0.4)]">ATRIUM A</button>
                <button onclick="switchHall('B')" id="btn-hall-b" class="px-8 py-2 rounded-full text-[10px] font-black transition-all text-gray-500 hover:text-white">EXPANSE B</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Hall Area -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- 3D Explore Section -->
                    <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                        <div class="p-8 text-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-3xl font-black gradient-text" id="hall-title">Immersive Atrium A</h3>
                                    <p class="text-gray-400 text-sm mt-1" id="hall-desc">Navigating through the Main Atrium. Engage with high-fidelity exhibits.</p>
                                </div>
                                <div class="hidden md:block">
                                    <span class="px-4 py-1 rounded-full bg-cyan-500/10 border border-cyan-500 text-cyan-500 text-[10px] font-black uppercase tracking-widest">3D Mode Active</span>
                                </div>
                            </div>
                            
                            <!-- Hall A Viewer -->
                            <div id="viewer-hall-a" class="w-full h-[550px] bg-black rounded-xl overflow-hidden relative shadow-[0_0_50px_rgba(34,211,238,0.2)] border border-white/5">
                                <iframe title="Virtual Exhibition Gallery A" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/231fdb3e9e354c6faaa3c250f8c9988f/embed?autostart=1&ui_theme=dark" class="w-full h-full"> </iframe>
                            </div>

                            <!-- Hall B Viewer (Hidden initially) -->
                            <div id="viewer-hall-b" class="hidden w-full h-[550px] bg-black rounded-xl overflow-hidden relative shadow-[0_0_50px_rgba(168,85,247,0.2)] border border-white/5">
                                <iframe title="Virtual Exhibition Gallery B" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/4442df39a3f24097b6a908233f001f3f/embed?autostart=1&ui_theme=dark" class="w-full h-full"> </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Images from API -->
                    <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                        <div class="p-8 text-gray-100">
                            <h3 class="text-3xl font-black mb-6 gradient-text">Exhibition Sections</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($images as $img)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-800 hover:border-cyan-400/50 hover:shadow-[0_0_30px_rgba(34,211,238,0.15)] transition-all duration-500 cursor-pointer" onclick="openModal('{{ $img['full'] }}')">
                                        <div class="aspect-video bg-gray-800 overflow-hidden">
                                            <img src="{{ $img['thumb'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" alt="Exhibition">
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                <h4 class="text-white font-black text-lg">Section Detail</h4>
                                                <p class="text-cyan-400 font-bold text-[10px] tracking-widest uppercase">Click to expand overview</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-gray-900/80 rounded-2xl border border-gray-800 sticky top-24">
                        <h4 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-4">Trending Exhibits</h4>
                        <div class="space-y-6">
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-16 h-16 bg-gray-800 rounded-lg overflow-hidden flex-shrink-0 border border-white/5">
                                    <img src="https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-gray-200 group-hover:text-cyan-400 transition">Digital Renaissance</h5>
                                    <p class="text-[10px] text-gray-500 mt-1">2.4k Viewers Today</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-16 h-16 bg-gray-800 rounded-lg overflow-hidden flex-shrink-0 border border-white/5">
                                    <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-gray-200 group-hover:text-cyan-400 transition">Abstract Futures</h5>
                                    <p class="text-[10px] text-gray-500 mt-1">1.8k Viewers Today</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/5">
                            <h4 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-4">Hall Information</h4>
                            <p class="text-xs text-gray-400 leading-relaxed" id="sidebar-info">
                                You are currently in **Atrium A**. This space features core digital sculptures and interactive hoster displays.
                            </p>
                            <div class="mt-4 flex items-center text-[10px] font-bold text-cyan-500">
                                <span class="w-2 h-2 rounded-full bg-cyan-500 mr-2 animate-pulse"></span>
                                LIVE SERVER SYNC ACTIVE
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-black/95 flex items-center justify-center p-4 backdrop-blur-sm" onclick="closeModal()">
        <div class="relative max-w-5xl w-full animate-slide-in-up">
            <button class="absolute -top-12 right-0 text-white hover:text-gray-300 text-sm font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                CLOSE VIEW
            </button>
            <div class="bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 shadow-2xl">
                <img id="modalImg" src="" class="w-full max-h-[70vh] object-contain bg-black">
                <div class="p-8">
                    <h3 class="text-2xl font-black text-white mb-2">Detailed Section Analysis</h3>
                    <p class="text-gray-400">Our high-resolution exhibits allow for deep zoom and detailed exploration. Use this view to appreciate the finer points of the creative work.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchHall(hall) {
            const hallA = document.getElementById('viewer-hall-a');
            const hallB = document.getElementById('viewer-hall-b');
            const btnA = document.getElementById('btn-hall-a');
            const btnB = document.getElementById('btn-hall-b');
            const title = document.getElementById('hall-title');
            const desc = document.getElementById('hall-desc');
            const info = document.getElementById('sidebar-info');

            if (hall === 'A') {
                hallA.classList.remove('hidden');
                hallB.classList.add('hidden');
                btnA.className = 'px-8 py-2 rounded-full text-[10px] font-black transition-all bg-cyan-600 text-white shadow-[0_0_15px_rgba(8,145,178,0.4)]';
                btnB.className = 'px-8 py-2 rounded-full text-[10px] font-black transition-all text-gray-500 hover:text-white';
                title.innerText = 'Immersive Atrium A';
                desc.innerText = 'Navigating through the Main Atrium. Engage with high-fidelity exhibits.';
                info.innerText = 'You are currently in Atrium A. This hall features core digital sculptures and interactive hoster displays.';
            } else {
                hallA.classList.add('hidden');
                hallB.classList.remove('hidden');
                btnB.className = 'px-8 py-2 rounded-full text-[10px] font-black transition-all bg-purple-600 text-white shadow-[0_0_15px_rgba(147,51,234,0.4)]';
                btnA.className = 'px-8 py-2 rounded-full text-[10px] font-black transition-all text-gray-500 hover:text-white';
                title.innerText = 'Tech-Expanse B';
                desc.innerText = 'Exploring the Digital Frontier. Immerse yourself in the future.';
                info.innerText = 'Welcome to the Tech-Expanse. This expanse showcases emerging hoster visions and futuristic digital architecture.';
            }
        }

        function openModal(src) {
            document.getElementById('modalImg').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        window.addEventListener('DOMContentLoaded', () => {
            fetch('/api/earn-points', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            fetch('/api/record-view', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
        });
    </script>
    <x-chatbot />
</x-app-layout>
