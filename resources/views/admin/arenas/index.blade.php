@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">

        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Manage Arenas</h1>
                <p class="text-sm text-gray-500 mt-1">Total Venues: {{ $arenas->total() }} Rooms</p>
            </div>
            <a href="{{ route('admin.arenas.create') }}"
                class="px-5 py-2.5 bg-ewc-black text-white text-sm font-bold uppercase tracking-wider rounded-sm hover:bg-gray-800 transition shadow-lg">
                + Add New Arena
            </a>
        </div>

        <div class="bg-white p-4 rounded-t-xl border border-gray-200 border-b-0 shadow-sm">
            <form action="{{ route('admin.arenas.index') }}" method="GET" class="flex gap-3">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Arena Name..."
                        class="w-full pl-9 pr-4 py-2.5 text-xs border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                    <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit"
                    class="px-4 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-200 transition">Filter</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-b-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-500 font-bold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 w-20">Image</th>
                            <th class="px-6 py-4">Arena Name</th>
                            <th class="px-6 py-4">Capacity</th>
                            <th class="px-6 py-4">Price/Hr</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($arenas as $arena)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="h-12 w-16 bg-gray-200 rounded overflow-hidden">
                                        @if($arena->image_path)
                                            <img src="{{ asset('storage/' . $arena->image_path) }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-xs text-gray-400">No Pic
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-ewc-black">{{ $arena->name }}</span>
                                    <p class="text-[10px] text-gray-500 truncate max-w-xs">{{ $arena->facilities }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $arena->capacity }} Pax
                                </td>
                                <td class="px-6 py-4 font-mono font-bold text-ewc-gold">
                                    Rp {{ number_format($arena->price_per_hour, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                            {{ $arena->status == 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $arena->status == 'available' ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                        {{ $arena->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.arenas.edit', $arena->id) }}"
                                            class="text-gray-400 hover:text-blue-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.arenas.destroy', $arena->id) }}" method="POST"
                                            onsubmit="return confirm('Delete Arena {{ $arena->name }}?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">No Arenas found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $arenas->links('pagination.custom') }}
            </div>
        </div>
    </div>
@endsection