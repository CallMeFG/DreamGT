<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Pc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PastBookingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil User Member (Biasanya ID 2 kalau urutan seeder awal sama)
        $user = User::where('role', 'member')->first();

        if (!$user) {
            $this->command->info('Tidak ada user member ditemukan. Jalankan DatabaseSeeder dulu!');
            return;
        }

        // 2. Loop untuk 7 hari terakhir (H-7 sampai Hari Ini)
        for ($i = 0; $i < 7; $i++) {

            // Tentukan tanggal (Mundur $i hari)
            $date = Carbon::now()->subDays($i);

            // Buat jumlah transaksi acak per hari (misal 1 sampai 5 transaksi per hari)
            $dailyTransactions = rand(1, 5);

            for ($k = 0; $k < $dailyTransactions; $k++) {

                // Ambil Random PC beserta harganya
                $pc = Pc::with('type')->inRandomOrder()->first();

                // Durasi main acak (1 - 4 jam)
                $duration = rand(1, 4);

                // Hitung harga
                $totalPrice = $pc->type->price_per_hour * $duration;

                // Tentukan Jam Mulai Acak (antara jam 10 pagi s/d 8 malam)
                $startHour = rand(10, 20);
                $startTime = $date->copy()->setHour($startHour)->setMinute(0);
                $endTime = $startTime->copy()->addHours($duration);

                // Simpan ke Database
                Booking::create([
                    'user_id' => $user->id,
                    'bookable_id' => $pc->id,
                    'bookable_type' => 'App\Models\Pc', // Polymorphic relation
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'total_price' => $totalPrice,
                    'status' => 'completed', // PENTING: Status harus Completed agar masuk hitungan Revenue
                    'created_at' => $startTime, // Manipulasi tanggal pembuatan agar sesuai hari H
                    'updated_at' => $endTime,
                ]);
            }
        }
    }
}
