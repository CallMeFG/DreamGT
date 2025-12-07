<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Event 1: Sedang Berjalan
        Event::create([
            'title' => 'Valorant Community Cup S5',
            'description' => 'Turnamen 5v5 komunitas lokal. Mode: Standard. Map Pool: All Maps.',
            'start_date' => Carbon::now()->subDays(2),
            'end_date' => Carbon::now()->addDays(5),
            'status' => 'ongoing', // ongoing, upcoming, completed
        ]);

        // Event 2: Akan Datang
        Event::create([
            'title' => 'Mobile Legends: Bang Bang Rookie',
            'description' => 'Khusus untuk tim amatir. Buktikan skill kalian dan raih total hadiah 5 Juta Rupiah.',
            'start_date' => Carbon::now()->addWeeks(1),
            'end_date' => Carbon::now()->addWeeks(1)->addDays(2),
            'status' => 'upcoming',
        ]);

        // Event 3: Akan Datang (Jauh)
        Event::create([
            'title' => 'FIFA 25 Solo King',
            'description' => '1v1 Knockout Stage. PS5 Platform. Bawa controller sendiri diperbolehkan.',
            'start_date' => Carbon::now()->addWeeks(3),
            'end_date' => Carbon::now()->addWeeks(3)->addDays(1),
            'status' => 'upcoming',
        ]);
    }
}