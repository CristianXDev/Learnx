<?php

namespace Database\Factories;

use App\Models\CalificacionCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CalificacionCursoFactory extends Factory
{
    protected $model = CalificacionCurso::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'curso_id' => $this->faker->name,
			'calificacion' => $this->faker->name,
        ];
    }
}
