<?php

namespace Database\Factories;

use App\Models\VideosCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideosCursoFactory extends Factory
{
    protected $model = VideosCurso::class;

    public function definition()
    {
        return [
			'titulo' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'vistas' => $this->faker->name,
			'like' => $this->faker->name,
			'dislike' => $this->faker->name,
			'video' => $this->faker->name,
			'curso_id' => $this->faker->name,
        ];
    }
}
