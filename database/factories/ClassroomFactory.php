<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomFactory extends Factory
{
    protected $model = Classroom::class;

    public function definition()
    {
        return [
			'foto' => $this->faker->name,
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'profesor_id' => $this->faker->name,
			'materia_id' => $this->faker->name,
			'codigo_acceso' => $this->faker->name,
			'estatus' => $this->faker->name,
			'tipo' => $this->faker->name,
			'max_estudiantes' => $this->faker->name,
        ];
    }
}
