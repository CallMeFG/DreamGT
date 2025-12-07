<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminCalendarController extends Controller
{
    public function index()
    {
        // 1. Ambil semua booking yang aktif (Confirmed/Completed)
        $bookings = Booking::with('bookable')
            ->whereIn('status', ['confirmed', 'completed'])
            ->get();

        // 2. Format data untuk FullCalendar
        $events = [];

        foreach ($bookings as $booking) {
            // Tentukan Warna & Judul berdasarkan tipe (PC/Arena)
            if ($booking->bookable_type === 'App\Models\Pc') {
                $color = '#000000'; // Hitam untuk PC
                $title = $booking->bookable->pc_number . ' (' . $booking->user->name . ')';
            } else {
                $color = '#fbbf24'; // Emas untuk Arena
                $textColor = '#000000'; // Teks hitam biar terbaca di emas
                $title = $booking->bookable->name . ' (' . $booking->user->name . ')';
            }

            $events[] = [
                'title' => $title,
                'start' => $booking->start_time->toIso8601String(),
                'end' => $booking->end_time->toIso8601String(),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => $textColor ?? '#ffffff',
                'extendedProps' => [
                    'status' => $booking->status
                ]
            ];
        }

        return view('admin.calendar.index', compact('events'));
    }
}