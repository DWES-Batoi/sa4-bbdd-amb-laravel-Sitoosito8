<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;

class PartitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 30 partidos aleatorios
        Partit::factory()->count(30)->create();
    }
}
