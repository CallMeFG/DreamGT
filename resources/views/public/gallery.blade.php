@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-white font-['Barlow'] text-black selection:bg-ewc-gold selection:text-black"
        x-data="{ filter: 'all' }">

        <div class="relative py-24 px-6 border-b border-gray-200 overflow-hidden bg-gray-50">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5">
            </div>

            <div class="relative z-10 max-w-7xl mx-auto text-center">
                <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-xs mb-4">Visual Experience</h4>
                <h1 class="text-5xl md:text-8xl font-extrabold uppercase tracking-tight mb-6">
                    Legacy of <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-black">Champions</span>
                </h1>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">
                    Experience epic moments from our tournaments, community events, and world-class facilities.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button @click="filter = 'all'"
                    :class="filter === 'all' ? 'bg-ewc-black text-white ring-2 ring-ewc-black' : 'bg-white text-gray-500 border border-gray-200 hover:border-ewc-black hover:text-ewc-black'"
                    class="px-8 py-3 font-bold uppercase text-xs tracking-widest rounded-full transition-all duration-300 shadow-sm">
                    All Photos
                </button>
                <button @click="filter = 'tournament'"
                    :class="filter === 'tournament' ? 'bg-ewc-black text-white ring-2 ring-ewc-black' : 'bg-white text-gray-500 border border-gray-200 hover:border-ewc-black hover:text-ewc-black'"
                    class="px-8 py-3 font-bold uppercase text-xs tracking-widest rounded-full transition-all duration-300 shadow-sm">
                    Tournaments
                </button>
                <button @click="filter = 'venue'"
                    :class="filter === 'venue' ? 'bg-ewc-black text-white ring-2 ring-ewc-black' : 'bg-white text-gray-500 border border-gray-200 hover:border-ewc-black hover:text-ewc-black'"
                    class="px-8 py-3 font-bold uppercase text-xs tracking-widest rounded-full transition-all duration-300 shadow-sm">
                    Venue
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div x-show="filter === 'all' || filter === 'tournament'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="md:col-span-2 group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-ewc-gold text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Tournament</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">Grand Finals 2024</h3>
                    </div>
                </div>

                <div x-show="filter === 'all' || filter === 'venue'" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-white text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Venue</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">Neon Atmosphere</h3>
                    </div>
                </div>

                <div x-show="filter === 'all' || filter === 'tournament'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-ewc-gold text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Community</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">Valorant Cup</h3>
                    </div>
                </div>

                <div x-show="filter === 'all' || filter === 'venue'" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="md:col-span-2 group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-white text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Gear</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">RTX 4090 Setup</h3>
                    </div>
                </div>

                <div x-show="filter === 'all' || filter === 'tournament'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1560253023-3ec5d502959f?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-ewc-gold text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Winners</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">Team Secret Win</h3>
                    </div>
                </div>

                <div x-show="filter === 'all' || filter === 'venue'" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="md:col-span-2 group relative h-80 overflow-hidden rounded-xl bg-gray-100 cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1511882150382-421056c89033?q=80&w=1000"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <span
                            class="bg-white text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Lounge</span>
                        <h3 class="text-2xl font-black uppercase text-white leading-none">VIP Area Access</h3>
                    </div>
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