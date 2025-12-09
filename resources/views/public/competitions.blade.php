@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-[#050505] font-['Barlow'] text-white selection:bg-ewc-gold selection:text-black">

        <div class="relative py-20 px-6 border-b border-white/10 overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-ewc-gold/10 to-transparent opacity-30"></div>

            <div class="relative z-10 max-w-7xl mx-auto text-center">
                <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-xs mb-4">Official Tournaments</h4>
                <h1 class="text-5xl md:text-7xl font-extrabold uppercase tracking-tight">
                    Compete & <span class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-white">Conquer</span>
                </h1>
                <p class="text-gray-400 mt-6 max-w-2xl mx-auto text-lg">
                    Compete in the official Game Central tournament. Huge cash prizes are up for grabs for rising champions.
                </p>
            </div>
        </div>

        <div class="py-20 px-6">
            <div class="max-w-6xl mx-auto">

                @if($events->isEmpty())
                    <div class="text-center py-20 border border-dashed border-gray-800 rounded-xl">
                        <p class="text-gray-500 text-xl font-bold uppercase">No Active Tournaments</p>
                        <p class="text-sm text-gray-600 mt-2">Check back later for updates.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($events as $event)
                            <div class="group relative bg-[#111] border border-white/10 rounded-sm overflow-hidden hover:border-ewc-gold transition-colors duration-300">

                                <div class="absolute top-4 right-4 z-10">
                                    @if($event->status == 'ongoing')
                                        <span class="flex items-center gap-2 bg-red-600 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm animate-pulse">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Live
                                        </span>
                                    @elseif($event->status == 'upcoming')
                                        <span class="bg-ewc-gold text-black text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm">
                                            Open Reg
                                        </span>
                                    @else
                                        <span class="bg-gray-700 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm">
                                            Ended
                                        </span>
                                    @endif
                                </div>

                                <div class="p-8">
                                    <div class="flex items-center gap-4 text-gray-500 text-sm font-mono mb-4 border-b border-gray-800 pb-4">
                                        <div class="flex flex-col items-center leading-none">
                                            <span class="text-2xl font-bold text-white">{{ $event->start_date->format('d') }}</span>
                                            <span class="text-[10px] uppercase">{{ $event->start_date->format('M') }}</span>
                                        </div>
                                        <span class="text-gray-700">|</span>
                                        <span>Until {{ $event->end_date->format('d M Y') }}</span>
                                    </div>

                                    <h3 class="text-3xl font-extrabold text-white uppercase italic mb-3 leading-none group-hover:text-ewc-gold transition-colors">
                                        {{ $event->title }}
                                    </h3>

                                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                        {{ $event->description }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] text-gray-500 uppercase tracking-widest">Prize Pool</span>
                                            <span class="text-xl font-bold text-white">Rp 5.000.000</span> </div>

                                        @if($event->status != 'completed')
                                            <a href="#" class="px-6 py-2 bg-white text-black font-bold uppercase text-xs tracking-widest hover:bg-ewc-gold transition-colors">
                                                Register Team
                                            </a>
                                        @else
                                            <button disabled class="px-6 py-2 bg-gray-800 text-gray-500 font-bold uppercase text-xs tracking-widest cursor-not-allowed">
                                                Completed
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

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