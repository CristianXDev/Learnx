<?php

namespace Database\Factories;

use App\Models\ComentariosCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComentariosCursoFactory extends Factory
{
    protected $model = ComentariosCurso::class;

    public function definition()
    {
        return [
			'comentario' => $this->faker->name,
			'usuario_id' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
