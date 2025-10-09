<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proceso>
 */
class ProcesoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => \App\Models\User::factory(),
            'escucha_id' => \App\Models\Escucha::factory(),
            'nombre_proceso' => fake()->sentence(),
            'fecha_creacion' => now(),
        ];
    }
}
