@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full">

        <div
            class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">
            <div>
                <h1 class="text-2xl font-black text-ewc-black uppercase tracking-tighter">Command Center</h1>
                <p class="text-xs text-gray-500 font-mono mt-1">REALTIME BUSINESS INTELLIGENCE</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Super Admin</p>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-ewc-black text-ewc-gold flex items-center justify-center font-bold shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <div class="p-8 md:p-12 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all border-l-4 border-l-ewc-gold">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Revenue</p>
                            <h3 class="text-2xl font-black text-ewc-black mt-2">Rp
                                {{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
                        </div>
                        <div class="p-2 bg-yellow-50 rounded text-ewc-gold"><svg class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all border-l-4 border-l-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Orders</p>
                            <h3 class="text-2xl font-black text-ewc-black mt-2">{{ $stats['bookings_count'] }} <span
                                    class="text-sm font-normal text-gray-400">Trx</span></h3>
                        </div>
                        <div class="p-2 bg-blue-50 rounded text-blue-600"><svg class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg></div>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all border-l-4 border-l-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">PCs Available</p>
                            <h3 class="text-2xl font-black text-ewc-black mt-2">{{ $stats['active_pcs'] }} <span
                                    class="text-sm font-normal text-gray-400">Units</span></h3>
                        </div>
                        <div class="p-2 bg-green-50 rounded text-green-600"><svg class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg></div>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all border-l-4 border-l-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Members</p>
                            <h3 class="text-2xl font-black text-ewc-black mt-2">{{ $stats['total_users'] }}</h3>
                        </div>
                        <div class="p-2 bg-purple-50 rounded text-purple-600"><svg class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3
                        class="font-bold text-ewc-black mb-6 uppercase tracking-wider text-sm border-b border-gray-100 pb-2">
                        Revenue Analytics (7 Days)</h3>
                    <div class="relative w-full h-80">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3
                        class="font-bold text-ewc-black mb-6 uppercase tracking-wider text-sm border-b border-gray-100 pb-2">
                        Peak Hours (24h)</h3>
                    <div class="relative w-full h-80">
                        <canvas id="peakHourChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3
                        class="font-bold text-ewc-black mb-6 uppercase tracking-wider text-sm border-b border-gray-100 pb-2">
                        Revenue Source</h3>
                    <div class="relative w-full h-64 flex justify-center">
                        <canvas id="mixChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <span class="block text-xs text-gray-400 font-bold uppercase">PC Rigs</span>
                            <span class="block font-bold text-ewc-black">Rp
                                {{ number_format($pcRevenue, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-400 font-bold uppercase">Arena</span>
                            <span class="block font-bold text-ewc-black">Rp
                                {{ number_format($arenaRevenue, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3
                        class="font-bold text-ewc-black mb-6 uppercase tracking-wider text-sm border-b border-gray-100 pb-2">
                        Top Spenders (Sultan)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-[10px]">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-md">Rank</th>
                                    <th class="px-4 py-3">Member</th>
                                    <th class="px-4 py-3">Total Spent</th>
                                    <th class="px-4 py-3 rounded-r-md text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($topCustomers as $index => $customer)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-bold text-gray-400">#{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-bold text-ewc-black flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-[10px] text-gray-600">
                                                {{ substr($customer->user->name, 0, 1) }}</div>
                                            {{ $customer->user->name }}
                                        </td>
                                        <td class="px-4 py-3 font-mono font-bold text-green-600">Rp
                                            {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-right">
                                            @if($index == 0) <span
                                                class="text-[10px] font-bold bg-ewc-gold text-black px-2 py-1 rounded">MVP</span>
                                            @elseif($index < 3) <span
                                                class="text-[10px] font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded">VIP</span>
                                            @else <span class="text-[10px] font-bold text-gray-400">Member</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // 1. REVENUE CHART (Line)
            new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($revenueLabels) !!},
                    datasets: [{
                        label: 'Income',
                        data: {!! json_encode($revenueData) !!},
                        borderColor: '#fbbf24', // EWC Gold
                        backgroundColor: 'rgba(251, 191, 36, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#000',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. PEAK HOURS CHART (Bar)
            new Chart(document.getElementById('peakHourChart'), {
                type: 'bar',
                data: {
                    labels: Array.from({ length: 24 }, (_, i) => i + ':00'), // 0:00 - 23:00
                    datasets: [{
                        label: 'Bookings',
                        data: {!! json_encode($formattedPeakHours) !!},
                        backgroundColor: '#0a0a0a', // EWC Black
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false } },
                        x: { grid: { display: false }, ticks: { maxTicksLimit: 8 } }
                    }
                }
            });

            // 3. REVENUE MIX (Doughnut)
            new Chart(document.getElementById('mixChart'), {
                type: 'doughnut',
                data: {
                    labels: ['PC Rigs', 'Arena'],
                    datasets: [{
                        data: [{{ $pcRevenue }}, {{ $arenaRevenue }}],
                        backgroundColor: ['#0a0a0a', '#fbbf24'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true } }
                    },
                    cutout: '70%' // Donut style
                }
            });
        });
    </script>
@endsection