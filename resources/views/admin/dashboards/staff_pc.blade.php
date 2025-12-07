@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-ewc-black uppercase">PC Control Room</h1>
            <p class="text-sm text-gray-500">Pantau status unit komputer secara real-time.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-green-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Available Now</p>
                <h3 class="text-3xl font-black text-green-600">{{ $stats['available_pcs'] }} <span
                        class="text-sm text-gray-400">/ {{ $stats['total_pcs'] }}</span></h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-red-500">
                <p class="text-xs font-bold text-gray-400 uppercase">Maintenance</p>
                <h3 class="text-3xl font-black text-red-500">{{ $stats['maintenance_pcs'] }} <span
                        class="text-sm text-gray-400">Unit</span></h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-ewc-gold">
                <p class="text-xs font-bold text-gray-400 uppercase">Today's Sessions</p>
                <h3 class="text-3xl font-black text-ewc-gold">{{ $stats['today_bookings'] }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-ewc-black mb-4">Quick Actions</h3>
            <div class="flex gap-4">
                <a href="{{ route('admin.pcs.index') }}"
                    class="px-4 py-2 bg-ewc-black text-white text-sm font-bold rounded-sm hover:bg-gray-800">Manage All
                    PCs</a>
                <a href="{{ route('admin.bookings.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-bold rounded-sm hover:bg-gray-50">Check
                    Schedule</a>
            </div>
        </div>
    </div>
@endsection