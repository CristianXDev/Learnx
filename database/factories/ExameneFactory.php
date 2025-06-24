<?php

namespace Database\Factories;

use App\Models\Examene;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExameneFactory extends Factory
{
    protected $model = Examene::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'tipo' => $this->faker->name,
			'fecha_inicio' => $this->faker->name,
			'fecha_fin' => $this->faker->name,
			'lim_tiempo' => $this->faker->name,
			'estatus' => $this->faker->name,
			'materia_id' => $this->faker->name,
			'submateria_id' => $this->faker->name,
			'classroom_id' => $this->faker->name,
        ];
    }
}
