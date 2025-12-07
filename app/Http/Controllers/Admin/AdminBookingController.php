<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Mulai Query
        $query = Booking::with(['user', 'bookable'])->latest();

        // LOGIKA FILTER ROLE:
        // Jika Staff PC -> Hanya tampilkan booking PC
        if ($user->role === 'staff_pc') {
            $query->where('bookable_type', \App\Models\Pc::class);
        }
        // Jika Staff Arena -> Hanya tampilkan booking Arena
        elseif ($user->role === 'staff_arena') {
            $query->where('bookable_type', \App\Models\Arena::class);
        }
        // Jika Admin -> Tampilkan SEMUA (Tidak ada filter)

        // Filter Pencarian & Status (Scope)
        $query->filter(request(['search', 'status']));

        $bookings = $query->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Validasi input status yang dikirim dari tombol
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        // Pesan notifikasi sesuai status
        $msg = $request->status == 'completed' ? 'Booking Approved & Completed!' : 'Booking status updated.';

        return back()->with('success', $msg);
    }
}