@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-[#050505] font-['Barlow'] text-white selection:bg-ewc-gold selection:text-black">

        <div class="relative py-32 px-6 border-b border-white/10">
            <div
                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20">
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
                <div>
                    <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-xs mb-6">Who We Are</h4>
                    <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none mb-8">
                        We Are <br> Dream <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-yellow-600">GT</span>
                    </h1>
                    <p class="text-gray-400 text-lg leading-relaxed max-w-lg">
                        Dream GT is a gaming and esports center focused on supporting competitive play and community
                        engagement. We offer a
                        professional environment for players to train, compete, and experience high-performance gaming.
                    </p>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-ewc-gold/20 blur-3xl rounded-full"></div>
                    <img src="{{ asset('images/logo.png') }}" class="relative z-10 w-64 md:w-96 mx-auto drop-shadow-2xl">
                </div>
            </div>
        </div>

        <div class="bg-white text-black py-20 border-y-8 border-ewc-gold">
            <div
                class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <div class="p-6">
                    <h3 class="text-6xl font-black tracking-tighter mb-2">2.5k+</h3>
                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Active Players</p>
                </div>
                <div class="p-6">
                    <h3 class="text-6xl font-black tracking-tighter mb-2">Rp 50M+</h3>
                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Prize Pool Awarded</p>
                </div>
                <div class="p-6">
                    <h3 class="text-6xl font-black tracking-tighter mb-2">30+</h3>
                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Tournaments Hosted</p>
                </div>
            </div>
        </div>

        <div class="py-24 px-6 max-w-7xl mx-auto">
            <div class="bg-[#111] border border-white/10 rounded-2xl p-12 md:p-20 relative overflow-hidden text-center">
                <div
                    class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1 bg-gradient-to-r from-transparent via-ewc-gold to-transparent">
                </div>

                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tight mb-8">Our Mission</h2>
                <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-4xl mx-auto">
                    "To create the ultimate ecosystem where gamers of all levels can compete, connect, and celebrate the
                    culture of esports with professional-grade facilities."
                </p>

                <div class="mt-12">
                    <img src="{{ asset('images/logo.png') }}"
                        class="h-12 w-auto mx-auto opacity-50 grayscale hover:grayscale-0 transition-all">
                </div>
            </div>
        </div>

        <div class="bg-[#0a0a0a] text-white py-16 px-6 border-t-4 border-ewc-gold">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    <h3 class="text-xl font-black uppercase mb-6 flex items-center gap-2">
                        <span class="text-ewc-gold">///</span> Operational Hours
                    </h3>
                    <div class="space-y-4 text-sm font-mono text-gray-400">
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span>Mon - Fri</span> <span class="text-white font-bold">24 Hours</span>
                        </div>
                        <div class="flex justify-between border-b border-white/10 pb-2">
                            <span>Sat - Sun</span> <span class="text-white font-bold">24 Hours (Tournament)</span>
                        </div>
                        <div class="flex justify-between text-red-500 pt-1">
                            <span>Server Maintenance</span> <span>Tue 03:00 - 05:00</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-black uppercase mb-6 flex items-center gap-2">
                        <span class="text-ewc-gold">///</span> Basecamp
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Jl. Umban Sari no 2.<br>
                        Dream GT Tower, Pekanbaru.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="px-6 py-3 bg-white text-black font-bold uppercase text-[10px] tracking-widest hover:bg-ewc-gold transition-colors">
                            Google Maps
                        </a>
                        <a href="#"
                            class="px-6 py-3 border border-white text-white font-bold uppercase text-[10px] tracking-widest hover:bg-white/10 transition-colors">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection