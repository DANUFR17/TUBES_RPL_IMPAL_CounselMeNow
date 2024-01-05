<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(40)->create();
        \App\Models\Connect::factory(100)->create();
        \App\Models\Message::factory(1500)->create();
        \App\Models\TicketOnsite::factory(500)->create();
    }
}
