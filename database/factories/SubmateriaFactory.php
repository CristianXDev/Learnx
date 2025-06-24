<?php

namespace Database\Factories;

use App\Models\Submateria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubmateriaFactory extends Factory
{
    protected $model = Submateria::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'materia_id' => $this->faker->name,
        ];
    }
}
