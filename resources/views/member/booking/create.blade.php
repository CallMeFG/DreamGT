@extends('layouts.app')

@section('content')
    @php
        $selectedItem = null;
        $initialType = 'pc';

        if (isset($selectedPcId) && $selectedPcId) {
            $selectedItem = $pcs->find($selectedPcId);
            $initialType = 'pc';
        } elseif (isset($selectedArenaId) && $selectedArenaId) {
            $selectedItem = $arenas->find($selectedArenaId);
            $initialType = 'arena';
        }
    @endphp

    <div class="min-h-full bg-gray-50 p-8 md:p-12 flex justify-center">
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">

            <div class="bg-ewc-black p-8 text-white flex justify-between items-center relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10">
                </div>
                <div class="relative z-10">
                    <h2 class="text-2xl font-black uppercase tracking-tighter">Booking & Payment</h2>
                    <p class="text-xs text-gray-400 mt-1 font-mono">STEP 1 OF 1</p>
                </div>
                <div class="relative z-10 text-right">
                    <span class="block text-[10px] text-ewc-gold font-bold uppercase tracking-widest">Selected Unit</span>
                    <span class="text-xl font-bold">
                        {{ $selectedItem ? ($selectedItem->name ?? $selectedItem->pc_number) : 'New Session' }}
                    </span>
                </div>
            </div>

            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-sm">
                        <p class="font-bold text-xs uppercase mb-1">Please Fix These Errors</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
                    id="bookingForm">
                    @csrf

                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-ewc-black uppercase border-b border-gray-100 pb-2">1. Session
                            Details</h3>

                        <div class="flex border-b border-gray-200 mb-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="booking_type_selector" value="pc" class="peer sr-only" {{ $initialType == 'pc' ? 'checked' : '' }} onchange="toggleType('pc')">
                                <div
                                    class="text-center py-3 text-sm font-bold text-gray-400 peer-checked:text-ewc-black peer-checked:border-b-2 peer-checked:border-ewc-gold transition-all uppercase tracking-wider">
                                    PC Workstation</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="booking_type_selector" value="arena" class="peer sr-only" {{ $initialType == 'arena' ? 'checked' : '' }} onchange="toggleType('arena')">
                                <div
                                    class="text-center py-3 text-sm font-bold text-gray-400 peer-checked:text-ewc-black peer-checked:border-b-2 peer-checked:border-ewc-gold transition-all uppercase tracking-wider">
                                    VIP Arena</div>
                            </label>
                        </div>

                        <input type="hidden" name="bookable_type" id="inputType"
                            value="{{ $initialType == 'pc' ? 'App\Models\Pc' : 'App\Models\Arena' }}">

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Select Unit</label>
                            <select id="pcSelect" name="pc_id"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold outline-none font-bold text-gray-700"
                                {{ $initialType == 'arena' ? 'disabled style=display:none' : '' }}
                                onchange="calculateTotal()">
                                @foreach($pcs as $pc)
                                    <option value="{{ $pc->id }}" data-price="{{ $pc->type->price_per_hour }}" {{ (isset($selectedPcId) && $selectedPcId == $pc->id) ? 'selected' : '' }}>
                                        {{ $pc->pc_number }} - {{ $pc->type->name }} (Rp
                                        {{ number_format($pc->type->price_per_hour, 0, ',', '.') }}/hr)
                                    </option>
                                @endforeach
                            </select>
                            <select id="arenaSelect" name="arena_id"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold outline-none font-bold text-gray-700"
                                {{ $initialType == 'pc' ? 'disabled style=display:none' : '' }} onchange="calculateTotal()">
                                @foreach($arenas as $arena)
                                    <option value="{{ $arena->id }}" data-price="{{ $arena->price_per_hour }}" {{ (isset($selectedArenaId) && $selectedArenaId == $arena->id) ? 'selected' : '' }}>
                                        {{ $arena->name }} (Rp {{ number_format($arena->price_per_hour, 0, ',', '.') }}/hr)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Date</label>
                                <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Start Time</label>
                                <input type="time" name="start_time" value="{{ now()->addHour()->format('H:00') }}" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Duration</label>
                                <select name="duration" id="durationSelect" onchange="calculateTotal()"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold outline-none font-bold">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }} Hour{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-ewc-black uppercase border-b border-gray-100 pb-2">2. Payment
                        </h3>

                        <div
                            class="p-6 bg-black rounded-lg flex justify-between items-center text-white border-l-4 border-ewc-gold">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Total To
                                    Pay</span>
                                <span class="text-xs text-gray-500">Includes Tax & Service</span>
                            </div>
                            <span class="text-3xl font-black text-ewc-gold" id="totalDisplay">Rp 0</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-3">Payment Method</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="transfer" class="peer sr-only"
                                        onchange="togglePaymentInfo('transfer')" checked>
                                    <div
                                        class="p-4 border border-gray-300 rounded-lg hover:border-ewc-gold peer-checked:border-ewc-gold peer-checked:bg-yellow-50 flex items-center gap-3 transition-all">
                                        <div
                                            class="w-4 h-4 rounded-full border border-gray-400 peer-checked:bg-ewc-gold peer-checked:border-ewc-gold">
                                        </div>
                                        <span class="font-bold text-sm text-gray-700">Bank Transfer (BCA)</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="qris" class="peer sr-only"
                                        onchange="togglePaymentInfo('qris')">
                                    <div
                                        class="p-4 border border-gray-300 rounded-lg hover:border-ewc-gold peer-checked:border-ewc-gold peer-checked:bg-yellow-50 flex items-center gap-3 transition-all">
                                        <div
                                            class="w-4 h-4 rounded-full border border-gray-400 peer-checked:bg-ewc-gold peer-checked:border-ewc-gold">
                                        </div>
                                        <span class="font-bold text-sm text-gray-700">QRIS (GoPay/OVO/Dana)</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="transferInfo"
                            class="p-4 bg-gray-100 rounded-md border border-gray-200 text-sm text-gray-600">
                            <p class="font-bold text-gray-800 mb-1">Bank BCA</p>
                            <p class="font-mono text-lg tracking-wider text-black">123-456-7890</p>
                            <p class="text-xs mt-1">a.n Game Central Indonesia</p>
                        </div>

                        <div id="qrisInfo" class="hidden p-4 bg-gray-100 rounded-md border border-gray-200 text-center">
                            <p class="font-bold text-gray-800 mb-4 text-xs uppercase tracking-widest">Scan QR Code Below</p>
                            <img src="{{ asset('images/qris.jpeg') }}"
                                class="w-48 h-48 mx-auto border-4 border-white shadow-sm" alt="QRIS Code">
                            <p class="text-[10px] text-gray-500 mt-2">NMID: ID123456789</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Upload Payment Proof</label>
                            <input type="file" name="payment_proof" accept="image/*" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-bold file:bg-ewc-black file:text-white hover:file:bg-gray-800 border border-gray-300 rounded-sm bg-gray-50">
                            <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG. Max: 2MB.</p>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-ewc-gold text-ewc-black font-black uppercase tracking-[0.2em] rounded-sm hover:bg-white hover:shadow-xl transition-all transform hover:-translate-y-1">
                        Complete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // 1. Ganti Tipe PC/Arena
        function toggleType(type) {
            const pcSelect = document.getElementById('pcSelect');
            const arenaSelect = document.getElementById('arenaSelect');
            const inputType = document.getElementById('inputType');

            if (type === 'pc') {
                pcSelect.style.display = 'block';
                pcSelect.disabled = false;
                pcSelect.setAttribute('name', 'bookable_id');

                arenaSelect.style.display = 'none';
                arenaSelect.disabled = true;
                arenaSelect.removeAttribute('name');

                inputType.value = 'App\\Models\\Pc';
            } else {
                pcSelect.style.display = 'none';
                pcSelect.disabled = true;
                pcSelect.removeAttribute('name');

                arenaSelect.style.display = 'block';
                arenaSelect.disabled = false;
                arenaSelect.setAttribute('name', 'bookable_id');

                inputType.value = 'App\\Models\\Arena';
            }
            calculateTotal();
        }

        // 2. Hitung Total Harga
        function calculateTotal() {
            const type = document.querySelector('input[name="booking_type_selector"]:checked').value;
            const duration = parseInt(document.getElementById('durationSelect').value);
            let pricePerHour = 0;

            if (type === 'pc') {
                const selectedOption = document.getElementById('pcSelect').selectedOptions[0];
                pricePerHour = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) : 0;
            } else {
                const selectedOption = document.getElementById('arenaSelect').selectedOptions[0];
                pricePerHour = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) : 0;
            }

            const total = pricePerHour * duration;
            const formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
            document.getElementById('totalDisplay').innerText = formatter.format(total);
        }

        // 3. Ganti Info Payment
        function togglePaymentInfo(method) {
            const transferInfo = document.getElementById('transferInfo');
            const qrisInfo = document.getElementById('qrisInfo');

            if (method === 'transfer') {
                transferInfo.classList.remove('hidden');
                qrisInfo.classList.add('hidden');
            } else {
                transferInfo.classList.add('hidden');
                qrisInfo.classList.remove('hidden');
            }
        }

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            const initialType = '{{ $initialType }}';
            toggleType(initialType);
        });
    </script>
@endsection