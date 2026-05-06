<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-100 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-pink-500 mr-3 shadow-[0_0_10px_rgba(236,72,153,0.5)]"></span>
            {{ __('Trade Booths') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-3xl font-black text-white tracking-tighter uppercase">Marketplace</h3>
                        @if(auth()->check() && auth()->user()->role === 'creator')
                            <a href="{{ route('booth.create') }}" class="bg-pink-600 hover:bg-pink-500 text-white px-8 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition shadow-[0_0_20px_rgba(219,39,119,0.3)]">Add Booth</a>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @forelse($dbBooths as $index => $booth)
                            @php 
                                $imgData = $images[array_rand($images)];
                                $imgThumb = $booth->image_url ?: $imgData['thumb'];
                                $imgFull = $booth->image_url ?: $imgData['full'];
                            @endphp
                            <div class="group bg-black/50 rounded-2xl overflow-hidden border border-white/5 hover:border-pink-500/50 hover:shadow-[0_0_30px_rgba(236,72,153,0.15)] transition-all duration-500 cursor-pointer" onclick="openBoothModal('{{ addslashes($booth->title) }}', '{{ addslashes($booth->description) }}', '{{ $imgFull }}')">
                                <div class="aspect-[4/3] overflow-hidden bg-gray-800">
                                    <img src="{{ $imgThumb }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" alt="Booth">
                                </div>
                                <div class="p-6">
                                    <h4 class="text-white font-black text-xl mb-2 group-hover:text-pink-400 transition-colors">{{ $booth->title }}</h4>
                                    <p class="text-gray-500 text-xs line-clamp-2 leading-relaxed font-bold">{{ $booth->description }}</p>
                                    <div class="mt-4 flex items-center text-[10px] font-black text-pink-500 uppercase tracking-widest">
                                        <span class="w-1.5 h-1.5 rounded-full bg-pink-500 mr-2"></span>
                                        Available Now
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400">No booths available right now.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booth Modal -->
    <div id="boothModal" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center p-4">
        <div class="relative bg-gray-900 max-w-3xl w-full rounded-lg border border-gray-700 overflow-hidden shadow-2xl">
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 text-3xl font-bold z-10" onclick="closeBoothModal()">&times;</button>
            <div class="flex flex-col md:flex-row h-full">
                <div class="md:w-1/2">
                    <img id="boothModalImg" src="" class="w-full h-full object-cover min-h-[300px]">
                </div>
                <div class="md:w-1/2 p-6 flex flex-col justify-center">
                    <h3 id="boothModalTitle" class="text-4xl font-black text-white mb-4 tracking-tighter">Booth Details</h3>
                    <p id="boothModalDesc" class="text-gray-400 mb-8 leading-relaxed">This stall features interactive hoster content and direct engagement channels.</p>
                    <button onclick="openContactModal()" class="w-full bg-pink-600 hover:bg-pink-500 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest shadow-[0_0_20px_rgba(219,39,119,0.3)] transition mb-4">📩 Contact Hoster</button>
                    <button onclick="openGalleryModal()" class="w-full bg-white/5 hover:bg-white/10 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest border border-cyan-500/30 hover:border-cyan-500 transition">🖼️ Enter Gallery</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Hoster Modal -->
    <div id="contactModal" class="fixed inset-0 z-[200] hidden bg-black/95 flex items-center justify-center p-4">
        <div class="bg-gray-900 max-w-lg w-full rounded-2xl border border-pink-500/30 shadow-[0_0_60px_rgba(236,72,153,0.2)] overflow-hidden">
            <div class="p-6 bg-pink-600/10 border-b border-pink-500/20 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-white">📩 Contact Hoster</h3>
                    <p class="text-pink-400 text-xs font-bold mt-1">Send a direct message to the booth owner</p>
                </div>
                <button onclick="closeContactModal()" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Your Name</label>
                    <input type="text" id="contact-name" placeholder="Enter your name" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-pink-500 transition">
                </div>
                <div>
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Your Email</label>
                    <input type="email" id="contact-email" placeholder="your@email.com" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-pink-500 transition">
                </div>
                <div>
                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Message</label>
                    <textarea id="contact-message" rows="4" placeholder="Hi! I'm interested in your booth..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-pink-500 transition resize-none"></textarea>
                </div>
                <button onclick="sendContact()" class="w-full bg-pink-600 hover:bg-pink-500 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest transition shadow-[0_0_20px_rgba(236,72,153,0.3)]">Send Message →</button>
                <div id="contact-success" class="hidden text-center text-green-400 font-black text-sm py-2">✅ Message sent! The hoster will reply soon.</div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 z-[200] hidden bg-black/95 flex items-center justify-center p-4">
        <div class="bg-gray-900 max-w-4xl w-full rounded-2xl border border-cyan-500/30 shadow-[0_0_60px_rgba(34,211,238,0.15)] overflow-hidden">
            <div class="p-6 bg-cyan-600/10 border-b border-cyan-500/20 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-white">🖼️ Gallery View</h3>
                    <p class="text-cyan-400 text-xs font-bold mt-1">Immersive booth gallery experience</p>
                </div>
                <button onclick="closeGalleryModal()" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1563089145-599997674d42?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1483982258113-b72862e6cff6?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                    <div class="aspect-square bg-gray-800 rounded-xl overflow-hidden"><img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery"></div>
                </div>
                <p class="text-center text-gray-500 text-xs font-bold mt-4 uppercase tracking-widest">Swipe to explore all exhibits</p>
            </div>
        </div>
    </div>

    <script>
        function openBoothModal(title, description, imgUrl) {
            document.getElementById('boothModalTitle').innerText = title;
            document.getElementById('boothModalDesc').innerText = description;
            document.getElementById('boothModalImg').src = imgUrl;
            document.getElementById('boothModal').classList.remove('hidden');

            // Gamification: Earn points for interacting with a booth
            fetch('/api/earn-points', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
        }
        function closeBoothModal() {
            document.getElementById('boothModal').classList.add('hidden');
        }
        function openContactModal() {
            document.getElementById('boothModal').classList.add('hidden');
            document.getElementById('contactModal').classList.remove('hidden');
        }
        function closeContactModal() {
            document.getElementById('contactModal').classList.add('hidden');
            document.getElementById('contact-success').classList.add('hidden');
        }
        function sendContact() {
            const name = document.getElementById('contact-name').value.trim();
            const email = document.getElementById('contact-email').value.trim();
            const msg = document.getElementById('contact-message').value.trim();
            if (!name || !email || !msg) { alert('Please fill all fields!'); return; }
            document.getElementById('contact-success').classList.remove('hidden');
            document.getElementById('contact-name').value = '';
            document.getElementById('contact-email').value = '';
            document.getElementById('contact-message').value = '';
            setTimeout(() => closeContactModal(), 3000);
        }
        function openGalleryModal() {
            document.getElementById('boothModal').classList.add('hidden');
            document.getElementById('galleryModal').classList.remove('hidden');
        }
        function closeGalleryModal() {
            document.getElementById('galleryModal').classList.add('hidden');
        }
    </script>
    <x-chatbot />
</x-app-layout>
