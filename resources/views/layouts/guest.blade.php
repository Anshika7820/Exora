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
                background-color: #050505;
                position: relative;
                overflow-x: hidden;
            }
            .aurora-bg {
                position: fixed;
                top: 0; left: 0; width: 100vw; height: 100vh;
                z-index: -1;
                background: 
                    radial-gradient(circle at 15% 50%, rgba(34, 211, 238, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.15) 0%, transparent 50%);
                animation: aurora-shift 15s ease-in-out infinite alternate;
            }
            @keyframes aurora-shift {
                0% { transform: scale(1) translate(0, 0); }
                100% { transform: scale(1.1) translate(-2%, 2%); }
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white bg-auth">
        <div class="aurora-bg"></div>
        <div class="min-h-screen w-full flex animate-fade-in-up">
            {{ $slot }}

            
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-gray-600 text-[10px] uppercase tracking-[0.3em] font-black">
                Secure Entry Portal
            </div>
        </div>
    </body>
</html>
