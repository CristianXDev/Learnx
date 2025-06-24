<?php

namespace Database\Factories;

use App\Models\InscripcionesCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InscripcionesCursoFactory extends Factory
{
    protected $model = InscripcionesCurso::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
