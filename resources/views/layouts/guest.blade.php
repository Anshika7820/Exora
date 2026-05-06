<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VirtualExpo') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .bg-auth {
                background: radial-gradient(circle at 0% 0%, rgba(34, 211, 238, 0.15) 0%, transparent 50%),
                            radial-gradient(circle at 100% 100%, rgba(168, 85, 247, 0.15) 0%, transparent 50%);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#050505] text-white bg-auth">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="text-3xl font-black tracking-tighter gradient-text">
                    VirtualExpo
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-gray-900/50 backdrop-blur-2xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-3xl">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-gray-600 text-xs uppercase tracking-widest font-bold">
                Secure Entry Portal
            </div>
        </div>
    </body>
</html>
