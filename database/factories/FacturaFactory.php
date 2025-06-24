<?php

namespace Database\Factories;

use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FacturaFactory extends Factory
{
    protected $model = Factura::class;

    public function definition()
    {
        return [
			'usuario_id' => $this->faker->name,
			'curso_id' => $this->faker->name,
			'codigo_ref' => $this->faker->name,
			'estatus' => $this->faker->name,
			'fecha_pago' => $this->faker->name,
        ];
    }
}
