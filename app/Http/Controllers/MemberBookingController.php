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
        // 1. VALIDASI INPUT
        $validated = $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:12',
            // Validasi Payment: Cash, Transfer, atau QRIS
            'payment_method' => 'required|in:transfer,qris,cash',
            // Bukti bayar wajib HANYA JIKA metode bukan cash
            'payment_proof' => 'required_if:payment_method,transfer,qris|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Casting durasi ke Integer untuk perhitungan matematika
        $duration = (int) $request->duration;

        // 2. HITUNG WAKTU SELESAI (Carbon)
        // Menggabungkan tanggal dan jam mulai menjadi objek Carbon
        $startDateTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);

        // Menghitung jam selesai berdasarkan durasi
        $endDateTime = $startDateTime->copy()->addHours($duration);

        // 3. CEK KONFLIK JADWAL (Overlap Checking)
        // Memastikan tidak ada booking lain di jam yang sama untuk unit tersebut
        $exists = Booking::where('bookable_type', $request->bookable_type)
            ->where('bookable_id', $request->bookable_id)
            ->where('status', '!=', 'cancelled') // Abaikan yang sudah cancel
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_time', [$startDateTime, $endDateTime])
                    ->orWhereBetween('end_time', [$startDateTime, $endDateTime])
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where('start_time', '<', $startDateTime)
                            ->where('end_time', '>', $endDateTime);
                    });
            })
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['conflict' => 'Jadwal tersebut sudah terisi. Silakan pilih jam atau unit lain.'])
                ->withInput();
        }

        // 4. HITUNG TOTAL HARGA
        // Cek apakah yang dibooking adalah PC atau Arena untuk ambil harga per jam
        if ($request->bookable_type == 'App\Models\Arena') {
            $item = Arena::find($request->bookable_id);
            $pricePerHour = $item->price_per_hour;
        } else {
            // Asumsi PC, perlu load relasi type untuk harga
            $item = Pc::with('type')->find($request->bookable_id);
            $pricePerHour = $item->type->price_per_hour;
        }

        $totalPrice = $pricePerHour * $duration;

        // 5. HANDLE UPLOAD BUKTI BAYAR (Jika Ada)
        $paymentPath = null;
        if ($request->hasFile('payment_proof')) {
            // Simpan ke folder 'public/payments'
            $paymentPath = $request->file('payment_proof')->store('payments', 'public');
        }

        // 6. SIMPAN KE DATABASE
        Booking::create([
            'user_id' => Auth::id(),
            'bookable_type' => $request->bookable_type,
            'bookable_id' => $request->bookable_id,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method, // Simpan sesuai pilihan (cash/transfer/qris)
            'payment_proof' => $paymentPath,             // Null jika cash
            'status' => 'pending',                // Menunggu konfirmasi admin/staff
        ]);

        // 7. REDIRECT KE DASHBOARD
        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Mohon tunggu konfirmasi admin.');
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