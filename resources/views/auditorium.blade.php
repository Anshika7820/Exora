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
                            <div class="w-full aspect-video bg-black rounded-lg overflow-hidden border border-gray-700 shadow-[0_0_20px_rgba(192,132,252,0.3)]">
                                <!-- Dummy Video Player -->
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <h4 class="text-xl font-bold mt-4">Keynote: Future of Virtual Tech</h4>
                            <p class="text-gray-400 mt-2">Speaker: Dr. Jane Doe | Time: Now</p>
                        </div>
                    </div>

                    <!-- Upcoming Sessions -->
                    <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                        <div class="p-6 text-gray-100">
                            <h3 class="text-3xl font-black text-white tracking-tighter uppercase mb-6">Auditorium Sessions</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                @forelse($sessions as $session)
                                    <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-purple-400 transition-all">
                                        <div class="relative h-40 bg-gray-900 flex items-center justify-center">
                                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover opacity-50" alt="Session">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white shadow-lg">▶️</div>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h4 class="text-white font-bold">{{ $session->title }}</h4>
                                            <p class="text-gray-400 text-sm mb-4">{{ $session->time }}</p>
                                            <button onclick="openSession('{{ $session->title }}', '{{ $session->video_url }}')" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded transition">Join Session</button>
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
