<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin & Member Dummy
        User::create([
            'name' => 'Admin Ganteng',
            'username' => 'admin',
            'email' => 'admin@gamecentral.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        // Staff Khusus PC
        User::create([
            'name' => 'Staff Komputer',
            'username' => 'staff_pc',
            'email' => 'pc@gamecentral.com',
            'password' => Hash::make('password'),
            'role' => 'staff_pc',
        ]);

        // Staff Khusus Arena/Event
        User::create([
            'name' => 'Staff Event',
            'username' => 'staff_arena',
            'email' => 'arena@gamecentral.com',
            'password' => Hash::make('password'),
            'role' => 'staff_arena',
        ]);
        User::create([
            'name' => 'Gamer Sejati',
            'username' => 'gamer123',
            'email' => 'gamer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        // 2. Buat Tipe PC (PC Types)
        $vipId = DB::table('pc_types')->insertGetId([
            'name' => 'VIP RTX 4090',
            'description' => 'Processor i9, RTX 4090, 64GB RAM, 240Hz Monitor',
            'price_per_hour' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $regulerId = DB::table('pc_types')->insertGetId([
            'name' => 'Regular Battle',
            'description' => 'Processor i5, RTX 3060, 16GB RAM, 144Hz Monitor',
            'price_per_hour' => 8000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $streamId = DB::table('pc_types')->insertGetId([
            'name' => 'Streamer Room',
            'description' => 'Dual PC Setup, Mic Shure, Elgato, Webcam 4K',
            'price_per_hour' => 25000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Buat Unit PC (Massal)
        // 10 PC VIP
        for ($i = 1; $i <= 10; $i++) {
            DB::table('pcs')->insert([
                'pc_type_id' => $vipId,
                'pc_number' => 'VIP-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 20 PC Regular
        for ($i = 1; $i <= 20; $i++) {
            DB::table('pcs')->insert([
                'pc_type_id' => $regulerId,
                'pc_number' => 'REG-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Buat Data Arena
        DB::table('arenas')->insert([
            [
                'name' => 'Main Stage Arena',
                'description' => 'Panggung utama untuk Grand Final dengan layar LED raksasa.',
                'facilities' => 'Sound System 5000W, LED Wall, 10 PC Tournament, Spectator Seats',
                'capacity' => 100,
                'price_per_hour' => 1000000,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Battle Room A',
                'description' => 'Ruangan tertutup kedap suara untuk kualifikasi tim.',
                'facilities' => '10 PC Tournament, Whiteboard, Private Toilet',
                'capacity' => 15,
                'price_per_hour' => 250000,
                'status' => 'booked', // Ceritanya sedang dipakai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Battle Room B',
                'description' => 'Ruangan tertutup kedap suara untuk kualifikasi tim.',
                'facilities' => '10 PC Tournament, Whiteboard, Private Toilet',
                'capacity' => 15,
                'price_per_hour' => 250000,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Buat Data Events
        DB::table('events')->insert([
            [
                'title' => 'Valorant Major Championship',
                'description' => 'Turnamen terbesar musim ini dengan total hadiah 50 Juta Rupiah.',
                'start_date' => Carbon::now()->addDays(5),
                'end_date' => Carbon::now()->addDays(7),
                'status' => 'upcoming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mobile Legends Community Cup',
                'description' => 'Ajang kumpul komunitas MLBB regional.',
                'start_date' => Carbon::now()->subDays(1), // Kemarin
                'end_date' => Carbon::now()->addDays(1), // Besok
                'status' => 'ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
