<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <span class="w-2 h-2 rounded-full bg-cyan-500 mr-3 shadow-[0_0_10px_rgba(34,211,238,0.5)]"></span>
            {{ __('About Exora') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/5 overflow-hidden shadow-2xl sm:rounded-[2rem] relative">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-purple-500/10 opacity-50"></div>
                <div class="p-12 text-gray-100 relative z-10">
                    <h3 class="text-5xl font-black mb-6 tracking-tighter">The Vision of <span class="text-cyan-400">Exora</span></h3>
                    <p class="text-gray-400 max-w-3xl text-xl leading-relaxed mb-8">
                        Exora is a next-generation virtual exhibition platform designed to break down the physical barriers of traditional events. By leveraging WebGL technology, real-time communication, and scalable MongoDB architecture, we provide a seamless, borderless digital ecosystem for creators and participants alike.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 mb-16">
                        <div class="bg-black/40 p-8 rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all">
                            <div class="text-4xl mb-4">🌍</div>
                            <h4 class="text-xl font-bold text-white mb-2">Borderless Scale</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">Reach global audiences without the constraints of physical venues or travel logistics. Host up to 10,000 concurrent viewers per exhibition space.</p>
                        </div>
                        <div class="bg-black/40 p-8 rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all">
                            <div class="text-4xl mb-4">🖼️</div>
                            <h4 class="text-xl font-bold text-white mb-2">Immersive 3D Engine</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">Engage with high-fidelity, dynamic 360-degree exhibition halls and artwork placement powered by A-Frame and WebGL.</p>
                        </div>
                        <div class="bg-black/40 p-8 rounded-2xl border border-white/5 hover:border-pink-500/30 transition-all">
                            <div class="text-4xl mb-4">🚀</div>
                            <h4 class="text-xl font-bold text-white mb-2">Real-time Data</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">Powered by an advanced MongoDB infrastructure ensuring high availability, lightning-fast queries, and seamless chat data flow.</p>
                        </div>
                    </div>

                    <!-- Tech Stack Section -->
                    <div class="border-t border-white/10 pt-12">
                        <h3 class="text-3xl font-black mb-8 tracking-tighter">Powered by <span class="text-purple-400">Next-Gen Tech</span></h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gray-800/50 p-6 rounded-xl text-center border border-white/5">
                                <h5 class="text-white font-black text-lg mb-1">Laravel</h5>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Core Framework</p>
                            </div>
                            <div class="bg-gray-800/50 p-6 rounded-xl text-center border border-white/5">
                                <h5 class="text-white font-black text-lg mb-1">MongoDB</h5>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">NoSQL Database</p>
                            </div>
                            <div class="bg-gray-800/50 p-6 rounded-xl text-center border border-white/5">
                                <h5 class="text-white font-black text-lg mb-1">A-Frame</h5>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">3D Rendering</p>
                            </div>
                            <div class="bg-gray-800/50 p-6 rounded-xl text-center border border-white/5">
                                <h5 class="text-white font-black text-lg mb-1">Tailwind CSS</h5>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Glass UI Design</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
