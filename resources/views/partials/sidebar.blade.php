<aside
    class="fixed inset-y-0 left-0 z-40 w-52 bg-white border-r border-gray-200 transform transition-transform duration-300 md:translate-x-0 flex flex-col justify-between shadow-[4px_0_24px_rgba(0,0,0,0.02)]"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="h-16 flex items-center px-5 border-b border-gray-100 bg-white">
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <svg class="h-7 w-7 text-ewc-black group-hover:text-ewc-gold transition-colors" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
            <span
                class="font-black text-lg tracking-tighter text-ewc-black group-hover:tracking-normal transition-all duration-300">
                GAME<span class="text-ewc-gold">CENTRAL</span>
            </span>
        </a>
    </div>

    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto bg-white">

        <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Main Menu</p>

        <a href="{{ route('home') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-r-md transition-all {{ Request::routeIs('home') ? 'bg-white text-ewc-black shadow-md border-l-4 border-ewc-gold' : 'text-gray-500 hover:bg-gray-50 hover:text-ewc-black' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Home
        </a>

        <a href="{{ route('public.competitions') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-r-md transition-all {{ Request::routeIs('public.competitions') ? 'bg-white text-ewc-black shadow-md border-l-4 border-ewc-gold' : 'text-gray-500 hover:bg-gray-50 hover:text-ewc-black' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Competitions
        </a>

        <a href="{{ route('public.arenas') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-r-md transition-all {{ Request::routeIs('public.arenas') ? 'bg-white text-ewc-black shadow-md border-l-4 border-ewc-gold' : 'text-gray-500 hover:bg-gray-50 hover:text-ewc-black' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Arenas & PCs
        </a>

        <a href="{{ route('public.schedule') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-r-md transition-all {{ Request::routeIs('public.schedule') ? 'bg-white text-ewc-black shadow-md border-l-4 border-ewc-gold' : 'text-gray-500 hover:bg-gray-50 hover:text-ewc-black' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Schedule
        </a>

    @php
$role = Auth::user()->role ?? '';
    @endphp
    
    @if(in_array($role, ['admin', 'staff_pc', 'staff_arena']))
                <div class="mt-8 mb-2 border-t border-gray-100 pt-4">
                    <p class="px-3 text-[10px] font-bold text-red-500 uppercase tracking-widest mb-2">
                        {{ $role === 'admin' ? 'Admin Control' : 'Staff Workspace' }}
                    </p>
                </div>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.dashboard') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Dashboard
                </a>

                @if(in_array($role, ['admin', 'staff_pc']))
                    <a href="{{ route('admin.pcs.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.pcs.*') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Manage PCs
                    </a>
                @endif

                @if(in_array($role, ['admin', 'staff_arena']))
                    <a href="{{ route('admin.arenas.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.arenas.*') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Manage Arenas
                    </a>
                @endif

                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.bookings.*') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Transactions
                </a>
        <a href="{{ route('admin.calendar.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.calendar.index') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Calendar
        </a>
                @if($role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold rounded-r-md transition-all {{ Request::routeIs('admin.users.*') ? 'bg-red-50 text-red-700 border-l-4 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>
                @endif
    @endif
    </nav>

    <div class="p-4 border-t border-gray-100 bg-white">
        @auth
            <div class="flex items-center gap-3 p-2 rounded-md bg-gray-50 border border-gray-100">
                <div
                    class="h-9 w-9 rounded-full bg-ewc-black flex items-center justify-center text-ewc-gold font-bold text-sm shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0 group relative">
                    <div class="flex justify-between items-center">
                        <p class="text-xs font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>

                        <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-ewc-black transition-colors"
                            title="Settings">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>

                    <div class="flex items-center gap-2 mt-0.5">
                        @if(in_array(Auth::user()->role, ['admin', 'staff_pc', 'staff_arena']))
                            <a href="{{ route('admin.dashboard') }}" class="text-[10px] text-red-600 font-bold hover:underline">
                                {{ Auth::user()->role === 'admin' ? 'ADMIN PANEL' : 'STAFF AREA' }}
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-[10px] text-ewc-gold font-semibold hover:underline">
                                DASHBOARD
                            </a>
                        @endif

                        <span class="text-gray-300 text-[10px]">|</span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-[10px] text-gray-400 font-semibold hover:text-ewc-black transition-colors">LOGOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="space-y-3">
                <a href="{{ route('login') }}"
                    class="group flex items-center justify-center w-full px-4 py-2.5 border border-ewc-black rounded-sm text-sm font-bold text-ewc-black hover:bg-ewc-black hover:text-white transition-all shadow-sm">
                    LOG IN
                </a>
            </div>
        @endauth
    </div>
</aside>