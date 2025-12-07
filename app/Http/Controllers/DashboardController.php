<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // PROTEKSI: Redirect Admin/Staff ke tempatnya
        if (in_array($user->role, ['admin', 'staff_pc', 'staff_arena'])) {
            return redirect()->route('admin.dashboard');
        }

        // 1. STATISTIK (Tetap ambil summary dari seluruh data)
        // Kita butuh query terpisah agar statistik tidak berubah saat di-filter/search
        $allUserBookings = Booking::where('user_id', $user->id);

        $totalSpent = (clone $allUserBookings)->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $totalSessions = (clone $allUserBookings)->count();

        // 2. NEXT SESSION (Sama seperti sebelumnya)
        $nextSession = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->first();

        // 3. BOOKING HISTORY (DENGAN SEARCH, FILTER, & PAGINATION)
        $myBookings = Booking::with('bookable')
            ->where('user_id', $user->id) // Kunci: Hanya data milik user ini
            ->filter(request(['search', 'status'])) // Scope filter yang sudah ada di Model Booking
            ->latest()
            ->paginate(5) // Tampilkan 5 per halaman agar tidak terlalu panjang
            ->withQueryString();

        return view('dashboard', compact('user', 'myBookings', 'nextSession', 'totalSpent', 'totalSessions'));
    }
}