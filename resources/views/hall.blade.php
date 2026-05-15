<x-app-layout>
    @push('head')
        <script src="https://aframe.io/releases/1.4.2/aframe.min.js"></script>
    @endpush
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between items-center gap-4">
            <h2 class="font-black text-xl text-gray-100 leading-tight tracking-tighter uppercase whitespace-nowrap">
                {{ __('Exhibition Halls') }}
            </h2>
            <div class="flex flex-wrap bg-black p-1 rounded-full border border-white/10 overflow-x-auto custom-scrollbar">
                @foreach($halls as $hallKey => $hallData)
                    <a href="{{ route('hall', ['id' => $hallKey]) }}" 
                       class="px-4 py-2 rounded-full text-[10px] font-black transition-all whitespace-nowrap
                       @if($currentHall['id'] == $hallKey)
                           {{ $hallData['classes']['bg'] }} text-white {{ $hallData['classes']['shadow'] }}
                       @else
                           text-gray-500 hover:text-white
                       @endif">
                        {{ strtoupper($hallData['title']) }}
                    </a>
                @endforeach
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Flash Message for successful hosting -->
            @if(session('status'))
            <div class="mb-8 bg-cyan-900/40 border border-cyan-500/50 text-cyan-400 px-6 py-4 rounded-xl flex items-center shadow-[0_0_20px_rgba(34,211,238,0.2)] animate-fade-in-up">
                <span class="text-2xl mr-4">🎉</span>
                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest">{{ session('status') }}</h4>
                    <p class="text-xs text-cyan-500/80 mt-1">Scroll down to the gallery to see your new exhibit.</p>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Hall Area -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- 3D Explore Section -->
                    <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                        <div class="p-8 text-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-3xl font-black gradient-text">{{ $currentHall['title'] }}</h3>
                                    <p class="text-gray-400 text-sm mt-1">{{ $currentHall['desc'] }}</p>
                                </div>
                                <div class="hidden md:block">
                                    <span class="px-4 py-1 rounded-full bg-black/50 border {{ $currentHall['classes']['border'] }} {{ $currentHall['classes']['text'] }} text-[10px] font-black uppercase tracking-widest">3D Mode Active</span>
                                </div>
                            </div>
                            
                            <!-- Hall Viewer -->
                            <div id="viewer-main" class="relative w-full bg-black rounded-xl overflow-hidden shadow-[0_0_50px_rgba(255,255,255,0.05)] border border-white/5">
                                <div class="w-full h-[550px] relative">
                                    <a-scene embedded class="w-full h-full" id="exhibition-scene">
                                        <!-- Asset Management -->
                                        <a-assets>
                                            <img id="hall-env" src="{{ $currentHall['env_image'] }}" crossorigin="anonymous">
                                        </a-assets>

                                        <!-- Environment -->
                                        <a-sky src="#hall-env" rotation="0 -90 0" class="clickable" id="environment-sky"></a-sky>

                                        <!-- Render Placed Items -->
                                        <a-entity id="placed-items-container">
                                            @foreach($placedItems ?? [] as $item)
                                                @if($item->type === 'image')
                                                    <a-image src="{{ $item->url }}" position="{{ $item->x }} {{ $item->y }} {{ $item->z }}" rotation="{{ $item->rotation_x }} {{ $item->rotation_y }} {{ $item->rotation_z }}" scale="{{ $item->scale }} {{ $item->scale }} {{ $item->scale }}" title="{{ $item->title }}"></a-image>
                                                @endif
                                            @endforeach
                                        </a-entity>

                                        <!-- Camera and Cursor -->
                                        <a-entity position="0 1.6 0">
                                            <a-camera look-controls="pointerLockEnabled: false" wasd-controls="enabled: false">
                                                <a-entity cursor="rayOrigin: mouse" raycaster="objects: .clickable; far: 100"></a-entity>
                                            </a-camera>
                                        </a-entity>
                                    </a-scene>

                                    @if(auth()->check() && auth()->user()->role === 'creator')
                                    <!-- Placement Mode Controls -->
                                    <div class="absolute top-4 left-4 z-10">
                                        <button id="btn-placement-toggle" onclick="togglePlacementMode()" class="bg-black/80 backdrop-blur-md border border-white/30 text-white text-[10px] font-black px-4 py-2 rounded-full hover:bg-white/20 transition shadow-lg">
                                            ⚙️ PLACEMENT MODE: OFF
                                        </button>
                                        <div id="placement-indicator" class="hidden mt-2 bg-pink-600/80 backdrop-blur-md border border-pink-400 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg">
                                            Click anywhere in the 3D space to place an item.
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="absolute bottom-4 right-4 flex gap-2 z-10">
                                    <button onclick="toggleFullscreen('viewer-main')" class="bg-black/60 backdrop-blur-md border border-white/10 text-white text-[10px] font-black px-4 py-2 rounded-full {{ $currentHall['classes']['hover_border'] }} transition">⛶ FULLSCREEN</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Images from API -->
                    <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                        <div class="p-8 text-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-3xl font-black gradient-text">{{ $currentHall['title'] }} Gallery</h3>
                                @if(auth()->check() && auth()->user()->role === 'creator')
                                    <button onclick="openHostModal()" class="px-6 py-2 bg-black/40 border {{ $currentHall['classes']['border'] }} {{ $currentHall['classes']['text'] }} text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-white/10 transition">+ Host Here</button>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- 3D Placed Exhibits -->
                                @foreach($placedItems as $item)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-800 {{ $currentHall['classes']['hover_border'] }} {{ $currentHall['classes']['hover_shadow'] }} transition-all duration-500 cursor-pointer" onclick="openModal('{{ $item->url }}')">
                                        <div class="aspect-video bg-gray-800 overflow-hidden relative">
                                            <img src="{{ $item->url }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $item->title ?? 'Exhibit' }}">
                                            <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-sm border border-white/10 px-3 py-1 rounded-full text-[9px] font-black text-white uppercase tracking-widest">
                                                In 3D Hall
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                <h4 class="text-white font-black text-lg">{{ $item->title ?? 'Untitled Exhibit' }}</h4>
                                                <p class="{{ $currentHall['classes']['text'] }} font-bold text-[10px] tracking-widest uppercase">Click to expand overview</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Fallback/Curated API Images -->
                                @foreach(array_slice($images, 0, max(0, 6 - count($placedItems))) as $img)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-800 {{ $currentHall['classes']['hover_border'] }} {{ $currentHall['classes']['hover_shadow'] }} transition-all duration-500 cursor-pointer" onclick="openModal('{{ $img['full'] }}')">
                                        <div class="aspect-video bg-gray-800 overflow-hidden">
                                            <img src="{{ $img['thumb'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" alt="Exhibition">
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                <h4 class="text-white font-black text-lg">Exhibit Detail</h4>
                                                <p class="{{ $currentHall['classes']['text'] }} font-bold text-[10px] tracking-widest uppercase">Click to expand overview</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Hosted Exhibitions -->
                                @foreach($hostedExhibitions as $exhibition)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-800 {{ $currentHall['classes']['hover_border'] }} {{ $currentHall['classes']['hover_shadow'] }} transition-all duration-500 cursor-pointer" onclick="openModal('{{ $exhibition->image_url ?? 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800' }}')">
                                        <div class="aspect-video bg-gray-800 overflow-hidden relative">
                                            <img src="{{ $exhibition->image_url ?? 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $exhibition->title }}">
                                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm border border-white/10 px-3 py-1 rounded-full text-[9px] font-black text-white uppercase tracking-widest">
                                                Live Exhibition
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                <h4 class="text-white font-black text-lg mb-1">{{ $exhibition->title }}</h4>
                                                <p class="text-gray-400 text-[10px] leading-relaxed line-clamp-2">{{ $exhibition->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Empty Host Slots -->
                                @for($slot = 0; $slot < max(0, 3 - count($hostedExhibitions)); $slot++)
                                <div onclick="openHostModal()" class="relative group rounded-xl border-2 border-dashed border-white/10 {{ $currentHall['classes']['hover_border'] }} {{ $currentHall['classes']['hover_shadow'] }} transition-all duration-500 cursor-pointer aspect-video flex flex-col items-center justify-center gap-3 bg-black/20 hover:bg-white/5">
                                    <div class="w-12 h-12 rounded-full border-2 border-dashed border-white/20 group-hover:border-white/50 flex items-center justify-center transition-all duration-300">
                                        <span class="text-2xl text-white/20 group-hover:text-white transition">+</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-white/30 group-hover:text-white font-black text-xs uppercase tracking-widest transition">Host Here</p>
                                        <p class="text-white/20 text-[10px] mt-1">Claim this exhibition slot</p>
                                    </div>
                                    <span class="absolute top-3 right-3 text-[9px] font-black text-white/20 group-hover:text-white uppercase tracking-widest transition">AVAILABLE</span>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Host Exhibition Modal -->
                    <div id="hostModal" class="fixed inset-0 z-[200] hidden bg-black/95 flex items-center justify-center p-4">
                        <div class="bg-gray-900 max-w-lg w-full rounded-2xl border border-gray-700 shadow-[0_0_60px_rgba(255,255,255,0.1)] overflow-hidden">
                            <div class="p-6 bg-gray-800 border-b border-gray-700 flex justify-between items-center">
                                <div>
                                    <h3 class="text-2xl font-black text-white">🚀 Host Your Exhibition</h3>
                                    <p class="text-gray-400 text-xs font-bold mt-1">Claim a slot in {{ $currentHall['title'] }}</p>
                                </div>
                                <button onclick="closeHostModal()" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
                            </div>
                            @if(auth()->check() && auth()->user()->role === 'creator')
                            <form method="POST" action="{{ route('exhibition.store') }}" class="p-6 space-y-4">
                                @csrf
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Exhibition Title <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" placeholder="e.g. Virtual Showcase" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition" required>
                                </div>
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Cover Image URL <span class="text-red-500">*</span></label>
                                    <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition" required>
                                </div>
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Description <span class="text-red-500">*</span></label>
                                    <textarea name="description" rows="2" placeholder="Describe your exhibition..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition resize-none" required></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Hall</label>
                                        <select name="hall" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition">
                                            @foreach($halls as $h)
                                                <option value="{{ $h['id'] }}" {{ $h['id'] == $currentHall['id'] ? 'selected' : '' }}>{{ $h['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Duration</label>
                                        <select name="duration" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition">
                                            <option>1 Day</option>
                                            <option>3 Days</option>
                                            <option selected>1 Week</option>
                                            <option>1 Month</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest transition-all shadow-lg">🚀 Go Live on Exora</button>
                            </form>
                            @else
                            <div class="p-8 text-center">
                                <p class="text-4xl mb-4">🔒</p>
                                <h4 class="text-white font-black text-xl mb-2">Hoster Account Required</h4>
                                <p class="text-gray-400 text-sm mb-6">Only Hosters can claim exhibition slots. Register as a Hoster to go live on Exora!</p>
                                <a href="{{ route('register') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-black py-3 px-8 rounded-xl text-xs uppercase tracking-widest transition">Become a Hoster →</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Placement Modal -->
                    <div id="placementModal" class="fixed inset-0 z-[200] hidden bg-black/95 flex items-center justify-center p-4">
                        <div class="bg-gray-900 max-w-lg w-full rounded-2xl border border-gray-700 shadow-[0_0_60px_rgba(255,255,255,0.1)] overflow-hidden">
                            <div class="p-6 bg-gray-800 border-b border-gray-700 flex justify-between items-center">
                                <div>
                                    <h3 class="text-2xl font-black text-white">🎨 Place Exhibit Item</h3>
                                    <p class="text-gray-400 text-xs font-bold mt-1">Add a new item to the 3D hall</p>
                                </div>
                                <button onclick="closePlacementModal()" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
                            </div>
                            <div class="p-6 space-y-4">
                                <input type="hidden" id="place-x"><input type="hidden" id="place-y"><input type="hidden" id="place-z">
                                <input type="hidden" id="place-rx"><input type="hidden" id="place-ry"><input type="hidden" id="place-rz">
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Item Title</label>
                                    <input type="text" id="place-title" placeholder="e.g. Mona Lisa" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition">
                                </div>
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Image URL <span class="text-red-500">*</span></label>
                                    <input type="url" id="place-url" placeholder="https://..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition" required>
                                </div>
                                <div>
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest block mb-2">Scale</label>
                                    <input type="number" id="place-scale" value="5" step="0.1" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-white/50 transition">
                                </div>
                                <button onclick="submitPlacement()" class="w-full bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white font-black py-4 rounded-xl text-xs uppercase tracking-widest transition-all shadow-lg mt-4">Place Item</button>
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
                                    <h5 class="text-xs font-bold text-gray-200 group-hover:text-white transition">Digital Renaissance</h5>
                                    <p class="text-[10px] text-gray-500 mt-1">2.4k Viewers Today</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-16 h-16 bg-gray-800 rounded-lg overflow-hidden flex-shrink-0 border border-white/5">
                                    <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-gray-200 group-hover:text-white transition">Abstract Futures</h5>
                                    <p class="text-[10px] text-gray-500 mt-1">1.8k Viewers Today</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/5">
                            <h4 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-4">Hall Information</h4>
                            <p class="text-xs text-gray-400 leading-relaxed" id="sidebar-info">
                                You are currently in **{{ $currentHall['title'] }}**. {{ $currentHall['desc'] }}
                            </p>
                            <div class="mt-4 flex items-center text-[10px] font-bold {{ $currentHall['classes']['text'] }}">
                                <span class="w-2 h-2 rounded-full {{ $currentHall['classes']['bg'] }} mr-2 animate-pulse"></span>
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
        function openModal(src) {
            document.getElementById('modalImg').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
        function openHostModal() {
            document.getElementById('hostModal').classList.remove('hidden');
        }
        function closeHostModal() {
            document.getElementById('hostModal').classList.add('hidden');
        }

        function toggleFullscreen(id) {
            const el = document.getElementById(id);
            if (!document.fullscreenElement) {
                el.requestFullscreen().catch(err => console.log(err));
            } else {
                document.exitFullscreen();
            }
        }

        let isPlacementMode = false;
        function togglePlacementMode() {
            isPlacementMode = !isPlacementMode;
            const btn = document.getElementById('btn-placement-toggle');
            const ind = document.getElementById('placement-indicator');
            if (isPlacementMode) {
                btn.innerText = '⚙️ PLACEMENT MODE: ON';
                btn.classList.add('border-pink-500', 'text-pink-400');
                ind.classList.remove('hidden');
            } else {
                btn.innerText = '⚙️ PLACEMENT MODE: OFF';
                btn.classList.remove('border-pink-500', 'text-pink-400');
                ind.classList.add('hidden');
            }
        }

        function closePlacementModal() {
            document.getElementById('placementModal').classList.add('hidden');
        }

        // A-Frame click listener for placement
        if (typeof AFRAME !== 'undefined') {
            AFRAME.registerComponent('placement-listener', {
                init: function () {
                    this.el.addEventListener('click', function (evt) {
                        if (!isPlacementMode) return;
                        const point = evt.detail.intersection.point;
                        
                        // Calculate rotation to face the center (0,0,0) roughly
                        const dx = point.x;
                        const dz = point.z;
                        let ry = Math.atan2(dx, dz) * (180 / Math.PI);
                        
                        document.getElementById('place-x').value = point.x;
                        document.getElementById('place-y').value = point.y;
                        document.getElementById('place-z').value = point.z;
                        document.getElementById('place-rx').value = 0;
                        document.getElementById('place-ry').value = ry;
                        document.getElementById('place-rz').value = 0;
                        
                        document.getElementById('placementModal').classList.remove('hidden');
                    });
                }
            });
            // Attach to sky after it loads
            window.addEventListener('load', () => {
                const sky = document.getElementById('environment-sky');
                if (sky) sky.setAttribute('placement-listener', '');
            });
        }

        function submitPlacement() {
            const data = {
                hall_id: '{{ $currentHall['id'] }}',
                type: 'image',
                title: document.getElementById('place-title').value,
                url: document.getElementById('place-url').value,
                x: document.getElementById('place-x').value,
                y: document.getElementById('place-y').value,
                z: document.getElementById('place-z').value,
                rotation_x: document.getElementById('place-rx').value,
                rotation_y: document.getElementById('place-ry').value,
                rotation_z: document.getElementById('place-rz').value,
                scale: document.getElementById('place-scale').value || 5
            };

            if (!data.url) { alert('URL is required!'); return; }

            fetch('{{ route('exhibit.item.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    closePlacementModal();
                    // Dynamically add to scene
                    const container = document.getElementById('placed-items-container');
                    const img = document.createElement('a-image');
                    img.setAttribute('src', res.item.url);
                    img.setAttribute('position', `${res.item.x} ${res.item.y} ${res.item.z}`);
                    img.setAttribute('rotation', `${res.item.rotation_x} ${res.item.rotation_y} ${res.item.rotation_z}`);
                    img.setAttribute('scale', `${res.item.scale} ${res.item.scale} ${res.item.scale}`);
                    container.appendChild(img);
                    
                    // Reset fields
                    document.getElementById('place-title').value = '';
                    document.getElementById('place-url').value = '';
                } else {
                    alert('Error placing item');
                }
            })
            .catch(err => console.error(err));
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
