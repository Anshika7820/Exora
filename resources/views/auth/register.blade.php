<x-guest-layout>
    <div class="flex w-full min-h-screen">
        <!-- Left Side: Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 relative z-20">
            <div class="w-full max-w-md">
                <div class="lg:hidden mb-12 text-center">
                    <a href="/" class="text-4xl font-black tracking-tighter gradient-text">Exora</a>
                </div>
                
                <h2 class="text-3xl font-black text-white mb-2">Join Exora</h2>
                <p class="text-gray-400 text-sm mb-10">Create your account to start exploring or hosting.</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div class="relative group">
                        <x-input-label for="name" :value="__('Full Name')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-purple-400" />
                        <x-text-input id="name" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-purple-500 focus:bg-white/10 focus:ring-purple-500 transition-all duration-300 shadow-inner" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs font-bold" />
                    </div>

                    <!-- Email Address -->
                    <div class="relative group">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-purple-400" />
                        <x-text-input id="email" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-purple-500 focus:bg-white/10 focus:ring-purple-500 transition-all duration-300 shadow-inner" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@company.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs font-bold" />
                    </div>

                    <!-- Passwords Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Password -->
                        <div class="relative group">
                            <x-input-label for="password" :value="__('Password')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-purple-400" />
                            <x-text-input id="password" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-purple-500 focus:bg-white/10 focus:ring-purple-500 transition-all duration-300 shadow-inner"
                                            type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs font-bold" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative group">
                            <x-input-label for="password_confirmation" :value="__('Confirm')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-purple-400" />
                            <x-text-input id="password_confirmation" class="block w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-purple-500 focus:bg-white/10 focus:ring-purple-500 transition-all duration-300 shadow-inner"
                                            type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-xs font-bold" />
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="relative group mt-2">
                        <x-input-label for="role" :value="__('Account Type')" class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2 block transition group-focus-within:text-purple-400" />
                        <div class="relative">
                            <select id="role" name="role" class="appearance-none block w-full bg-white/5 border border-white/10 text-white focus:border-purple-500 focus:bg-white/10 focus:ring-purple-500 rounded-xl px-5 py-4 shadow-inner transition-all duration-300 cursor-pointer" required>
                                <option value="visitor" class="bg-gray-900 text-white">Participater (Explore Events)</option>
                                <option value="creator" class="bg-gray-900 text-white">Hoster (Create Exhibitions)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-400 text-xs font-bold" />
                    </div>

                    <div class="pt-6">
                        <button type="submit" id="reg-btn" class="w-full relative group overflow-hidden bg-white/5 border border-white/10 hover:border-purple-500/50 text-white font-black py-4 px-6 rounded-xl text-xs uppercase tracking-[0.2em] transition-all duration-300">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-600/50 to-pink-600/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                {{ __('Create Account') }}
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>

                    <div class="text-center pt-8 border-t border-white/5 mt-8">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                            Already registered? 
                            <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300 ml-2 transition">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Immersive Image -->
        <div class="hidden lg:flex w-1/2 relative overflow-hidden bg-black items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=1200" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-screen scale-105" alt="Abstract 3D Art">
            
            <div class="relative z-20 p-16 w-full max-w-2xl text-right">
                <h1 class="text-5xl font-black text-white leading-tight mb-6">
                    Showcase Your<br>
                    <span class="text-purple-400">Masterpieces.</span>
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed ml-auto max-w-md">
                    Join as a Hoster to place your 3D digital art in immersive galleries, or join as a Participater to explore the metaverse of creativity.
                </p>
                
                <div class="mt-16 flex gap-4 justify-end">
                    <div class="w-4 h-1 bg-white/20 rounded-full"></div>
                    <div class="w-4 h-1 bg-white/20 rounded-full"></div>
                    <div class="w-12 h-1 bg-purple-500 rounded-full shadow-[0_0_10px_rgba(168,85,247,0.5)]"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        
        function validate() {
            if (confirm.value && password.value !== confirm.value) {
                confirm.style.borderColor = 'rgba(239, 68, 68, 0.5)';
                confirm.style.boxShadow = 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06), 0 0 10px rgba(239, 68, 68, 0.2)';
            } else if (confirm.value) {
                confirm.style.borderColor = 'rgba(168, 85, 247, 0.5)';
                confirm.style.boxShadow = 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06), 0 0 10px rgba(168, 85, 247, 0.2)';
            }
        }

        password.addEventListener('input', validate);
        confirm.addEventListener('input', validate);
    </script>
</x-guest-layout>
