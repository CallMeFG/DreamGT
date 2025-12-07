@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 p-8 flex justify-center" x-data="{ paymentMethod: 'bank_transfer' }">

        <div
            class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 flex flex-col md:flex-row">

            <div class="w-full md:w-1/2 p-8 border-r border-gray-100 bg-white relative">
                <h2 class="text-2xl font-black text-ewc-black uppercase tracking-tighter mb-1">Payment <span
                        class="text-ewc-gold">Required</span></h2>
                <p class="text-xs text-gray-500 mb-8">Order ID: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>

                <div class="space-y-4 mb-8">
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-sm text-gray-600">Item</span>
                        <span
                            class="text-sm font-bold text-ewc-black">{{ $booking->bookable->name ?? $booking->bookable->pc_number }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-sm text-gray-600">Date & Time</span>
                        <span class="text-sm font-bold text-ewc-black text-right">
                            {{ $booking->start_time->format('d M Y') }}<br>
                            {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-black text-ewc-gold">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-auto">
                    <div class="mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Transfer To:</div>

                    <div x-show="paymentMethod === 'bank_transfer'" x-transition.opacity
                        class="bg-gray-50 p-5 rounded-md border border-gray-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded">BCA</div>
                            <span class="text-sm font-bold text-gray-700">Bank Central Asia</span>
                        </div>
                        <p class="text-2xl font-mono text-ewc-black tracking-wider font-bold">8210-9988-77</p>
                        <p class="text-xs text-gray-500 mt-1">a.n Game Central Indonesia</p>
                    </div>

                    <div x-show="paymentMethod === 'qris'" style="display: none;" x-transition.opacity
                        class="bg-white p-4 rounded-md border-2 border-ewc-black text-center">
                        <p class="text-xs font-bold text-gray-500 mb-3">SCAN QR CODE BELOW</p>
                        <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Code"
                            class="w-48 h-48 mx-auto object-contain border border-gray-100 rounded-lg p-2">
                        <p class="text-[10px] text-gray-400 mt-2">NMID: ID10200300400</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 bg-gray-50">
                <h3 class="font-bold text-ewc-black mb-6">Select Method & Pay</h3>

                <form action="{{ route('payment.update', $booking->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Payment Method</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="payment_method" value="bank_transfer" x-model="paymentMethod"
                                    class="peer sr-only">
                                <div
                                    class="text-center py-3 border border-gray-300 rounded-sm text-sm font-bold text-gray-600 bg-white peer-checked:bg-ewc-black peer-checked:text-white peer-checked:border-ewc-black transition-all shadow-sm">
                                    Bank Transfer
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="payment_method" value="qris" x-model="paymentMethod"
                                    class="peer sr-only">
                                <div
                                    class="text-center py-3 border border-gray-300 rounded-sm text-sm font-bold text-gray-600 bg-white peer-checked:bg-ewc-black peer-checked:text-white peer-checked:border-ewc-black transition-all shadow-sm">
                                    QRIS
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Upload Proof (Bukti)</label>
                        <div class="relative">
                            <input type="file" name="payment_proof" accept="image/*" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-bold file:bg-ewc-gold file:text-ewc-black hover:file:bg-yellow-400 cursor-pointer bg-white border border-gray-300 rounded-sm">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2">Format: JPG, PNG. Max Size: 2MB.</p>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-green-600 text-white font-black uppercase tracking-widest rounded-sm hover:bg-green-700 transition shadow-lg mt-6 transform hover:-translate-y-0.5">
                        Confirm Payment
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection