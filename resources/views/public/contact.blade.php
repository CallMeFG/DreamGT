@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-[#050505] font-['Barlow'] text-white selection:bg-ewc-gold selection:text-black">

        <div class="py-20 px-6 text-center border-b border-white/10 bg-[#0a0a0a]">
            <h4 class="text-ewc-gold font-bold uppercase tracking-[0.3em] text-xs mb-4">Get In Touch</h4>
            <h1 class="text-5xl md:text-7xl font-extrabold uppercase tracking-tight">
                Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-white">Support</span>
            </h1>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

                <div>
                    <h3 class="text-3xl font-black uppercase mb-8 border-l-4 border-ewc-gold pl-6">Headquarters</h3>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        For inquiries regarding tournaments, partnerships, or bookings, our team is available 24/7 to assist you.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-[#111] border border-white/10 rounded-sm">
                                <svg class="w-6 h-6 text-ewc-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold uppercase tracking-widest text-sm text-gray-500">Address</h5>
                                <p class="text-white text-lg font-medium">Jl. Umban Sari no 2, Dream GT Tower, Pekanbaru.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-[#111] border border-white/10 rounded-sm">
                                <svg class="w-6 h-6 text-ewc-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold uppercase tracking-widest text-sm text-gray-500">Email</h5>
                                <p class="text-white text-lg font-medium">callmestartofficial19@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-[#111] border border-white/10 rounded-sm">
                                <svg class="w-6 h-6 text-ewc-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold uppercase tracking-widest text-sm text-gray-500">Phone</h5>
                                <p class="text-white text-lg font-medium">+62 812-8800-7890</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white text-black p-8 md:p-10 rounded-xl shadow-2xl">
                    <h3 class="text-2xl font-black uppercase mb-6">Send Message</h3>

                    <form action="#" class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase mb-1">First Name</label>
                                <input type="text"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase mb-1">Last Name</label>
                                <input type="text"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase mb-1">Email Address</label>
                            <input type="email"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase mb-1">Subject</label>
                            <select
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all font-bold text-gray-600">
                                <option>General Inquiry</option>
                                <option>Partnership / Sponsorship</option>
                                <option>Technical Issue</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase mb-1">Message</label>
                            <textarea rows="4"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"></textarea>
                        </div>

                        <button
                            class="w-full py-4 bg-ewc-gold text-black font-black uppercase tracking-widest rounded-sm hover:bg-yellow-500 transition-all shadow-lg">
                            Submit Request
                        </button>
                    </form>
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