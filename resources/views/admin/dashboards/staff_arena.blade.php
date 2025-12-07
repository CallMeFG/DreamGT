@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-ewc-black uppercase">Arena Manager</h1>
            <p class="text-sm text-gray-500">Kelola jadwal ruangan VIP dan Main Stage.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase">Total Venues</p>
                <h3 class="text-3xl font-black text-ewc-black">{{ $stats['total_arenas'] }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-ewc-gold">
                <p class="text-xs font-bold text-gray-400 uppercase">Booked Today</p>
                <h3 class="text-3xl font-black text-ewc-gold">{{ $stats['today_bookings'] }} <span
                        class="text-sm text-gray-400">Sessions</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-ewc-black mb-4">Quick Actions</h3>
            <div class="flex gap-4">
                <a href="{{ route('admin.arenas.index') }}"
                    class="px-4 py-2 bg-ewc-black text-white text-sm font-bold rounded-sm hover:bg-gray-800">Manage
                    Arenas</a>
                <a href="{{ route('admin.bookings.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-bold rounded-sm hover:bg-gray-50">View
                    Incoming Bookings</a>
            </div>
        </div>
    </div>
@endsection