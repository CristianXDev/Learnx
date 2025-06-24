<?php

namespace Database\Factories;

use App\Models\ExamenesMultiplesEntregado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenesMultiplesEntregadoFactory extends Factory
{
    protected $model = ExamenesMultiplesEntregado::class;

    public function definition()
    {
        return [
			'examen_entregado_id' => $this->faker->name,
			'pregunta' => $this->faker->name,
			'respuesta_1' => $this->faker->name,
			'respuesta_2' => $this->faker->name,
			'respuesta_3' => $this->faker->name,
			'respuesta_4' => $this->faker->name,
        ];
    }
}
