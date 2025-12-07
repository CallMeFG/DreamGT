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
        $user = Auth::user();

        // ==========================================
        // 1. LOGIKA DASHBOARD STAFF (Early Return)
        // ==========================================

        // --- STAFF PC ---
        if ($user->role === 'staff_pc') {
            $stats = [
                'total_pcs' => Pc::count(),
                'available_pcs' => Pc::where('status', 'available')->count(),
                'maintenance_pcs' => Pc::where('status', 'maintenance')->count(),
                'today_bookings' => Booking::where('bookable_type', 'App\Models\Pc')
                    ->whereDate('start_time', now())
                    ->where('status', 'confirmed')
                    ->count(),
            ];
            return view('admin.dashboards.staff_pc', compact('stats'));
        }

        // --- STAFF ARENA ---
        if ($user->role === 'staff_arena') {
            $stats = [
                'total_arenas' => Arena::count(),
                'today_bookings' => Booking::where('bookable_type', 'App\Models\Arena')
                    ->whereDate('start_time', now())
                    ->where('status', 'confirmed')
                    ->count(),
                'upcoming_events' => \App\Models\Event::where('start_date', '>=', now())->count(),
            ];
            return view('admin.dashboards.staff_arena', compact('stats'));
        }

        // ==========================================
        // 2. LOGIKA DASHBOARD ADMIN (BI & Charts)
        // ==========================================

        // Hanya dijalankan jika user adalah ADMIN

        // A. Statistik Utama
        $stats = [
            'revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
            'bookings_count' => Booking::whereIn('status', ['confirmed', 'completed'])->count(),
            'active_pcs' => Pc::where('status', 'available')->count(),
            'total_users' => User::where('role', 'member')->count(),
        ];

        // B. Grafik Pendapatan (7 Hari)
        $revenueData = [];
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueLabels[] = $date->format('D, d M');
            $revenueData[] = Booking::whereDate('created_at', $date)
                ->whereIn('status', ['confirmed', 'completed'])
                ->sum('total_price');
        }

        // C. Grafik Peak Hours (Jam Sibuk)
        $peakHoursData = Booking::selectRaw('HOUR(start_time) as hour, count(*) as total')
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('total', 'hour')
            ->toArray();

        $formattedPeakHours = [];
        for ($i = 0; $i < 24; $i++) {
            $formattedPeakHours[] = $peakHoursData[$i] ?? 0;
        }

        // D. Revenue Mix (PC vs Arena)
        $pcRevenue = Booking::where('bookable_type', 'App\Models\Pc')
            ->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $arenaRevenue = Booking::where('bookable_type', 'App\Models\Arena')
            ->whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // E. Top Spenders
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