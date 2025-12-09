@extends('layouts.app')

@section('content')
    <style>
        /* Container Pagination */
        nav[role="navigation"] {
            background: transparent !important;
            border: none !important;
        }

        /* Info text (Showing 1 to 10 of...) */
        nav[role="navigation"] p {
            color: #9ca3af !important;
            /* Text Gray */
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* Tombol Pagination (Kotak-kotak angka) */
        nav[role="navigation"] span,
        nav[role="navigation"] a {
            background-color: #111 !important;
            /* BG Hitam */
            border-color: #333 !important;
            /* Border Abu Gelap */
            color: #fff !important;
            /* Teks Putih */
            font-weight: bold;
        }

        /* Tombol Aktif */
        nav[role="navigation"] span[aria-current="page"]>span {
            background-color: #fbbf24 !important;
            /* EWC Gold */
            color: #000 !important;
            /* Teks Hitam */
            border-color: #fbbf24 !important;
        }

        /* Hover State */
        nav[role="navigation"] a:hover {
            background-color: #333 !important;
            color: #fbbf24 !important;
        }

        /* Tombol Previous/Next yang disabled */
        nav[role="navigation"] span[aria-disabled="true"]>span {
            color: #555 !important;
            cursor: not-allowed;
        }
    </style>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <div class="min-h-screen bg-[#050505] font-['Barlow'] text-white selection:bg-ewc-gold selection:text-black" x-data="{ tab: 'pcs' }">

            <div class="relative py-24 px-6 border-b border-white/10 overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-ewc-gold/10 blur-[150px] rounded-full pointer-events-none"></div>

                <div class="relative z-10 max-w-7xl mx-auto text-center">
                    <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-xs mb-4">Choose Your Weapon</h4>
                    <h1 class="text-5xl md:text-7xl font-extrabold uppercase tracking-tight mb-8">
                        Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-white">Inventory</span>
                    </h1>

                    <div class="inline-flex p-1 bg-white/5 rounded-full backdrop-blur-sm border border-white/10">
                        <button @click="tab = 'pcs'" 
                                :class="tab === 'pcs' ? 'bg-ewc-gold text-black shadow-lg' : 'text-gray-400 hover:text-white'"
                                class="px-8 py-3 rounded-full text-sm font-bold uppercase tracking-widest transition-all duration-300">
                            PC Rigs
                        </button>
                        <button @click="tab = 'arenas'" 
                                :class="tab === 'arenas' ? 'bg-ewc-gold text-black shadow-lg' : 'text-gray-400 hover:text-white'"
                                class="px-8 py-3 rounded-full text-sm font-bold uppercase tracking-widest transition-all duration-300">
                            VIP Arenas
                        </button>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-6 py-20">

                <div x-show="tab === 'pcs'" x-transition.opacity.duration.500ms>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach($pcs as $pc)
                            <div
                                class="group bg-[#111] border border-white/10 rounded-xl overflow-hidden hover:border-ewc-gold transition-all duration-300 hover:-translate-y-2">
                                <div
                                    class="h-48 bg-gray-900 relative overflow-hidden flex items-center justify-center group-hover:bg-gray-800 transition-colors">
                                    <svg class="w-24 h-24 text-gray-800 group-hover:text-white/10 transition-colors duration-500"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v12H4z" />
                                        <path d="M8 20h8v2H8z" />
                                    </svg>

                                    <div class="absolute top-4 right-4">
                                        @if($pc->status == 'available')
                                            <span
                                                class="bg-green-500/20 text-green-400 border border-green-500/30 text-[10px] font-bold px-3 py-1 rounded uppercase tracking-wider">Ready</span>
                                        @elseif($pc->status == 'booked')
                                            <span
                                                class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 text-[10px] font-bold px-3 py-1 rounded uppercase tracking-wider">In
                                                Use</span>
                                        @else
                                            <span
                                                class="bg-red-500/20 text-red-400 border border-red-500/30 text-[10px] font-bold px-3 py-1 rounded uppercase tracking-wider">Maintenance</span>
                                        @endif
                                    </div>

                                    <div class="absolute bottom-4 left-4">
                                        <h3
                                            class="text-3xl font-black text-white/20 group-hover:text-ewc-gold transition-colors select-none">
                                            {{ $pc->pc_number }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-white uppercase">{{ $pc->type->name ?? 'Standard Rig' }}</h3>
                                            <p class="text-gray-500 text-xs mt-1 truncate w-48">
                                                {{ $pc->specifications ?? 'High Performance Gaming Setup' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-xl font-bold text-ewc-gold">Rp
                                                {{ number_format($pc->type->price_per_hour ?? 0, 0, ',', '.') }}</span>
                                            <span class="text-[10px] text-gray-500 uppercase">/ Hour</span>
                                        </div>
                                    </div>

                                    <div class="flex gap-3 mb-6 border-t border-white/5 pt-4">
                                        <div class="flex items-center gap-1 text-gray-400 text-[10px] uppercase font-bold">
                                            <span class="w-2 h-2 bg-ewc-gold rounded-full"></span> RTX 4060
                                        </div>
                                        <div class="flex items-center gap-1 text-gray-400 text-[10px] uppercase font-bold">
                                            <span class="w-2 h-2 bg-ewc-gold rounded-full"></span> 165Hz
                                        </div>
                                    </div>

                                    @if($pc->status == 'available')
                                        <a href="{{ Auth::check() ? route('booking.create', ['pc_id' => $pc->id]) : route('login') }}"
                                            class="relative z-20 block w-full py-3 bg-white text-black font-bold text-center uppercase text-xs tracking-widest hover:bg-ewc-gold transition-colors cursor-pointer">
                                            Book This Unit
                                        </a>
                                    @else
                                        <button disabled
                                            class="block w-full py-3 bg-white/5 text-gray-500 font-bold text-center uppercase text-xs tracking-widest cursor-not-allowed">
                                            Unavailable
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $pcs->links('pagination::tailwind') }}
                    </div>
                </div>

                <div x-show="tab === 'arenas'" x-transition.opacity.duration.500ms style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($arenas as $arena)
                            <div class="group relative h-[400px] rounded-2xl overflow-hidden border border-white/10 hover:border-ewc-gold transition-all duration-500">
                                @if($arena->image_path)
                                    <img src="{{ asset('storage/' . $arena->image_path) }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                                @else
                                    <div class="absolute inset-0 bg-gray-800 opacity-60"></div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

                                <div class="absolute bottom-0 left-0 p-8 w-full">
                                    <div class="flex justify-between items-end mb-4">
                                        <div>
                                            <span class="bg-ewc-gold text-black text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Private Room</span>
                                            <h3 class="text-3xl font-black text-white uppercase italic">{{ $arena->name }}</h3>
                                            <p class="text-gray-300 text-sm mt-1 max-w-sm">{{ $arena->facilities ?? 'Full AC, Soundproof, Whiteboard' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-2xl font-black text-ewc-gold">Rp {{ number_format($arena->price_per_hour, 0, ',', '.') }}</span>
                                            <span class="text-[10px] text-gray-400 uppercase">/ Hour</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between border-t border-white/20 pt-4">
                                        <div class="flex gap-4 text-xs font-mono text-white">
                                            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-ewc-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg> {{ $arena->capacity }} Pax</span>
                                        </div>

                                        @if($arena->status == 'available')
                                            <a href="{{ Auth::check() ? route('booking.create', ['arena_id' => $arena->id]) : route('login') }}"
                                                class="relative z-20 px-6 py-2 bg-ewc-gold text-black font-bold uppercase text-xs tracking-widest rounded-sm hover:bg-white transition-colors cursor-pointer">
                                                Book Room
                                            </a>
                                        @else
                                            <span
                                                class="px-6 py-2 bg-gray-800 text-gray-500 font-bold uppercase text-xs tracking-widest rounded-sm cursor-not-allowed">
                                                Booked
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
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