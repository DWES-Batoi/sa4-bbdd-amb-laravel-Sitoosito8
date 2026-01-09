<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugadora;

class JugadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 20 jugadoras con equipos aleatorios
        Jugadora::factory()->count(20)->create();
    }
}
