<?php

namespace Tests\Feature\Api\V1;

use App\Enums\Estado;
use App\Enums\TipoSesion;
use App\Models\Escucha;
use App\Models\Restimulacion;
use App\Models\Sesion;
use App\Models\Tema;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SesionTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_sesion_with_new_catalog_text_creates_entry_and_assigns_fk_scoped_by_user()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);

        $data = [
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'nombre_sesion' => 'Test Session',
            'tipo_sesion' => TipoSesion::INDIVIDUAL,
            'estado' => Estado::PENDIENTE,
            'fecha' => '2024-01-01',
            'hora' => '10:00',
            'duracion' => 60,
            'tema' => 'New Theme Text',
            'restimulacion' => 'New Restimulation Text',
        ];

        $response = $this->actingAs($user)->postJson('/api/v1/sesiones', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'usuario_id',
                'escucha_id',
                'nombre_sesion',
                'tema_id',
                'restimulacion_id',
            ]);

        $sesion = Sesion::find($response->json('id'));
        $this->assertNotNull($sesion->tema_id);
        $this->assertNotNull($sesion->restimulacion_id);

        // Check that catalog entries were created with correct user_id
        $tema = Tema::find($sesion->tema_id);
        $this->assertEquals('New Theme Text', $tema->texto);
        $this->assertEquals($user->id, $tema->user_id);

        $restimulacion = Restimulacion::find($sesion->restimulacion_id);
        $this->assertEquals('New Restimulation Text', $restimulacion->texto);
        $this->assertEquals($user->id, $restimulacion->user_id);
    }

    public function test_creating_sesion_with_existing_catalog_text_reuses_entry()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);

        // Create existing catalog entries
        $existingTema = Tema::factory()->create([
            'user_id' => $user->id,
            'texto' => 'Existing Theme',
        ]);

        $data = [
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
            'nombre_sesion' => 'Test Session',
            'tipo_sesion' => TipoSesion::INDIVIDUAL,
            'estado' => Estado::PENDIENTE,
            'fecha' => '2024-01-01',
            'hora' => '10:00',
            'duracion' => 60,
            'tema' => 'Existing Theme', // Same text
        ];

        $response = $this->actingAs($user)->postJson('/api/v1/sesiones', $data);

        $response->assertStatus(201);

        $sesion = Sesion::find($response->json('id'));
        $this->assertEquals($existingTema->id, $sesion->tema_id);

        // Should not create duplicate
        $this->assertEquals(1, Tema::where('user_id', $user->id)->where('texto', 'Existing Theme')->count());
    }

    public function test_user_cannot_create_sesion_for_escucha_they_dont_own()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);

        $data = [
            'usuario_id' => $user1->id,
            'escucha_id' => $escucha->id,
            'nombre_sesion' => 'Test Session',
            'tipo_sesion' => TipoSesion::INDIVIDUAL,
            'estado' => Estado::PENDIENTE,
            'fecha' => '2024-01-01',
            'hora' => '10:00',
            'duracion' => 60,
        ];

        $response = $this->actingAs($user1)->postJson('/api/v1/sesiones', $data);

        $response->assertStatus(404); // Not found because escucha doesn't belong to user
    }

    public function test_user_can_view_their_own_sesiones()
    {
        $user = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user->id]);
        $sesion = Sesion::factory()->create([
            'usuario_id' => $user->id,
            'escucha_id' => $escucha->id,
        ]);

        $response = $this->actingAs($user)->getJson('/api/v1/sesiones');

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $sesion->id]);
    }

    public function test_user_cannot_view_another_users_sesiones()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);
        $sesion = Sesion::factory()->create([
            'usuario_id' => $user2->id,
            'escucha_id' => $escucha->id,
        ]);

        $response = $this->actingAs($user1)->getJson('/api/v1/sesiones');

        $response->assertStatus(200)
            ->assertJsonMissing(['id' => $sesion->id]);
    }

    public function test_user_cannot_update_another_users_sesion()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $escucha = Escucha::factory()->create(['usuario_propietario_id' => $user2->id]);
        $sesion = Sesion::factory()->create([
            'usuario_id' => $user2->id,
            'escucha_id' => $escucha->id,
        ]);

        $updateData = ['nombre_sesion' => 'Updated Name'];

        $response = $this->actingAs($user1)->putJson("/api/v1/sesiones/{$sesion->id}", $updateData);

        $response->assertStatus(403); // Forbidden
    }
}