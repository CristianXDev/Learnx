<?php

namespace Database\Factories;

use App\Models\TareasEntregada;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TareasEntregadaFactory extends Factory
{
    protected $model = TareasEntregada::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'tarea_id' => $this->faker->name,
			'documento' => $this->faker->name,
			'fecha_entrega' => $this->faker->name,
			'calificacion' => $this->faker->name,
        ];
    }
}
