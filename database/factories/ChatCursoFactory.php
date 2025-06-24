<?php

namespace Database\Factories;

use App\Models\ChatCurso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ChatCursoFactory extends Factory
{
    protected $model = ChatCurso::class;

    public function definition()
    {
        return [
			'curso_id' => $this->faker->name,
			'usuario_id' => $this->faker->name,
			'mensaje' => $this->faker->name,
			'documento' => $this->faker->name,
        ];
    }
}
