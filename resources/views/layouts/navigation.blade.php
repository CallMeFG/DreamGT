<nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }"
    class="bg-ewc-black/80 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <svg class="h-8 w-8 text-ewc-gold group-hover:text-white transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    <span class="font-bold text-xl tracking-tighter text-white">
                        GAME<span class="text-ewc-gold">CENTRAL</span>
                    </span>
                </a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="{{ url('/') }}"
                        class="text-white hover:text-ewc-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                    <a href="#"
                        class="text-gray-300 hover:text-ewc-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">Competitions</a>
                    <a href="#"
                        class="text-gray-300 hover:text-ewc-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">Arenas</a>
                    <a href="#"
                        class="text-gray-300 hover:text-ewc-gold px-3 py-2 rounded-md text-sm font-medium transition-colors">Schedule</a>
                </div>
            </div>

            <div class="hidden md:block">
                @auth
                    <div class="ml-4 flex items-center md:ml-6 relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false"
                            type="button"
                            class="bg-ewc-gray p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ewc-gray focus:ring-white flex items-center gap-2 pr-3">
                            <span class="sr-only">Open user menu</span>
                            <div
                                class="h-8 w-8 rounded-full bg-ewc-gold flex items-center justify-center text-ewc-black font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-300">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 top-full mt-2 w-48 rounded-md shadow-lg py-1 bg-ewc-gray ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">

                            <div class="px-4 py-2 border-b border-white/10">
                                <p class="text-xs text-gray-400">Signed in as</p>
                                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ url('/dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-ewc-gold">Dashboard</a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-ewc-gold">Settings</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-white/5 hover:text-red-300">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-gray-300 hover:text-white transition">Log in</a>
                        <a href="{{ route('register') }}"
                            class="bg-ewc-gold text-ewc-black px-4 py-2 rounded-sm text-sm font-bold hover:bg-yellow-400 transition shadow-[0_0_15px_rgba(251,191,36,0.3)] hover:shadow-[0_0_25px_rgba(251,191,36,0.6)]">
                            JOIN NOW
                        </a>
                    </div>
                @endauth
            </div>

            <div class="-mr-2 flex md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="bg-ewc-gray inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-transition class="md:hidden border-b border-white/10 bg-ewc-black">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}"
                class="text-white bg-white/5 block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="#"
                class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:text-ewc-gold hover:bg-white/5">Competitions</a>
            <a href="#"
                class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:text-ewc-gold hover:bg-white/5">Arenas</a>
            <a href="#"
                class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:text-ewc-gold hover:bg-white/5">Schedule</a>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-700">
            @auth
                <div class="flex items-center px-5 mb-3">
                    <div class="flex-shrink-0">
                        <div
                            class="h-10 w-10 rounded-full bg-ewc-gold flex items-center justify-center text-ewc-black font-bold text-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium leading-none text-gray-400 mt-1">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <a href="{{ url('/dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Dashboard</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/5">Settings</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-400 hover:text-red-300 hover:bg-white/5">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="px-2 space-y-3">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-4 py-3 border border-gray-600 rounded-sm text-base font-medium text-gray-300 hover:text-white hover:border-gray-400">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-4 py-3 border border-transparent rounded-sm shadow-sm text-base font-bold text-ewc-black bg-ewc-gold hover:bg-yellow-400">
                        JOIN NOW
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>