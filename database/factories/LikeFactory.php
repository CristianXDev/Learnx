<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
			'like' => $this->faker->name,
			'dislike' => $this->faker->name,
			'estudiante_id' => $this->faker->name,
			'video_id' => $this->faker->name,
        ];
    }
}
