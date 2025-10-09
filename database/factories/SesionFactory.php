<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sesion>
 */
class SesionFactory extends Factory
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
            'nombre_sesion' => fake()->sentence(),
            'modalidad' => fake()->randomElement(\App\Enums\Modalidad::cases()),
            'estado' => fake()->randomElement(\App\Enums\Estado::cases()),
            'tipo_sesion' => fake()->randomElement(\App\Enums\TipoSesion::cases()),
            'fecha' => fake()->date(),
            'hora' => fake()->time('H:i'),
            'duracion' => fake()->numberBetween(30, 120),
            'notas' => fake()->paragraph(),
            'evaluacion_1' => fake()->numberBetween(1, 10),
            'evaluacion_2' => fake()->numberBetween(1, 10),
            'descarga_dominante' => fake()->randomElement(\App\Enums\DescargaDominante::cases()),
            'proceso_id' => \App\Models\Proceso::factory(),
        ];
    }
}
