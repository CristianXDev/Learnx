<?php

namespace Database\Factories;

use App\Models\QuizCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuizCursoFactory extends Factory
{
    protected $model = QuizCurso::class;

    public function definition()
    {
        return [
			'pregunta' => $this->faker->name,
			'respuesta_1' => $this->faker->name,
			'respuesta_2' => $this->faker->name,
			'respuesta_3' => $this->faker->name,
			'respuesta_4' => $this->faker->name,
			'modulo_id' => $this->faker->name,
        ];
    }
}
