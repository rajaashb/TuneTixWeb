<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Concert;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Concert::create([
            'name' => 'Rock Fest 2025',
            'venue' => 'Seoul Stadium',
            'date' => '2025-06-15',
            'time' => '19:00',
            'price' => 50.00
        ]);

        Concert::create([
            'name' => 'K-Pop Night',
            'venue' => 'Busan Arena',
            'date' => '2025-07-10',
            'time' => '18:30',
            'price' => 75.00
        ]);
    }
}
