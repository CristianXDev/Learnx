<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
        ];
    }
}
