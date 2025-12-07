@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">

        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Manage PCs</h1>
                <p class="text-sm text-gray-500 mt-1">Total Unit: {{ $pcs->total() }} Computers</p>
            </div>
            <a href="{{ route('admin.pcs.create') }}"
                class="px-5 py-2.5 bg-ewc-black text-white text-sm font-bold uppercase tracking-wider rounded-sm hover:bg-gray-800 transition shadow-lg">
                + Add New PC
            </a>
        </div>

        <div
            class="bg-white p-4 rounded-t-xl border border-gray-200 border-b-0 flex flex-col md:flex-row justify-between gap-4 shadow-sm">
            <form action="{{ route('admin.pcs.index') }}" method="GET" class="flex gap-3 w-full md:w-auto items-center">

                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm py-2.5 pl-4 pr-8 focus:outline-none focus:border-ewc-gold cursor-pointer">
                        <option value="all">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search PC Number..."
                        class="w-full pl-9 pr-4 py-2.5 text-xs border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                    <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <button type="submit"
                    class="px-4 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-200 transition">Filter</button>

                @if(request('search') || request('status'))
                    <a href="{{ route('admin.pcs.index') }}" class="text-red-500 text-xs font-bold hover:underline">Reset</a>
                @endif
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-b-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-500 font-bold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>

                            <th class="px-6 py-4">PC Number</th>
                            <th class="px-6 py-4">Type & Specs</th>
                            <th class="px-6 py-4">Price/Hr</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pcs as $index => $pc)
                                        <tr class="hover:bg-gray-50 transition-colors">

                                            <td class="px-6 py-4 text-center font-mono text-gray-400 text-xs">
                                                {{ ($pcs->currentPage() - 1) * $pcs->perPage() + $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4">
                                                <span class="font-black text-ewc-black text-lg">{{ $pc->pc_number }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-bold text-gray-800">{{ $pc->type->name ?? 'Unknown Type' }}</p>
                                                <p class="text-xs text-gray-500 mt-1 truncate max-w-xs">
                                                    {{ $pc->specifications ?? 'No specs listed' }}</p>
                                            </td>
                                            <td class="px-6 py-4 font-mono font-bold text-ewc-gold">
                                                Rp {{ number_format($pc->type->price_per_hour ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                                        {{ $pc->status == 'available' ? 'bg-green-100 text-green-700' :
        ($pc->status == 'maintenance' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full {{ $pc->status == 'available' ? 'bg-green-600' : ($pc->status == 'maintenance' ? 'bg-red-600' : 'bg-yellow-600') }}"></span>
                                                    {{ $pc->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-3">
                                                    <a href="{{ route('admin.pcs.edit', $pc->id) }}"
                                                        class="text-gray-400 hover:text-blue-600 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.pcs.destroy', $pc->id) }}" method="POST"
                                                        onsubmit="return confirm('Delete Unit {{ $pc->pc_number }}?');">
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
                                <td colspan="6" class="p-8 text-center text-gray-400">No PC units found. Try adding one.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-center">
                <div class="mt-6">
                    {{ $pcs->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection