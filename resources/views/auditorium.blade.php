<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-100 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-purple-500 mr-3 shadow-[0_0_10px_rgba(168,85,247,0.5)]"></span>
            {{ __('Auditorium') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Stage (Video Player) -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700 mb-8">
                        <div class="p-6 text-gray-100">
                            <h3 class="text-3xl font-black text-white tracking-tighter uppercase mb-6">Live Stage</h3>
                            <div class="w-full aspect-video bg-black rounded-xl overflow-hidden border border-purple-500/30 shadow-[0_0_40px_rgba(192,132,252,0.2)]">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/LqH1PZgpxPs?autoplay=0&rel=0&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <h4 class="text-xl font-bold mt-4">Keynote: Future of Virtual Tech</h4>
                            <p class="text-gray-400 mt-2">Speaker: Dr. Jane Doe | Time: Now</p>
                        </div>
                    </div>

                    <!-- Upcoming Sessions -->
                    <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                        <div class="p-6 text-gray-100">
                            <h3 class="text-3xl font-black text-white tracking-tighter uppercase mb-6">Auditorium Sessions</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                @forelse($sessions as $session)
                                    <div class="group bg-black/50 rounded-2xl overflow-hidden border border-white/5 hover:border-purple-500/50 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)] transition-all duration-500">
                                        <div class="relative h-44 overflow-hidden bg-gray-900 flex items-center justify-center">
                                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&q=80" class="w-full h-full object-cover opacity-40 group-hover:opacity-60 group-hover:scale-105 transition-all duration-700 ease-out" alt="Session">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="w-14 h-14 bg-purple-600/20 backdrop-blur-md rounded-full border border-purple-500/50 flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                                    <span class="text-2xl ml-1">▶️</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h4 class="text-white font-black text-lg mb-1 group-hover:text-purple-400 transition-colors">{{ $session->title }}</h4>
                                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-6">{{ $session->time }}</p>
                                            <button onclick="openSession('{{ $session->title }}', '{{ $session->video_url }}')" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-xl text-[10px] uppercase tracking-[0.2em] transition-all shadow-[0_0_15px_rgba(168,85,247,0.2)]">Join Session</button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-400">No live sessions scheduled right now.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Chat -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700 h-[600px] flex flex-col">
                        <div class="p-4 bg-gray-800 border-b border-gray-700">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">Live Chat <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span></h3>
                        </div>
                        <div id="live-chat-box" class="flex-1 p-4 overflow-y-auto space-y-4">
                            <!-- Messages will load here via AJAX -->
                        </div>
                        <div class="p-4 border-t border-gray-700 bg-gray-800 flex">
                            <input type="text" id="live-chat-input" class="flex-1 bg-gray-700 border-none rounded-l text-white px-3 py-2 text-sm focus:ring-0" placeholder="Type a message..." onkeypress="handleLiveChat(event)">
                            <button onclick="sendLiveChat()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 rounded-r transition">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Session Modal -->
    <div id="sessionModal" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-purple-500 rounded-xl max-w-4xl w-full overflow-hidden shadow-[0_0_50px_rgba(168,85,247,0.4)]">
            <div class="p-4 bg-gray-800 border-b border-gray-700 flex justify-between items-center">
                <h3 id="sessionModalTitle" class="text-xl font-bold text-white">Live Session</h3>
                <button onclick="closeSession()" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>
            <div class="aspect-video bg-black">
                <iframe id="sessionIframe" class="w-full h-full" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="p-4 text-center text-gray-400 text-sm italic">
                Enjoy the live virtual presentation!
            </div>
        </div>
    </div>

    <script>
        function openSession(title, url) {
            // Convert YouTube URL to Embed URL if needed
            let embedUrl = url;
            if (url.includes('youtube.com/watch?v=')) {
                embedUrl = url.replace('watch?v=', 'embed/');
            } else if (url.includes('youtu.be/')) {
                embedUrl = url.replace('youtu.be/', 'youtube.com/embed/');
            }
            
            document.getElementById('sessionModalTitle').innerText = title;
            document.getElementById('sessionIframe').src = embedUrl || 'https://www.youtube.com/embed/dQw4w9WgXcQ'; // Default demo
            document.getElementById('sessionModal').classList.remove('hidden');

            // Earn points for attending!
            fetch('/api/earn-points', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
        }

        function closeSession() {
            document.getElementById('sessionModal').classList.add('hidden');
            document.getElementById('sessionIframe').src = '';
        }

        function loadLiveChat() {
            fetch('/api/chat')
            .then(res => res.json())
            .then(messages => {
                const box = document.getElementById('live-chat-box');
                box.innerHTML = '';
                messages.forEach(msg => {
                    box.innerHTML += `<div class="text-sm text-gray-300"><strong class="text-purple-400">${msg.user_name}:</strong> ${msg.message}</div>`;
                });
                box.scrollTop = box.scrollHeight;
            });
        }

        function sendLiveChat() {
            const input = document.getElementById('live-chat-input');
            const message = input.value.trim();
            if(!message) return;

            fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            }).then(() => {
                input.value = '';
                loadLiveChat();
            });
        }

        function handleLiveChat(e) {
            if (e.key === 'Enter') sendLiveChat();
        }

        // Poll for new messages every 3 seconds
        setInterval(loadLiveChat, 3000);
        loadLiveChat(); // Load immediately
    </script>
            </div>
        </div>
    </div>
    <x-chatbot />
</x-app-layout>
