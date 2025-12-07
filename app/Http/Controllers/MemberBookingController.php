<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Arena;
use App\Models\Pc;
use App\Models\Booking;
use Carbon\Carbon;

class MemberBookingController extends Controller
{
    // 1. Tampilkan Form Booking
    public function create(Request $request)
    {
        // Tangkap ID dari URL (hasil klik tombol di catalog)
        $selectedPcId = $request->query('pc_id');
        $selectedArenaId = $request->query('arena_id');

        // Ambil data untuk dropdown
        $pcs = Pc::where('status', 'available')->get();
        $arenas = Arena::where('status', 'available')->get();

        // Kirim variabel 'selectedPcId' & 'selectedArenaId' ke view
        return view('member.booking.create', compact('pcs', 'arenas', 'selectedPcId', 'selectedArenaId'));
    }

    // 2. Proses Simpan Booking (Store)
    // 2. Proses Simpan Booking (Store)
    public function store(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration' => 'required|integer|min:1|max:12',
            'bookable_type' => 'required',
            'bookable_id' => 'required',
        ]);

        // Casting ke Integer agar Carbon tidak error
        $duration = (int) $request->duration;

        // Hitung Waktu Selesai
        $startDateTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);

        // PERBAIKAN DI SINI: Gunakan variabel $duration yg sudah di-cast ke int
        $endDateTime = $startDateTime->copy()->addHours($duration);

        // CEK KONFLIK JADWAL
        $exists = Booking::where('bookable_type', $request->bookable_type)
            ->where('bookable_id', $request->bookable_id)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_time', [$startDateTime, $endDateTime])
                    ->orWhereBetween('end_time', [$startDateTime, $endDateTime])
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where('start_time', '<', $startDateTime)
                            ->where('end_time', '>', $endDateTime);
                    });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return back()->withErrors(['conflict' => 'Jadwal tersebut sudah terisi. Pilih jam lain.'])->withInput();
        }

        // Hitung Harga Total
        if ($request->bookable_type == Arena::class) {
            $item = Arena::find($request->bookable_id);
            $pricePerHour = $item->price_per_hour;
        } else {
            $item = Pc::find($request->bookable_id);
            $pricePerHour = $item->type->price_per_hour;
        }

        // PERBAIKAN DI SINI JUGA: Gunakan $duration (int) untuk perkalian harga
        $totalPrice = $pricePerHour * $duration;

        // Simpan ke Database
        Booking::create([
            'user_id' => Auth::id(),
            'bookable_type' => $request->bookable_type,
            'bookable_id' => $request->bookable_id,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => 'cash',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }
    public function show(Booking $booking)
    {
        // 1. Proteksi: Pastikan yang lihat adalah pemilik booking atau Admin/Staff
        if (auth()->user()->role === 'member' && $booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('member.booking.ticket', compact('booking'));
    }
}