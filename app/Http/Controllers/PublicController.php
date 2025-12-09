<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arena;
use App\Models\Pc;

class PublicController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function arenas()
    {
        // Ganti get() menjadi paginate(12)
        // Angka 12 dipilih karena bisa dibagi 2, 3, dan 4 kolom dengan rapi
        $pcs = Pc::with('type')
            ->orderBy('pc_number')
            ->paginate(12);

        // Arena biasanya sedikit, jadi tetap get() atau all() tidak masalah
        $arenas = Arena::all();

        return view('public.arenas', compact('pcs', 'arenas'));
    }

    public function competitions()
    {
        // Ambil event, urutkan yang 'ongoing' duluan, lalu berdasarkan tanggal
        $events = \App\Models\Event::orderByRaw("FIELD(status, 'ongoing', 'upcoming', 'completed')")
            ->orderBy('start_date', 'asc')
            ->get();

        return view('public.competitions', compact('events'));
    }

    public function schedule()
    {
        // 1. Tentukan awal minggu ini (Senin)
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();

        // 2. Siapkan array struktur minggu (7 Hari)
        $weekSchedule = [];

        for ($i = 0; $i < 7; $i++) {
            $currentDate = $startOfWeek->copy()->addDays($i);

            // Ambil event yang mulai pada tanggal ini
            $events = \App\Models\Event::whereDate('start_date', $currentDate->format('Y-m-d'))
                ->orderBy('start_date')
                ->get();

            $weekSchedule[] = [
                'date_obj' => $currentDate, // Objek Carbon
                'day_name' => $currentDate->format('D'), // Mon, Tue, etc
                'day_num' => $currentDate->format('jS'), // 1st, 2nd, 3rd
                'is_today' => $currentDate->isToday(),
                'events' => $events
            ];
        }

        return view('public.schedule', compact('weekSchedule'));
    }
    public function gallery()
    {
        return view('public.gallery');
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}