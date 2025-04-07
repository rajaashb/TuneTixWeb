<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'concert_id' => 1,
            'type' => 'VIP',
            'price' => 100.00,
            'quantity' => 50
        ]);

        Ticket::create([
            'concert_id' => 1,
            'type' => 'Regular',
            'price' => 50.00,
            'quantity' => 200
        ]);

        Ticket::create([
            'concert_id' => 2,
            'type' => 'VIP',
            'price' => 120.00,
            'quantity' => 30
        ]);
    }
}
