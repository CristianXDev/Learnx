<?php

namespace Database\Factories;

use App\Models\ExamenesEntregado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenesEntregadoFactory extends Factory
{
    protected $model = ExamenesEntregado::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'examen_id' => $this->faker->name,
			'calificacion' => $this->faker->name,
			'fecha_entrega' => $this->faker->name,
			'tiempo_entrega' => $this->faker->name,
			'estatus' => $this->faker->name,
        ];
    }
}
