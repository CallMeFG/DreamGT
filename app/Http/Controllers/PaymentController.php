<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // 1. Tampilkan Halaman Pembayaran
    public function show(Booking $booking)
    {
        // Pastikan booking ini milik user yang sedang login & statusnya pending
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Akses tidak valid.');
        }

        return view('member.payment.show', compact('booking'));
    }

    // 2. Proses Upload Bukti Bayar
    public function update(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048', // Max 2MB
            'payment_method' => 'required',
        ]);

        // Simpan File Gambar
        $path = $request->file('payment_proof')->store('payments', 'public');

        // Update Database
        $booking->update([
            'status' => 'confirmed', // Ubah status jadi confirmed (menunggu verifikasi admin)
            'payment_method' => $request->payment_method,
            'payment_proof' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }
}