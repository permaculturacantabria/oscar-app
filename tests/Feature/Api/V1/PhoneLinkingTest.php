<?php

namespace Tests\Feature\Api\V1;

use App\Models\Escucha;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneLinkingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['queue.default' => 'sync']);
    }

    public function test_creating_user_with_same_phone_as_existing_escucha_links_them()
    {
        // Create Escucha first
        $escucha = Escucha::factory()->create([
            'telefono' => '+34612345678',
            'id_usuario_real' => null
        ]);

        // Register User with same phone
        $data = [
            'telefono' => '+34612345678',
            'email' => 'test@example.com',
            'nombre' => 'Test User',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/v1/register', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => ['id', 'telefono', 'email', 'nombre'],
                'token',
            ]);

        $user = User::where('telefono', '+34612345678')->first();
        $this->assertNotNull($user);

        // Refresh escucha and check if linked
        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_creating_escucha_with_same_phone_as_existing_user_links_them()
    {
        // Create User first
        $user = User::factory()->create(['telefono' => '+34612345678']);

        // Create Escucha with same phone via API
        $escuchaData = [
            'usuario_propietario_id' => $user->id, // This should be the user's own ID, but for testing linking
            'nombre_asignado' => 'Test Escucha',
            'telefono' => '+34612345678',
        ];

        // Since the API requires authentication and the escucha belongs to the user,
        // let's test the linking by creating the escucha and then checking if it gets linked
        $escucha = Escucha::factory()->create([
            'usuario_propietario_id' => $user->id,
            'telefono' => '+34612345678',
        ]);

        // The linking should happen automatically via observer
        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_user_update_phone_links_existing_escuchas()
    {
        $user = User::factory()->create(['telefono' => '+34612345678']);
        $escucha = Escucha::factory()->create([
            'telefono' => '+34987654321',
            'id_usuario_real' => null
        ]);

        // Update user phone to match escucha
        $user->update(['telefono' => '+34987654321']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_escucha_update_phone_links_to_existing_user()
    {
        $user = User::factory()->create(['telefono' => '+34612345678']);
        $escucha = Escucha::factory()->create([
            'telefono' => '+34987654321',
            'id_usuario_real' => null
        ]);

        // Update escucha phone to match user
        $escucha->update(['telefono' => '+34612345678']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }
}