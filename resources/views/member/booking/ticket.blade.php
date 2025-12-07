@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 px-4 flex justify-center items-center print:bg-white print:p-0">

        <div
            class="bg-white w-full max-w-3xl rounded-xl shadow-2xl overflow-hidden print:shadow-none print:w-full print:max-w-none">

            <div class="bg-ewc-black p-8 text-center print:bg-black">
                <h1 class="text-3xl font-black text-white uppercase tracking-tighter mb-2">Game Central</h1>
                <p class="text-ewc-gold text-xs font-bold uppercase tracking-[0.3em]">Official Entry Pass</p>
            </div>

            <div class="p-8 md:p-12 relative">

                <div class="text-center mb-8">
                    @if($booking->status == 'completed')
                        <span
                            class="px-4 py-1 bg-green-100 text-green-700 font-black uppercase text-sm rounded-full print:border print:border-black">Paid
                            & Verified</span>
                    @elseif($booking->status == 'confirmed')
                        <span class="px-4 py-1 bg-blue-100 text-blue-700 font-black uppercase text-sm rounded-full">Waiting
                            Check-in</span>
                    @else
                        <span class="px-4 py-1 bg-red-100 text-red-700 font-black uppercase text-sm rounded-full">Invalid /
                            Unpaid</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-8 mb-8 border-b border-gray-100 pb-8">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Player Name</p>
                        <p class="text-xl font-bold text-gray-900">{{ $booking->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $booking->user->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Booking ID</p>
                        <p class="text-xl font-mono font-bold text-gray-900">
                            #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Facility / Unit</p>
                        <p class="text-2xl font-black text-ewc-black uppercase">
                            {{ $booking->bookable->name ?? $booking->bookable->pc_number }}</p>
                        <p class="text-xs text-gray-500">{{ class_basename($booking->bookable_type) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Date</p>
                        <p class="text-xl font-bold text-gray-900">{{ $booking->start_time->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Time (WIB)</p>
                        <p class="text-xl font-bold text-gray-900">{{ $booking->start_time->format('H:i') }} -
                            {{ $booking->end_time->format('H:i') }}</p>
                    </div>
                </div>

                @if($booking->payment_proof)
                    <div class="mb-8 border-t border-gray-100 pt-6">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-3 text-center">Payment Proof</p>

                        <div class="flex justify-center">
                            <div
                                class="h-48 w-full max-w-xs rounded-lg overflow-hidden border border-gray-200 p-1 bg-white shadow-sm hover:scale-105 transition-transform cursor-pointer">

                                {{-- Cek URL yang dihasilkan --}}
                                @php
                                    $imageUrl = asset('storage/' . $booking->payment_proof);
                                @endphp

                                <a href="{{ $imageUrl }}" target="_blank">
                                    <img src="{{ $imageUrl }}" class="h-full w-full object-contain rounded" alt="Bukti Bayar"
                                        onerror="this.onerror=null; this.src='https://via.placeholder.com/300?text=Image+Not+Found'; alert('Gagal memuat gambar di: ' + this.src)">
                                </a>
                            </div>
                        </div>

                        <p class="text-[10px] text-center text-blue-500 mt-2 hover:underline">
                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">View Original</a>
                        </p>
                    </div>
                @endif

                <div class="flex justify-between items-center pt-6 border-t-2 border-black">
                    <span class="font-black text-xl uppercase">Total Paid</span>
                    <span class="font-black text-3xl text-ewc-gold print:text-black">Rp
                        {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="bg-gray-50 p-6 flex justify-between items-center print:hidden">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-gray-500 hover:text-black">← Back to
                    Dashboard</a>
                <button onclick="window.print()"
                    class="flex items-center gap-2 px-6 py-3 bg-ewc-black text-white font-bold uppercase text-xs rounded-sm hover:bg-gray-800 transition-all shadow-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Ticket
                </button>
            </div>
        </div>
    </div>
@endsection