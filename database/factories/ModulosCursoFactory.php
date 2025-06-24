<?php

namespace Database\Factories;

use App\Models\ModulosCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModulosCursoFactory extends Factory
{
    protected $model = ModulosCurso::class;

    public function definition()
    {
        return [
			'titulo' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
