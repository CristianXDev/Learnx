<?php

namespace Database\Factories;

use App\Models\CursoPresencial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursoPresencialFactory extends Factory
{
    protected $model = CursoPresencial::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'image' => $this->faker->name,
			'estatus' => $this->faker->name,
			'calificacion' => $this->faker->name,
			'profesor_id' => $this->faker->name,
			'categoria_id' => $this->faker->name,
			'aula_id' => $this->faker->name,
			'fecha_ini' => $this->faker->name,
			'estudiantes_max' => $this->faker->name,
			'fecha_fin' => $this->faker->name,
        ];
    }
}
