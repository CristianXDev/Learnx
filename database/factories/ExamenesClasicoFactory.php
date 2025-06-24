<?php

namespace Database\Factories;

use App\Models\ExamenesClasico;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenesClasicoFactory extends Factory
{
    protected $model = ExamenesClasico::class;

    public function definition()
    {
        return [
			'examen_id' => $this->faker->name,
			'pregunta' => $this->faker->name,
			'respuesta' => $this->faker->name,
        ];
    }
}
