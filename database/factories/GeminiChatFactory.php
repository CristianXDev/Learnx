<?php

namespace Database\Factories;

use App\Models\GeminiChat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GeminiChatFactory extends Factory
{
    protected $model = GeminiChat::class;

    public function definition()
    {
        return [
			'usuario_id' => $this->faker->name,
			'pregunta' => $this->faker->name,
			'respuesta' => $this->faker->name,
        ];
    }
}
