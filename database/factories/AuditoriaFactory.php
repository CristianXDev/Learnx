<?php

namespace Database\Factories;

use App\Models\Auditoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuditoriaFactory extends Factory
{
    protected $model = Auditoria::class;

    public function definition()
    {
        return [
			'usuario_id' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'fecha_accion' => $this->faker->name,
        ];
    }
}
