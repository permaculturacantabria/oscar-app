<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Escucha;
use App\Models\Proceso;
use App\Models\Sesion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario demo
        $user = User::factory()->create([
            'telefono' => '+34612345678',
            'email' => 'demo@example.com',
            'nombre' => 'Usuario Demo',
        ]);

        // Crear escucha demo
        $escucha = Escucha::factory()->create([
            'usuario_propietario_id' => $user->id,
            'nombre_asignado' => 'Escucha Demo',
            'telefono' => '+34687654321',
            'id_usuario_real' => null,
        ]);

        // Crear proceso demo
        $proceso = Proceso::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'nombre_proceso' => 'Proceso de Ejemplo',
        ]);

        // Crear 2 sesiones ejemplo
        Sesion::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'nombre_sesion' => 'Sesión 1',
            'modalidad' => \App\Enums\Modalidad::PRESENCIAL,
            'estado' => \App\Enums\Estado::REALIZADA,
            'tipo_sesion' => \App\Enums\TipoSesion::Libre,
            'fecha' => now()->subDays(7)->toDateString(),
            'hora' => '10:00',
            'duracion' => 60,
            'notas' => 'Notas de la primera sesión.',
            'proceso_id' => null,
        ]);

        Sesion::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'nombre_sesion' => 'Sesión 2',
            'modalidad' => \App\Enums\Modalidad::ONLINE,
            'estado' => \App\Enums\Estado::PENDIENTE,
            'tipo_sesion' => \App\Enums\TipoSesion::Proceso_10_pasos,
            'fecha' => now()->addDays(1)->toDateString(),
            'hora' => '11:00',
            'duracion' => 90,
            'notas' => 'Notas de la segunda sesión.',
            'proceso_id' => $proceso->id,
        ]);
    }
}
