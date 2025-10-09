<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escucha>
 */
class EscuchaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_propietario_id' => \App\Models\User::factory(),
            'nombre_asignado' => fake()->name(),
            'telefono' => fake()->phoneNumber(),
            'id_usuario_real' => \App\Models\User::factory(),
        ];
    }
}
