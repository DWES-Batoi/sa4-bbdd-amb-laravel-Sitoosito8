<?php

namespace Database\Factories;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    protected $model = Partit::class;

    public function definition(): array
    {
        return [
            'local_id'    => Equip::factory(),
            'visitant_id' => Equip::factory(),
            'estadi_id'   => Estadi::factory(),
            'data'        => $this->faker->dateTimeBetween('-1 years', '+1 years')->format('Y-m-d'),
            'jornada'     => $this->faker->numberBetween(1, 38),
            // formato "gols_local-gols_visitant", ejemplo "2-1"
            'gols'        => $this->faker->numberBetween(0,15) . '-' . $this->faker->numberBetween(0,15),
        ];
    }
}
