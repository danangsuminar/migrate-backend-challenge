<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder yang baru kita buat
        $this->call([
            CrewSeeder::class,
            FinancialSeeder::class,
        ]);
    }
}