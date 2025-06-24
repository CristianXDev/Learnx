<?php

namespace Database\Factories;

use App\Models\QuizCursoEntregado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuizCursoEntregadoFactory extends Factory
{
    protected $model = QuizCursoEntregado::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'modulo_id' => $this->faker->name,
			'fecha_entrega' => $this->faker->name,
			'estatus' => $this->faker->name,
        ];
    }
}
