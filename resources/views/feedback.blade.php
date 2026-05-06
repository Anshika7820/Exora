<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-100 leading-tight flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-cyan-500 shadow-[0_0_10px_rgba(34,211,238,0.5)]"></span>
            {{ __('Share Your Experience') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#050505] min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-8 bg-green-500/10 border border-green-500/40 text-green-400 p-6 rounded-2xl flex items-center gap-4 shadow-[0_0_30px_rgba(34,197,94,0.1)]">
                    <span class="text-3xl">✅</span>
                    <div>
                        <p class="font-black text-lg">Feedback Received!</p>
                        <p class="text-sm text-green-500/70">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Form -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-900/60 backdrop-blur-md rounded-2xl border border-white/5 shadow-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="p-8 border-b border-white/5 bg-gradient-to-r from-cyan-600/10 to-purple-600/10">
                            <h3 class="text-3xl font-black text-white tracking-tighter">Rate Your Exora Experience</h3>
                            <p class="text-gray-400 mt-2 text-sm">Your feedback shapes the future of virtual exhibitions.</p>
                        </div>

                        <form method="POST" action="{{ route('feedback.store') }}" class="p-8 space-y-6">
                            @csrf

                            <!-- Star Rating -->
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Overall Rating <span class="text-red-500">*</span></label>
                                <div class="flex gap-3" id="star-container">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" onclick="setRating({{ $i }})" id="star-{{ $i }}"
                                            class="text-4xl transition-all duration-200 hover:scale-125 text-gray-600 hover:text-yellow-400 focus:outline-none">
                                            ★
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" required>
                                <p id="rating-label" class="text-xs text-gray-500 mt-2 font-bold">Click a star to rate</p>
                                @error('rating') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Name & Email Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-cyan-500 focus:shadow-[0_0_15px_rgba(34,211,238,0.1)] transition"
                                        placeholder="Your full name" required>
                                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-cyan-500 focus:shadow-[0_0_15px_rgba(34,211,238,0.1)] transition"
                                        placeholder="your@email.com" required>
                                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Feedback Category</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach(['Exhibition Hall', 'Auditorium', 'Marketplace', 'General'] as $cat)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="category" value="{{ $cat }}" class="sr-only peer" {{ $loop->first ? 'checked' : '' }}>
                                        <div class="text-center py-3 px-2 rounded-xl border border-white/10 peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 peer-checked:text-cyan-400 text-gray-500 text-xs font-black uppercase tracking-wider transition-all hover:border-white/30">
                                            {{ $cat }}
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Your Feedback <span class="text-red-500">*</span></label>
                                <textarea name="message" id="message" rows="5"
                                    class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-cyan-500 focus:shadow-[0_0_15px_rgba(34,211,238,0.1)] transition resize-none"
                                    placeholder="Tell us what you loved or how we can improve the Exora experience..." required>{{ old('message') }}</textarea>
                                <p class="text-xs text-gray-600 mt-1">Minimum 10 characters</p>
                                @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Checkboxes -->
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="recommend" value="1" class="w-4 h-4 rounded border-gray-600 bg-black/50 text-cyan-500 focus:ring-cyan-500">
                                    <span class="text-sm text-gray-400 group-hover:text-gray-200 transition">I would recommend Exora to others</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="subscribe" value="1" class="w-4 h-4 rounded border-gray-600 bg-black/50 text-cyan-500 focus:ring-cyan-500">
                                    <span class="text-sm text-gray-400 group-hover:text-gray-200 transition">Notify me about future exhibitions</span>
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-cyan-600 to-purple-600 hover:from-cyan-500 hover:to-purple-500 text-white font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-[0_0_30px_rgba(34,211,238,0.2)] hover:shadow-[0_0_40px_rgba(34,211,238,0.4)]">
                                ✨ Submit Feedback
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: Stats & Info -->
                <div class="space-y-6">
                    <!-- Average Rating -->
                    <div class="bg-gray-900/60 rounded-2xl border border-white/5 p-6 text-center">
                        <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Community Rating</p>
                        <div class="text-6xl font-black text-white mb-2">4.8</div>
                        <div class="flex justify-center gap-1 text-yellow-400 text-xl mb-3">★★★★★</div>
                        <p class="text-xs text-gray-500">Based on 1,240 reviews</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-gray-900/60 rounded-2xl border border-white/5 p-6 space-y-4">
                        <p class="text-xs font-black text-gray-500 uppercase tracking-widest">Quick Stats</p>
                        @foreach([['Hall', '96%', 'cyan'], ['Auditorium', '94%', 'purple'], ['Marketplace', '91%', 'pink']] as [$label, $pct, $color])
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-gray-400">{{ $label }}</span>
                                <span class="text-{{ $color }}-400">{{ $pct }}</span>
                            </div>
                            <div class="h-1.5 bg-black/50 rounded-full overflow-hidden">
                                <div class="h-full bg-{{ $color }}-500 rounded-full" style="width: {{ $pct }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tips -->
                    <div class="bg-gray-900/60 rounded-2xl border border-white/5 p-6">
                        <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-4">💡 Helpful Tips</p>
                        <ul class="space-y-3 text-xs text-gray-400 leading-relaxed">
                            <li class="flex gap-2"><span class="text-cyan-500">→</span> Be specific about which features you liked or disliked.</li>
                            <li class="flex gap-2"><span class="text-cyan-500">→</span> Mention any technical issues you faced.</li>
                            <li class="flex gap-2"><span class="text-cyan-500">→</span> Suggestions for new features are always welcome!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = ['', 'Poor', 'Fair', 'Good', 'Great', 'Excellent!'];
        function setRating(val) {
            document.getElementById('rating-input').value = val;
            document.getElementById('rating-label').textContent = labels[val] + ' (' + val + '/5)';
            document.getElementById('rating-label').className = 'text-xs text-yellow-400 mt-2 font-black';
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star-' + i);
                star.className = i <= val
                    ? 'text-4xl transition-all duration-200 hover:scale-125 text-yellow-400 focus:outline-none scale-110'
                    : 'text-4xl transition-all duration-200 hover:scale-125 text-gray-600 focus:outline-none';
            }
        }
    </script>
    <x-chatbot />
</x-app-layout>
