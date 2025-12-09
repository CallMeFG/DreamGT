<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Game Central') }}</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-ewc-black font-sans antialiased h-screen overflow-hidden flex"
    x-data="{ sidebarOpen: false }">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col md:ml-52 h-screen relative w-full transition-all duration-300">

        <div class="md:hidden bg-ewc-black border-b border-white/10 p-4 flex items-center justify-between z-50">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Dream GT" class="h-8 w-8 object-contain">
                <span class="text-lg font-black tracking-tighter text-white">
                    DREAM<span class="text-ewc-gold">GT</span>
                </span>
            </a>
        
            <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/80 z-30 md:hidden"></div>

        <main class="flex-1 overflow-y-auto overflow-x-hidden relative w-full">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>

    </div>

</body>

</html>