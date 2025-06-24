<?php

namespace Database\Factories;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TareaFactory extends Factory
{
    protected $model = Tarea::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'documento' => $this->faker->name,
			'classroom_id' => $this->faker->name,
			'fecha_inicio' => $this->faker->name,
			'fecha_entrega' => $this->faker->name,
        ];
    }
}
