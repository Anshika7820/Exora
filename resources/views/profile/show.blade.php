<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Virtual Passport & Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-[0_0_50px_rgba(34,211,238,0.2)] sm:rounded-2xl border border-gray-700 relative">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>

                <div class="p-8 relative z-10">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <!-- Avatar / Icon -->
                        <div class="w-32 h-32 bg-gradient-to-br from-cyan-500 to-purple-600 rounded-full flex items-center justify-center text-5xl shadow-lg border-4 border-gray-800">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>

                        <!-- Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-3xl font-bold text-white mb-1">{{ auth()->user()->name }}</h3>
                            <p class="text-cyan-400 font-mono text-sm tracking-widest uppercase mb-4">{{ auth()->user()->role }} Account</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                                    <p class="text-xs text-gray-500 uppercase font-bold">Email Address</p>
                                    <p class="text-gray-200">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                                    <p class="text-xs text-gray-500 uppercase font-bold">Account Created</p>
                                    <p class="text-gray-200">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats / Score -->
                    <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="bg-gray-800/80 p-6 rounded-2xl border border-cyan-500/30 text-center">
                            <p class="text-gray-400 text-sm mb-1">Expo Score</p>
                            <p class="text-4xl font-black text-cyan-400">{{ auth()->user()->expo_score ?? 0 }}</p>
                            <p class="text-[10px] text-gray-500 mt-2 font-mono italic">ACTIVE PARTICIPANT</p>
                        </div>
                        
                        <div class="bg-gray-800/80 p-6 rounded-2xl border border-purple-500/30 text-center">
                            <p class="text-gray-400 text-sm mb-1">Status</p>
                            <p class="text-4xl font-black text-purple-400">Verified</p>
                            <p class="text-[10px] text-gray-500 mt-2 font-mono italic">LEVEL 1 EXPO MEMBER</p>
                        </div>

                        <div class="bg-gray-800/80 p-6 rounded-2xl border border-pink-500/30 text-center flex flex-col justify-center items-center">
                             <div class="text-2xl mb-1">🏆</div>
                             <p class="text-sm font-bold text-pink-400">Bronze Badge</p>
                             <p class="text-[10px] text-gray-500 mt-1 font-mono uppercase">Early Adopter</p>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="mt-8 flex justify-center md:justify-end">
                        <a href="{{ route('profile.edit') }}" class="px-6 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg transition font-bold shadow-lg shadow-cyan-500/20">
                            Edit Profile Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-chat-bot />
</x-app-layout>
