<?php

namespace Database\Factories;

use App\Models\ClassroomUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomUserFactory extends Factory
{
    protected $model = ClassroomUser::class;

    public function definition()
    {
        return [
			'usuario_id' => $this->faker->name,
			'classroom_id' => $this->faker->name,
        ];
    }
}
