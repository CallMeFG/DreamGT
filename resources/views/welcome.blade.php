@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Menggunakan Barlow untuk kesan modern dan ramping */
        .font-esports {
            font-family: 'Barlow', sans-serif;
        }
    </style>
    <div class="bg-[#050505] w-full max-w-[100vw] overflow-x-hidden font-sans antialiased selection:bg-ewc-gold selection:text-black text-white">

        <div class="relative h-[90vh] w-full bg-[#050505] overflow-hidden flex items-center justify-center border-b border-white/10">
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-80 grayscale">
                <source src="{{ asset('videos/hero-intro.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-t from-[#05050586] via-black/50 to-black/80"></div>

            <div class="relative z-10 text-center px-6 max-w-7xl mx-auto mt-12">
                <div
                    class="inline-flex items-center gap-3 py-2 px-6 border border-ewc-gold/30 bg-black/80 backdrop-blur-md mb-8 rounded-sm">
                    <span class="w-1.5 h-1.5 bg-red-600 animate-pulse rounded-full"></span>
                    <span class="text-ewc-gold text-xs font-bold tracking-[0.2em] uppercase font-esports">Tournament / Play
                        Games</span>
                </div>

                <h1
                    class="text-7xl md:text-9xl font-extrabold text-white uppercase font-esports tracking-tight leading-none mb-8 drop-shadow-2xl">
                    Level <br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-b from-ewc-gold to-yellow-600">Unlimited</span>
                </h1>

                <p class="text-gray-300 text-lg md:text-xl font-medium tracking-wide max-w-2xl mx-auto mb-10 font-esports">
                    Level up your journey.
                    <span class="text-white border-b border-ewc-gold/50">Unlimited opportunities,</span>
                    unmatched competitions.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-5">
                    <a href="{{ route('register') }}"
                        class="px-10 py-4 bg-ewc-gold text-black font-bold uppercase tracking-widest text-sm hover:bg-white transition-all shadow-lg font-esports rounded-sm">
                        Start Your Legacy
                    </a>
                    <a href="{{ route('public.arenas') }}"
                        class="px-10 py-4 border border-white/30 text-white font-bold uppercase tracking-widest text-sm hover:bg-white/10 backdrop-blur-sm transition-all font-esports flex items-center gap-2 justify-center rounded-sm">
                        View Facilities
                    </a>
                </div>
            </div>
        </div>

        <div class="relative w-full h-20 bg-ewc-gold border-y-4 border-black overflow-hidden z-20 shadow-2xl">
            <div
                class="absolute top-1/2 left-0 transform -translate-y-1/2 whitespace-nowrap animate-marquee flex gap-16 items-center">
                @for($i = 0; $i < 20; $i++)
                    <div class="flex items-center gap-6 opacity-90">
                        <span class="text-black font-extrabold uppercase text-3xl tracking-tight font-esports">DreamGT</span>
                        <span
                            class="text-black font-bold uppercase text-lg border border-black px-3 py-0.5 font-esports rounded-sm">Well
                            Played</span>
                        <span class="text-black text-3xl">•</span>
                    </div>
                @endfor
            </div>
        </div>

        <div class="bg-white py-24 px-6 md:px-12 relative border-t border-gray-200">
            <div class="max-w-7xl mx-auto w-full">

                <div class="flex flex-col md:flex-row justify-between items-end mb-12 pb-6 border-b border-gray-200">
                    <div>
                        <h4 class="text-ewc-gold font-bold uppercase tracking-[0.2em] text-sm mb-2">Our Arsenal</h4>
                        <h2 class="text-5xl font-black text-ewc-black uppercase tracking-tighter">Elite Specs</h2>
                    </div>
                    <a href="{{ route('public.arenas') }}"
                        class="group text-gray-500 text-sm hover:text-ewc-black flex items-center gap-2 transition-colors mt-4 md:mt-0 font-bold uppercase tracking-widest">
                        Full Inventory <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto">

                    <div
                        class="md:col-span-2 relative h-[450px] group rounded-2xl overflow-hidden bg-ewc-black border border-gray-200 shadow-xl cursor-pointer hover:shadow-2xl transition-all duration-300">
                        <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?q=80&w=1000"
                            class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-105 transition-all duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

                        <div
                            class="absolute inset-0 border-2 border-transparent group-hover:border-ewc-gold/50 rounded-2xl transition-colors duration-500">
                        </div>

                        <div class="absolute bottom-0 left-0 p-10 w-full">
                            <span
                                class="bg-ewc-gold text-black text-xs font-bold px-3 py-1 rounded uppercase mb-3 inline-block shadow-lg">Flagship
                                Rig</span>
                            <h3 class="text-4xl font-black text-white uppercase italic mb-2">ROG Strix Station</h3>
                            <p
                                class="text-gray-300 text-sm mb-4 max-w-md transform translate-y-2 group-hover:translate-y-0 opacity-80 group-hover:opacity-100 transition-all duration-500">
                                Powered by Intel Core i9-13900K and RTX 4090 for flawless gameplay and uncompromised frame rates.
                            </p>
                            <div class="flex gap-3">
                                <span
                                    class="px-3 py-1 border border-white/20 rounded text-xs font-mono text-ewc-gold bg-black/50 backdrop-blur-sm">RTX
                                    4090</span>
                                <span
                                    class="px-3 py-1 border border-white/20 rounded text-xs font-mono text-ewc-gold bg-black/50 backdrop-blur-sm">64GB
                                    DDR5</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="md:col-span-1 relative h-[450px] group rounded-2xl overflow-hidden bg-gray-50 border border-gray-200 shadow-lg cursor-pointer hover:border-ewc-gold transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-white group-hover:bg-gray-50 transition-colors duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-8 z-10">
                            <div
                                class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-8 group-hover:bg-ewc-gold group-hover:scale-110 transition-all duration-500 shadow-sm">
                                <svg class="w-12 h-12 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-7xl font-black text-ewc-black mb-2 tracking-tighter">360<span
                                    class="text-3xl text-ewc-gold">Hz</span></h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-sm">ZOWIE XL2566K</p>
                            <p class="text-xs text-gray-400 mt-6 px-4 border-t border-gray-200 pt-4">"The smoothest visual
                                experience for FPS"</p>
                        </div>
                    </div>

                    <div
                        class="md:col-span-1 relative h-[300px] group rounded-2xl overflow-hidden bg-ewc-black border border-gray-200 shadow-lg cursor-pointer hover:shadow-xl transition-all">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80"
                            class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-80 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-transparent transition-colors"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                            <h3
                                class="text-2xl font-black text-white uppercase border-2 border-white px-4 py-2 tracking-widest backdrop-blur-sm group-hover:bg-white group-hover:text-black transition-all">
                                5v5 Stage</h3>
                        </div>
                    </div>

                    <div
                        class="md:col-span-2 relative h-[300px] group rounded-2xl overflow-hidden bg-[#0a0a0a] border border-gray-200 p-10 flex items-center justify-between cursor-pointer hover:border-ewc-gold/50 transition-colors shadow-lg">
                        <div>
                            <h4 class="text-6xl font-black text-white mb-2 group-hover:text-ewc-gold transition-colors">1ms
                            </h4>
                            <p class="text-gray-400 text-sm uppercase tracking-widest">Low Latency <br>Connection</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl mb-2">⚡</div>
                            <p class="text-white font-bold text-lg">10Gbps Dedicated Fiber</p>
                            <p class="text-gray-500 text-xs">Direct routing to SG/JKT Servers</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-[#0a0a0a] py-24 px-6 border-y border-white/5 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-ewc-gold/5 rounded-full blur-[100px] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto w-full relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter">Choose Your Pass</h2>
                    <p class="text-gray-500 mt-4">Flexible pricing for casuals and pros.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-[#111] border border-white/10 rounded-2xl p-8 hover:border-white/30 transition-all hover:-translate-y-2">
                        <h3 class="text-xl font-bold text-gray-400 uppercase tracking-widest mb-4">Guest</h3>
                        <div class="text-4xl font-black text-white mb-6">Rp 15k <span
                                class="text-sm font-normal text-gray-500">/ hour</span></div>
                        <ul class="space-y-4 text-sm text-gray-300 mb-8">
                            <li class="flex items-center gap-2"><span class="text-white">✓</span> Standard PC Area</li>
                            <li class="flex items-center gap-2"><span class="text-white">✓</span> Guest Account</li>
                            <li class="flex items-center gap-2 text-gray-600">✕ No Save Data</li>
                        </ul>
                        <a href="{{ route('public.arenas') }}"
                            class="block w-full py-3 border border-white/20 text-center text-white font-bold rounded-sm hover:bg-white hover:text-black transition-colors">Book
                            Now</a>
                    </div>

                    <div
                        class="bg-[#111] border-2 border-ewc-gold rounded-2xl p-8 relative transform md:-translate-y-4 shadow-[0_0_30px_rgba(251,191,36,0.1)]">
                        <div
                            class="absolute top-0 right-0 bg-ewc-gold text-black text-xs font-bold px-3 py-1 rounded-bl-lg uppercase">
                            Best Value</div>
                        <h3 class="text-xl font-bold text-ewc-gold uppercase tracking-widest mb-4">Member</h3>
                        <div class="text-4xl font-black text-white mb-6">Rp 10k <span
                                class="text-sm font-normal text-gray-500">/ hour</span></div>
                        <ul class="space-y-4 text-sm text-gray-300 mb-8">
                            <li class="flex items-center gap-2"><span class="text-ewc-gold">✓</span> Access VIP Area</li>
                            <li class="flex items-center gap-2"><span class="text-ewc-gold">✓</span> Save Game Data</li>
                            <li class="flex items-center gap-2"><span class="text-ewc-gold">✓</span> Tournament Priority
                            </li>
                        </ul>
                        <a href="{{ route('register') }}"
                            class="block w-full py-3 bg-ewc-gold text-center text-black font-bold rounded-sm hover:bg-white transition-colors shadow-lg">Become
                            Member</a>
                    </div>

                    <div
                        class="bg-[#111] border border-white/10 rounded-2xl p-8 hover:border-white/30 transition-all hover:-translate-y-2">
                        <h3 class="text-xl font-bold text-gray-400 uppercase tracking-widest mb-4">Team Room</h3>
                        <div class="text-4xl font-black text-white mb-6">Rp 100k <span
                                class="text-sm font-normal text-gray-500">/ hour</span></div>
                        <ul class="space-y-4 text-sm text-gray-300 mb-8">
                            <li class="flex items-center gap-2"><span class="text-white">✓</span> Private 5 PC Room</li>
                            <li class="flex items-center gap-2"><span class="text-white">✓</span> Whiteboard & Strategy TV
                            </li>
                            <li class="flex items-center gap-2"><span class="text-white">✓</span> Free Drinks</li>
                        </ul>
                        <a href="{{ route('public.arenas') }}"
                            class="block w-full py-3 border border-white/20 text-center text-white font-bold rounded-sm hover:bg-white hover:text-black transition-colors">Book
                            Room</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white py-24 px-6 text-black">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-end mb-12">
                    <h2 class="text-4xl font-black uppercase tracking-tighter">Upcoming Battles</h2>
                    <a href="{{ route('public.competitions') }}"
                        class="text-sm font-bold text-ewc-black hover:text-ewc-gold transition-colors underline">View Full
                        Calendar</a>
                </div>

                <div class="space-y-4">
                    <div
                        class="group flex flex-col md:flex-row items-center justify-between border-b border-gray-200 py-6 hover:bg-gray-50 transition-colors px-4">
                        <div class="flex items-center gap-6 mb-4 md:mb-0 w-full md:w-auto">
                            <div class="text-center">
                                <span
                                    class="block text-3xl font-black text-gray-300 group-hover:text-ewc-gold transition-colors">24</span>
                                <span class="text-xs font-bold uppercase text-gray-500">Dec</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-black uppercase">Valorant Community Cup</h4>
                                <p class="text-sm text-gray-500">5v5 • Slot Available</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8 w-full md:w-auto justify-between md:justify-end">
                            <div class="text-right">
                                <span class="block font-bold">Rp 5.000.000</span>
                                <span class="text-xs text-gray-500">Prize Pool</span>
                            </div>
                            <a href="#"
                                class="px-6 py-2 bg-black text-white text-xs font-bold uppercase rounded-sm group-hover:bg-ewc-gold group-hover:text-black transition-all">Register</a>
                        </div>
                    </div>

                    <div
                        class="group flex flex-col md:flex-row items-center justify-between border-b border-gray-200 py-6 hover:bg-gray-50 transition-colors px-4">
                        <div class="flex items-center gap-6 mb-4 md:mb-0 w-full md:w-auto">
                            <div class="text-center">
                                <span
                                    class="block text-3xl font-black text-gray-300 group-hover:text-ewc-gold transition-colors">30</span>
                                <span class="text-xs font-bold uppercase text-gray-500">Dec</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-black uppercase">Mobile Legends Bang Bang</h4>
                                <p class="text-sm text-gray-500">Team • Registration Closed</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-8 w-full md:w-auto justify-between md:justify-end">
                            <div class="text-right">
                                <span class="block font-bold">Rp 3.000.000</span>
                                <span class="text-xs text-gray-500">Prize Pool</span>
                            </div>
                            <span
                                class="px-6 py-2 border border-gray-300 text-gray-400 text-xs font-bold uppercase rounded-sm cursor-not-allowed">Full</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-32 bg-[#050505] text-center px-6 relative overflow-hidden w-full border-t border-white/10">
            <div
                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10">
            </div>

            <div class="relative z-10 max-w-4xl mx-auto">
                <h4 class="text-gray-500 font-bold uppercase tracking-[0.3em] text-xs mb-6 font-esports">Join The League
                </h4>

                <h2
                    class="text-6xl md:text-8xl font-extrabold text-white uppercase font-esports tracking-tight mb-10 leading-none">
                    Ready To <br> <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-white">Dominate?</span>
                </h2>

                <div class="flex justify-center mb-10">
                    <a href="{{ route('register') }}"
                        class="px-12 py-5 bg-transparent border-2 border-ewc-gold text-ewc-gold font-bold uppercase tracking-widest text-lg hover:bg-ewc-gold hover:text-black transition-all duration-300 font-esports rounded-sm">
                        Create Free Account
                    </a>
                </div>

                <p class="text-gray-600 text-xs font-mono uppercase tracking-widest">
                    2 Hours Free Trial Included • No Credit Card Required
                </p>
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