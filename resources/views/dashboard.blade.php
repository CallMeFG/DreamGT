@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-6">
        <div class="max-w-7xl mx-auto space-y-8">

            <div class="flex flex-col md:flex-row justify-between items-end gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-4xl font-black text-ewc-black uppercase tracking-tighter">
                        Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-ewc-gold to-yellow-600">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-sm text-gray-500 mt-2 font-medium">Ready to dominate the arena today?</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-5 py-2.5 border border-gray-300 bg-white text-gray-700 font-bold uppercase text-xs rounded-sm hover:border-ewc-black hover:text-ewc-black transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </a>
                    <a href="{{ route('public.arenas') }}" class="px-6 py-2.5 bg-ewc-gold text-black font-bold uppercase text-xs rounded-sm hover:bg-yellow-400 shadow-md transition-colors">
                        New Booking
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-ewc-black rounded-xl p-6 text-white relative overflow-hidden shadow-xl">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-ewc-gold/20 rounded-full blur-3xl -translate-y-10 translate-x-10"></div>
                    <h3 class="text-ewc-gold font-bold uppercase tracking-widest text-xs mb-4">Next Session</h3>

                    @if($nextSession)
                        <div class="relative z-10">
                            <div class="text-3xl font-black mb-1">
                                {{ $nextSession->start_time->format('H:i') }}
                            </div>
                            <p class="text-gray-400 text-sm mb-4">
                                {{ $nextSession->start_time->format('l, d M Y') }}
                            </p>
                            <div class="inline-block bg-white/10 px-3 py-1 rounded text-xs font-mono border border-white/20">
                                {{ $nextSession->bookable->name ?? $nextSession->bookable->pc_number }}
                            </div>
                        </div>
                    @else
                        <div class="text-gray-500 py-4">
                            <p class="text-xl font-bold text-white">No Upcoming Games</p>
                            <p class="text-xs mt-1">Book a slot to start playing.</p>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs mb-4">Total Spent</h3>
                    <p class="text-3xl font-black text-ewc-black">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                    <p class="text-xs text-green-600 font-bold mt-2">+ Member Points Earned</p>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs mb-4">Total Sessions</h3>
                    <p class="text-3xl font-black text-ewc-black">{{ $myBookings->count() }}</p>
                    <p class="text-xs text-gray-400 mt-2">Keep grinding!</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

                <div
                    class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50/50">
                    <h3 class="font-bold text-ewc-black uppercase text-sm tracking-wide">Booking History</h3>

                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                        <div class="relative">
                            <select name="status" onchange="this.form.submit()"
                                class="w-full sm:w-auto appearance-none bg-white border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm py-2 pl-3 pr-8 focus:outline-none focus:border-ewc-gold cursor-pointer">
                                <option value="all">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID or Item..."
                                class="w-full pl-9 pr-4 py-2 text-xs border border-gray-300 rounded-sm focus:border-ewc-gold outline-none transition-all">
                            <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                </div>

                @if($myBookings->isEmpty())
                    <div class="p-12 text-center text-gray-400">
                        <p>No bookings found matching your criteria.</p>
                        @if(request('search') || request('status'))
                            <a href="{{ route('dashboard') }}"
                                class="text-ewc-gold text-xs font-bold hover:underline mt-2 inline-block">Clear Filters</a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-white text-gray-500 font-bold uppercase text-[10px] border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Booking ID</th>
                                    <th class="px-6 py-3">Item</th>
                                    <th class="px-6 py-3">Time</th>
                                    <th class="px-6 py-3">Total</th>
                                    <th class="px-6 py-3 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($myBookings as $booking)
                                                                        <tr class="hover:bg-gray-50 transition-colors">
                                                                            <td class="px-6 py-4 font-bold text-gray-700 text-xs">
                                                                                {{ $booking->created_at->format('d M Y') }}
                                                                            </td>
                                                                            <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                                                                #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                                                            </td>
                                                                            <td class="px-6 py-4 font-bold text-ewc-black">
                                                                                {{ $booking->bookable->name ?? $booking->bookable->pc_number }}
                                                                            </td>
                                                                            <td class="px-6 py-4">
                                                                                <div class="flex flex-col">
                                                                                    <span class="font-bold text-ewc-black">{{ $booking->bookable->name ?? $booking->bookable->pc_number }}</span>
                                                                                    <a href="{{ route('booking.show', $booking->id) }}"
                                                                                        class="text-[10px] text-blue-600 font-bold hover:underline mt-1 flex items-center gap-1 w-max">
                                                                                        VIEW TICKET <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                                        </svg>
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 font-mono font-bold text-ewc-gold">
                                                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                                            </td>
                                                                            <td class="px-6 py-4 text-right">
                                                                                <span
                                                                                    class="px-2 py-1 text-[10px] font-bold uppercase rounded 
                                                                                                    {{ $booking->status == 'completed' ? 'bg-green-100 text-green-700' :
                                    ($booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' :
                                        ($booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700')) }}">
                                                                                    {{ $booking->status }}
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        {{ $myBookings->links('pagination.custom') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection