<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Pc;
use App\Models\Arena;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA (Cards)
        $stats = [
            'revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
            'bookings_count' => Booking::whereIn('status', ['confirmed', 'completed'])->count(),
            'active_pcs' => Pc::where('status', 'available')->count(),
            'total_users' => User::where('role', 'member')->count(),
        ];

        // 2. GRAFIK PENDAPATAN (Line Chart - 7 Hari Terakhir)
        $revenueData = [];
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueLabels[] = $date->format('D, d M'); // Format: Mon, 12 Dec
            $revenueData[] = Booking::whereDate('created_at', $date)
                ->whereIn('status', ['confirmed', 'completed'])
                ->sum('total_price');
        }

        // 3. GRAFIK PEAK HOURS (Bar Chart - Kapan paling ramai?)
        // Mengelompokkan booking berdasarkan Jam Mulai
        $peakHoursData = Booking::selectRaw('HOUR(start_time) as hour, count(*) as total')
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('total', 'hour')
            ->toArray();

        // Format array 24 jam (00:00 - 23:00), isi 0 jika tidak ada data
        $formattedPeakHours = [];
        for ($i = 0; $i < 24; $i++) {
            $formattedPeakHours[] = $peakHoursData[$i] ?? 0;
        }

        // 4. GRAFIK KOMPOSISI PRODUK (Doughnut Chart - PC vs Arena)
        $pcRevenue = Booking::where('bookable_type', 'App\Models\Pc')
            ->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $arenaRevenue = Booking::where('bookable_type', 'App\Models\Arena')
            ->whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // 5. LEADERBOARD (Top 5 Sultan)
        $topCustomers = Booking::selectRaw('user_id, sum(total_price) as total_spent')
            ->whereIn('status', ['confirmed', 'completed'])
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->with('user')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'revenueLabels',
            'revenueData',
            'formattedPeakHours',
            'pcRevenue',
            'arenaRevenue',
            'topCustomers'
        ));
    }
}