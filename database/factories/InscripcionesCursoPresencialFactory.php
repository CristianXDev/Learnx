<?php

namespace Database\Factories;

use App\Models\InscripcionesCursoPresencial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InscripcionesCursoPresencialFactory extends Factory
{
    protected $model = InscripcionesCursoPresencial::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
