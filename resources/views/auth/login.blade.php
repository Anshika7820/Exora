<x-guest-layout>
    <div class="flex w-full min-h-screen">
        <!-- Left Side: Immersive Image -->
        <div class="hidden lg:flex w-1/2 relative overflow-hidden bg-black items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=1200" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-screen scale-105" alt="Virtual Exhibition">
            
            <div class="relative z-20 p-16 w-full max-w-2xl">
                <a href="/" class="text-4xl font-black tracking-tighter gradient-text mb-12 inline-block">
                    Exora
                </a>
                <h1 class="text-5xl font-black text-white leading-tight mb-6">
                    Enter the<br>
                    <span class="text-cyan-400">Digital Realm.</span>
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed max-w-md">
                    Access your global exhibitions, live auditoriums, and interactive 3D galleries. The future of events starts here.
                </p>
                
                <div class="mt-16 flex gap-4">
                    <div class="w-12 h-1 bg-cyan-500 rounded-full shadow-[0_0_10px_rgba(34,211,238,0.5)]"></div>
                    <div class="w-4 h-1 bg-white/20 rounded-full"></div>
                    <div class="w-4 h-1 bg-white/20 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 relative">
            <div class="w-full max-w-md">
                <div class="lg:hidden mb-12 text-center">
                    <a href="/" class="text-4xl font-black tracking-tighter gradient-text">Exora</a>
                </div>
                
                <h2 class="text-3xl font-black text-white mb-2">Welcome Back</h2>
                <p class="text-gray-400 text-sm mb-10">Sign in to your Exora account to continue.</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="relative group">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-cyan-400" />
                        <x-text-input id="email" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-cyan-500 focus:bg-white/10 focus:ring-cyan-500 transition-all duration-300 shadow-inner" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@company.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs font-bold" />
                    </div>

                    <!-- Password -->
                    <div class="relative group">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-cyan-400" />
                        <x-text-input id="password" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-cyan-500 focus:bg-white/10 focus:ring-cyan-500 transition-all duration-300 shadow-inner"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs font-bold" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <div class="relative flex items-center justify-center w-5 h-5 border border-white/20 rounded bg-white/5 group-hover:border-cyan-500 transition">
                                <input id="remember_me" type="checkbox" class="absolute w-full h-full opacity-0 cursor-pointer peer" name="remember">
                                <svg class="w-3 h-3 text-cyan-400 opacity-0 peer-checked:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="ms-3 text-xs font-bold text-gray-500 group-hover:text-gray-300 transition uppercase tracking-wider">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-gray-500 hover:text-cyan-400 transition uppercase tracking-wider" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full relative group overflow-hidden bg-white/5 border border-white/10 hover:border-cyan-500/50 text-white font-black py-4 px-6 rounded-xl text-xs uppercase tracking-[0.2em] transition-all duration-300">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-cyan-600/50 to-blue-600/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                {{ __('Log in to Platform') }}
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                    
                    <div class="text-center pt-8 border-t border-white/5 mt-8">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                            New to Exora? 
                            <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 ml-2 transition">Create an account</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
