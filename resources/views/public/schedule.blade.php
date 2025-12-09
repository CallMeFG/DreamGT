@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div
        class="min-h-screen bg-white font-['Barlow'] text-black selection:bg-ewc-gold selection:text-black w-full max-w-[100vw] overflow-x-hidden">

        <div class="pt-16 pb-8 px-6 border-b border-black">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6">
                    <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-[10px] mb-2">Event Calendar</h4>
                    <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none">
                        Weekly <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-black">Schedule</span>
                    </h1>
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
                    <p class="text-gray-500 font-medium text-sm md:text-base max-w-lg leading-relaxed">
                        This week's tournament & community schedule. <br>
                        <span class="text-black font-bold">Arena open Tue–Sun.</span>
                    </p>

                    <div class="flex flex-wrap gap-2 w-full lg:w-auto">
                        <button
                            class="px-5 py-2 bg-black text-white text-[10px] font-bold uppercase rounded-full hover:bg-ewc-gold hover:text-black transition-colors whitespace-nowrap">
                            Show All
                        </button>
                        <button
                            class="px-5 py-2 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase rounded-full hover:bg-gray-200 transition-colors whitespace-nowrap">
                            Esports
                        </button>
                        <button
                            class="px-5 py-2 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase rounded-full hover:bg-gray-200 transition-colors whitespace-nowrap">
                            Community
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full overflow-x-auto pb-12 bg-gray-50">
            <div class="flex min-w-max divide-x divide-gray-200 border-b border-gray-200 pr-20">

                @foreach($weekSchedule as $day)
                    <div
                        class="w-[280px] md:w-[320px] min-h-[450px] p-5 flex flex-col {{ $day['is_today'] ? 'bg-yellow-50' : 'bg-white' }}">

                        <div class="mb-6 flex justify-between items-start">
                            <div>
                                <span class="block text-3xl font-black {{ $day['is_today'] ? 'text-ewc-gold' : 'text-black' }}">
                                    {{ $day['date_obj']->format('d') }}
                                </span>
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase">
                                    {{ $day['day_name'] }}
                                </span>
                            </div>
                            @if($day['is_today'])
                                <span
                                    class="px-2 py-0.5 bg-red-600 text-white text-[9px] font-bold uppercase rounded-sm animate-pulse">
                                    Today
                                </span>
                            @endif
                        </div>

                        <div class="space-y-3 flex-1">
                            @forelse($day['events'] as $event)
                                <div
                                    class="group relative bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md hover:border-ewc-gold transition-all cursor-pointer">
                                    <div class="flex justify-between items-start mb-2">
                                        <span
                                            class="text-[9px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1">
                                            <div class="w-1.5 h-1.5 rounded-full bg-ewc-gold"></div> Main Stage
                                        </span>
                                        @if($event->status == 'ongoing')
                                            <span
                                                class="text-[8px] font-black text-red-500 uppercase border border-red-200 px-1 rounded">Live</span>
                                        @endif
                                    </div>

                                    <h3
                                        class="text-sm font-black uppercase leading-tight group-hover:text-ewc-gold transition-colors mb-2">
                                        {{ Str::limit($event->title, 25) }}
                                    </h3>

                                    <div class="pt-2 border-t border-gray-50 flex justify-between items-center">
                                        <span class="text-[10px] font-bold text-black">{{ $event->start_date->format('H:i') }}
                                            WIB</span>
                                        <svg class="w-3 h-3 text-gray-300 group-hover:text-ewc-gold" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="h-24 border border-dashed border-gray-200 rounded-lg flex flex-col items-center justify-center text-center opacity-50">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">No Event</span>
                                </div>
                            @endforelse
                        </div>

                    </div>
                @endforeach

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