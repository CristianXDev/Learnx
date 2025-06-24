<?php

namespace Database\Factories;

use App\Models\VideosCompletado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideosCompletadoFactory extends Factory
{
    protected $model = VideosCompletado::class;

    public function definition()
    {
        return [
			'estudiante_id' => $this->faker->name,
			'videos_id' => $this->faker->name,
        ];
    }
}
