<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Jugadora;
use Illuminate\Database\Eloquent\Factories\Factory;


class JugadoraFactory extends Factory
{
    protected $model = Jugadora::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'equip_id' => Equip::factory(),
            'data_naixement' => $this->faker->date('Y-m-d', '2000-01-01'),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'foto' => $this->faker->imageUrl(300, 300, 'jugadora'),

        ];
    }
}