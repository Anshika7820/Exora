<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exora | Next-Gen Virtual Exhibition Platform</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .hero-glow {
                background: radial-gradient(circle at 50% 50%, rgba(34, 211, 238, 0.1) 0%, transparent 50%);
            }
            .glass-nav {
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(15px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body class="antialiased bg-[#050505] text-white selection:bg-cyan-500 selection:text-white">
        
        <!-- Navigation -->
        <nav class="fixed w-full z-[100] glass-nav">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <x-application-logo class="h-10 w-auto" />
                    <div class="text-2xl font-black tracking-tighter gradient-text">
                        Exora
                    </div>
                </div>
                <div class="hidden md:flex space-x-8 text-sm font-semibold text-gray-400 uppercase tracking-widest">
                    <a href="#vision" class="hover:text-white transition">Vision</a>
                    <a href="#experience" class="hover:text-white transition">Experience</a>
                    <a href="#stats" class="hover:text-white transition">Live Stats</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold bg-white text-black px-6 py-2 rounded-full hover:bg-gray-200 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-300 hover:text-white">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm font-bold bg-cyan-600 px-6 py-2 rounded-full hover:bg-cyan-500 transition shadow-[0_0_20px_rgba(8,145,178,0.3)]">Join Exora</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-40 pb-24 px-6 overflow-hidden hero-glow">
            <div class="max-w-6xl mx-auto text-center relative z-10">
                <div class="inline-block px-4 py-1.5 mb-8 rounded-full border border-cyan-500/30 bg-cyan-500/10 text-cyan-400 text-[10px] font-black tracking-[0.2em] uppercase animate-pulse">
                    The Infinite Exhibition Space
                </div>
                <h1 class="text-6xl md:text-9xl font-black tracking-tighter mb-10 leading-[0.85]">
                    Where <span class="gradient-text">Brands</span><br>Become Worlds.
                </h1>
                <p class="text-xl md:text-2xl text-gray-400 mb-14 max-w-3xl mx-auto leading-relaxed">
                    Exora is the world's most immersive virtual exhibition platform. We don't just host events; we build digital ecosystems where engagement knows no bounds.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('register') }}" class="bg-white text-black font-black py-5 px-14 rounded-full text-xl hover:scale-105 transition active:scale-95 shadow-2xl">
                        Start Your Journey
                    </a>
                    <a href="#vision" class="bg-white/5 backdrop-blur-md border border-white/10 text-white font-bold py-5 px-14 rounded-full text-xl hover:bg-white/10 transition">
                        Explore Vision
                    </a>
                </div>
            </div>
            
            <!-- Floating Decorative Elements -->
            <div class="absolute top-1/4 left-0 w-64 h-64 bg-cyan-500/10 rounded-full blur-[120px] -z-10"></div>
            <div class="absolute bottom-1/4 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-[150px] -z-10"></div>
        </header>

        <!-- Stats Bar -->
        <section id="stats" class="py-16 border-y border-white/5 bg-white/[0.01]">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                    <div class="text-center">
                        <div class="text-5xl font-black gradient-text mb-2">950+</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-[0.3em] font-black">Digital Booths</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-black gradient-text mb-2">45k+</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-[0.3em] font-black">Monthly Visitors</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-black gradient-text mb-2">0.2s</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-[0.3em] font-black">Latency Response</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-black gradient-text mb-2">100%</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-[0.3em] font-black">Cloud Uptime</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section id="vision" class="py-32 px-6">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-24 items-center">
                <div class="relative group order-2 md:order-1">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=1200" alt="Exora Vision" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <h2 class="text-5xl md:text-6xl font-black mb-8 leading-tight">
                        Exhibition as a <br><span class="text-cyan-500">Service</span>.
                    </h2>
                    <p class="text-gray-400 text-xl mb-10 leading-relaxed">
                        Exora redefines how we connect with creators. Our platform provides a borderless environment where interactive 3D galleries meet high-speed networking. No physical limitations, just infinite creative potential.
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/5">
                            <h4 class="font-bold text-white mb-2">Global Scale</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">Reach audiences in every corner of the world simultaneously.</p>
                        </div>
                        <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/5">
                            <h4 class="font-bold text-white mb-2">Real-time Data</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">Analyze every visitor interaction with pinpoint accuracy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Experience Grid -->
        <section id="experience" class="py-32 bg-gradient-to-b from-transparent to-white/[0.02] px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="section-title">The Exora Experience</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="info-card">
                        <div class="w-16 h-16 bg-cyan-500/20 rounded-2xl flex items-center justify-center text-3xl mb-8 border border-cyan-500/20">🏛️</div>
                        <h3 class="text-2xl font-bold mb-4">Multi-Hall Exploration</h3>
                        <p class="text-gray-400 leading-relaxed text-sm">Switch seamlessly between Hall A (Main Atrium) and Hall B (Tech-Expanse) to explore curated 3D sculptures and digital art.</p>
                    </div>
                    <div class="info-card">
                        <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center text-3xl mb-8 border border-purple-500/20">🎤</div>
                        <h3 class="text-2xl font-bold mb-4">Interactive Auditoriums</h3>
                        <p class="text-gray-400 leading-relaxed text-sm">Join live keynote sessions with integrated real-time chat. Speak with global leaders directly from your dashboard.</p>
                    </div>
                    <div class="info-card">
                        <div class="w-16 h-16 bg-pink-500/20 rounded-2xl flex items-center justify-center text-3xl mb-8 border border-pink-500/20">🎫</div>
                        <h3 class="text-2xl font-bold mb-4">Expo Passport</h3>
                        <p class="text-gray-400 leading-relaxed text-sm">Gamify your journey. Collect stamps, earn points, and climb the global leaderboard as you engage with different brands.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works -->
        <section class="py-32 px-6 border-t border-white/5">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-5xl font-black mb-6">Start Exploring in Seconds</h2>
                    <p class="text-gray-500 max-w-xl mx-auto">Getting started with Exora is as simple as creating a profile. Your digital passport is your key to the infinite.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-16 relative">
                    <!-- Line connecting steps -->
                    <div class="hidden md:block absolute top-10 left-0 w-full h-[1px] bg-gradient-to-r from-cyan-500/50 to-purple-500/50 -z-10"></div>
                    
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full bg-[#050505] flex items-center justify-center font-black text-2xl text-cyan-400 border-4 border-cyan-500/20 mb-8">01</div>
                        <h4 class="text-xl font-bold mb-4">Identity</h4>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">Register as a Participater or Hoster and activate your unique virtual passport.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full bg-[#050505] flex items-center justify-center font-black text-2xl text-purple-400 border-4 border-purple-500/20 mb-8">02</div>
                        <h4 class="text-xl font-bold mb-4">Exploration</h4>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">Navigate through 3D halls, visit booths, and attend live sessions.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full bg-[#050505] flex items-center justify-center font-black text-2xl text-pink-400 border-4 border-pink-500/20 mb-8">03</div>
                        <h4 class="text-xl font-bold mb-4">Engagement</h4>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">Earn points for every interaction and unlock exclusive brand rewards.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-24 border-t border-white/5 px-6 bg-black">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-16 mb-20">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-8">
                            <x-application-logo class="h-10 w-auto" />
                            <div class="text-3xl font-black gradient-text">Exora</div>
                        </div>
                        <p class="text-gray-500 max-w-sm mb-10 leading-relaxed text-lg">
                            Leading the evolution of digital experiences. Join us as we redefine how the world interacts with creativity and technology.
                        </p>
                        <div class="flex space-x-6">
                            <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center hover:bg-cyan-500 transition cursor-pointer text-xl">𝕏</div>
                            <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center hover:bg-cyan-500 transition cursor-pointer text-xl">📸</div>
                            <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center hover:bg-cyan-500 transition cursor-pointer text-xl">💼</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-8 text-gray-400">Navigation</h4>
                        <ul class="space-y-5 text-gray-500 font-semibold">
                            <li><a href="{{ route('hall') }}" class="hover:text-cyan-400 transition">Virtual Halls</a></li>
                            <li><a href="{{ route('auditorium') }}" class="hover:text-cyan-400 transition">Live Auditoriums</a></li>
                            <li><a href="{{ route('booths') }}" class="hover:text-cyan-400 transition">Exhibitor Booths</a></li>
                            <li><a href="{{ route('feedback') }}" class="hover:text-cyan-400 transition">Feedback Center</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-8 text-gray-400">Resources</h4>
                        <ul class="space-y-5 text-gray-500 font-semibold">
                            <li><a href="#" class="hover:text-cyan-400 transition">Creator Guide</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition">API Documentation</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition">Press Kit</a></li>
                            <li><a href="#" class="hover:text-cyan-400 transition">Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="text-center pt-10 border-t border-white/5 text-gray-600 text-[10px] tracking-[0.4em] font-black uppercase">
                    &copy; {{ date('Y') }} Exora digital solutions. Infinite possibilities.
                </div>
            </div>
        </footer>

        <x-chatbot />
    </body>
</html>
