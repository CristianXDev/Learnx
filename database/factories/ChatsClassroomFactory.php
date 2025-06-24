<?php

namespace Database\Factories;

use App\Models\ChatsClassroom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ChatsClassroomFactory extends Factory
{
    protected $model = ChatsClassroom::class;

    public function definition()
    {
        return [
			'classroom_id' => $this->faker->name,
			'usuario_id' => $this->faker->name,
			'mensaje' => $this->faker->name,
			'documento' => $this->faker->name,
        ];
    }
}
