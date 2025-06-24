<?php

namespace Database\Factories;

use App\Models\ActividadesCursoPresencial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActividadesCursoPresencialFactory extends Factory
{
    protected $model = ActividadesCursoPresencial::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'curso_presencial_id' => $this->faker->name,
			'aula_id' => $this->faker->name,
			'fecha_ini' => $this->faker->name,
			'fecha_fin' => $this->faker->name,
        ];
    }
}
