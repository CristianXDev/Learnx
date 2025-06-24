<?php

namespace Database\Factories;

use App\Models\ExamenesClasicosEntregado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamenesClasicosEntregadoFactory extends Factory
{
    protected $model = ExamenesClasicosEntregado::class;

    public function definition()
    {
        return [
			'examenes_entregado_id' => $this->faker->name,
			'examen_clasico_id' => $this->faker->name,
			'respuesta' => $this->faker->name,
			'estatus' => $this->faker->name,
        ];
    }
}
