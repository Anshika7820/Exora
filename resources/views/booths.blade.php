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
                    <button class="w-full bg-pink-600 hover:bg-pink-500 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest shadow-[0_0_20px_rgba(219,39,119,0.3)] transition mb-4">Contact Hoster</button>
                    <button class="w-full bg-white/5 hover:bg-white/10 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest border border-white/10 transition">Enter Gallery</button>
                </div>
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
    </script>
    <x-chatbot />
</x-app-layout>
