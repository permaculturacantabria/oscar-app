<?php

namespace Tests\Feature\Api\V1;

use App\Enums\Estado;
use App\Enums\TipoSesion;
use App\Models\Escucha;
use App\Models\Proceso;
use App\Models\Sesion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcesoTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_proceso_creates_ten_pending_sessions_with_correct_names_and_same_user_escucha()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);

        $data = [
            'escucha_id' => $escucha->id,
            'nombre_proceso' => 'Test Process',
        ];

        $response = $this->actingAs($user)->postJson('/api/v1/procesos', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'usuario_id',
                'escucha_id',
                'nombre_proceso',
                'fecha_creacion',
                'escucha' => ['id', 'nombre_asignado'],
            ]);

        $proceso = Proceso::find($response->json('id'));
        $this->assertEquals($user->id, $proceso->usuario_id);
        $this->assertEquals($escucha->id, $proceso->escucha_id);
        $this->assertEquals('Test Process', $proceso->nombre_proceso);

        $sesiones = Sesion::where('proceso_id', $proceso->id)->orderBy('fecha')->get();
        $this->assertCount(10, $sesiones);

        $expectedEtiquetas = [
            'Tema',
            'Memorias tempranas',
            'Mensajes angustiosos',
            'Direcciones',
            'Contradicciones',
            'Contradicciones del escucha',
            'Pedacitos de realidad',
            'Restimulaciones',
            'Compromisos sociales',
            'Evaluación / Próximos pasos',
        ];

        foreach ($sesiones as $index => $sesion) {
            $this->assertEquals($user->id, $sesion->usuario_id);
            $this->assertEquals($escucha->id, $sesion->escucha_id);
            $this->assertEquals($proceso->id, $sesion->proceso_id);
            $this->assertEquals("{$expectedEtiquetas[$index]} – Test Process", $sesion->nombre_sesion);
            $this->assertEquals(TipoSesion::PROCESO_10_PASOS, $sesion->tipo_sesion);
            $this->assertEquals(Estado::PENDIENTE, $sesion->estado);
            $this->assertEquals(now()->addDays($index)->toDateString(), $sesion->fecha);
            $this->assertEquals('10:00', $sesion->hora);
            $this->assertEquals(60, $sesion->duracion);
        }
    }

    public function test_user_cannot_create_proceso_for_escucha_they_dont_own()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);

        $data = [
            'escucha_id' => $escucha->id,
            'nombre_proceso' => 'Test Process',
        ];

        $response = $this->actingAs($user1)->postJson('/api/v1/procesos', $data);

        $response->assertStatus(404); // Not found because escucha doesn't belong to user
    }

    public function test_user_can_view_their_own_procesos()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);
        $proceso = Proceso::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
        ]);

        $response = $this->actingAs($user)->getJson('/api/v1/procesos');

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $proceso->id]);
    }

    public function test_user_cannot_view_another_users_procesos()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);
        $proceso = Proceso::factory()->create([
            'usuario_id' => $user2->id,
            'escucha_id' => $escucha->id,
        ]);

        $response = $this->actingAs($user1)->getJson('/api/v1/procesos');

        $response->assertStatus(200)
            ->assertJsonMissing(['id' => $proceso->id]);
    }

    public function test_user_can_view_proceso_sesiones()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);
        $proceso = Proceso::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
        ]);
        $sesion = Sesion::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'proceso_id' => $proceso->id,
        ]);

        $response = $this->actingAs($user)->getJson("/api/v1/procesos/{$proceso->id}/sesiones");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $sesion->id]);
    }

    public function test_user_cannot_view_another_users_proceso_sesiones()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);
        $proceso = Proceso::factory()->create([
            'usuario_id' => $user2->id,
            'escucha_id' => $escucha->id,
        ]);

        $response = $this->actingAs($user1)->getJson("/api/v1/procesos/{$proceso->id}/sesiones");

        $response->assertStatus(403); // Forbidden
    }
}