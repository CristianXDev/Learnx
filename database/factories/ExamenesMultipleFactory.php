<?php

namespace Database\Factories;

use App\Models\ExamenesMultiple;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenesMultipleFactory extends Factory
{
    protected $model = ExamenesMultiple::class;

    public function definition()
    {
        return [
			'examen_id' => $this->faker->name,
			'pregunta' => $this->faker->name,
			'respuesta_1' => $this->faker->name,
			'respuesta_2' => $this->faker->name,
			'respuesta_3' => $this->faker->name,
			'respuesta_4' => $this->faker->name,
        ];
    }
}
