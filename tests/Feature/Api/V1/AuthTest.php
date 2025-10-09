<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
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

        $this->assertDatabaseHas('users', [
            'telefono' => '+34612345678',
            'email' => 'test@example.com',
            'nombre' => 'Test User',
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'telefono' => '+34612345678',
            'password' => bcrypt('password123'),
        ]);

        $data = [
            'telefono' => '+34612345678',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/v1/login', $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => ['id', 'telefono', 'email', 'nombre'],
                'token',
            ]);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Sesión cerrada correctamente']);
    }
}