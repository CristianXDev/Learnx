<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'image' => $this->faker->name,
			'tipo' => $this->faker->name,
			'precio' => $this->faker->name,
			'estatus' => $this->faker->name,
			'calificacion' => $this->faker->name,
			'profesor_id' => $this->faker->name,
			'materia_id' => $this->faker->name,
			'submateria_id' => $this->faker->name,
			'categoria_id' => $this->faker->name,
        ];
    }
}
