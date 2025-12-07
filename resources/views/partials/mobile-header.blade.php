<div class="md:hidden bg-ewc-black border-b border-white/10 p-4 flex items-center justify-between sticky top-0 z-50">
    <a href="{{ url('/') }}" class="flex items-center gap-2">
        <svg class="h-6 w-6 text-ewc-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
        </svg>
        <span class="font-bold text-lg text-white">GAME<span class="text-ewc-gold">CENTRAL</span></span>
    </a>

    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-300 hover:text-white">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>