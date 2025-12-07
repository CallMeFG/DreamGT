@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">

        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Transactions</h1>
                <p class="text-sm text-gray-500 mt-1">Verify incoming payments.</p>
            </div>
            <div class="bg-white px-4 py-2 border border-gray-200 rounded-sm shadow-sm">
                <span class="text-xs text-gray-400 font-bold uppercase block">Verified Revenue</span>
                <span class="text-xl font-black text-ewc-gold">
                    Rp
                    {{ number_format(\App\Models\Booking::where('status', 'completed')->sum('total_price'), 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div
            class="bg-white p-4 rounded-t-xl border border-gray-200 border-b-0 flex flex-col md:flex-row justify-between gap-4 shadow-sm">
            <form action="{{ route('admin.bookings.index') }}" method="GET"
                class="flex gap-3 w-full md:w-auto items-center">

                <div class="relative">
                    <select name="status" onchange="this.form.submit()"
                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm py-2.5 pl-4 pr-8 focus:outline-none focus:border-ewc-gold cursor-pointer">
                        <option value="all">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Unpaid)
                        </option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed (Paid)
                        </option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Order ID / User Name..."
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
                    <a href="{{ route('admin.bookings.index') }}"
                        class="text-red-500 text-xs font-bold hover:underline">Reset</a>
                @endif
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-b-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-500 font-bold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Order Info</th>
                            <th class="px-6 py-4">Member</th>
                            <th class="px-6 py-4">Item Details</th>
                            <th class="px-6 py-4">Payment Proof</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <span
                                                    class="font-mono text-xs text-gray-500 block">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                                                <span
                                                    class="font-bold text-gray-800 text-xs">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-bold text-ewc-black">{{ $booking->user->name ?? 'Deleted User' }}</p>
                                                <p class="text-xs text-gray-500">{{ $booking->user->email ?? '-' }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="font-bold text-gray-800 block">{{ $booking->bookable->name ?? $booking->bookable->pc_number ?? 'Unknown Item' }}</span>
                                                <span class="text-xs text-gray-500 block">
                                                    {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}
                                                </span>
                                                <span class="text-ewc-gold font-bold text-xs">Rp
                                                    {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                            </td>

                                            <td class="px-6 py-4">
                                                @if($booking->payment_proof)
                                                    <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank"
                                                        class="group flex items-center gap-2">
                                                        <div class="h-10 w-10 rounded overflow-hidden border border-gray-200">
                                                            <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                                                                class="h-full w-full object-cover">
                                                        </div>
                                                        <span class="text-[10px] text-blue-600 font-bold group-hover:underline">VIEW</span>
                                                    </a>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Not Uploaded</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide
                                                        {{ $booking->status == 'completed' ? 'bg-green-100 text-green-700' :
                            ($booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' :
                                ($booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700')) }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">

                                                    @if($booking->status == 'confirmed')
                                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST"
                                                            onsubmit="return confirm('Verify Payment & Complete Order?');">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit"
                                                                class="p-2 bg-green-600 text-white rounded hover:bg-green-700 transition shadow-sm"
                                                                title="Approve Payment">
                                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7" />
                                                                </svg>
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST"
                                                            onsubmit="return confirm('Reject this order?');">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit"
                                                                class="p-2 bg-red-600 text-white rounded hover:bg-red-700 transition shadow-sm"
                                                                title="Reject Payment">
                                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @elseif($booking->status == 'pending')
                                                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST"
                                                            onsubmit="return confirm('Cancel this unpaid order?');">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="text-xs text-red-500 font-bold hover:underline">Cancel
                                                                Order</button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-300 text-xs italic">No Action</span>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $bookings->links('pagination.custom') }}
            </div>
        </div>
    </div>
@endsection