<?php

namespace Tests\Feature;

use App\Models\Escucha;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkEscuchaConUsuarioPorTelefonoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['queue.default' => 'sync']);
    }

    public function test_user_creation_links_existing_escuchas()
    {
        // Create Escucha first
        $escucha = Escucha::factory()->create(['telefono' => '+1234567890', 'id_usuario_real' => null]);

        // Create User with same phone
        $user = User::factory()->create(['telefono' => '+1234567890']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_escucha_creation_links_to_existing_user()
    {
        // Create User first
        $user = User::factory()->create(['telefono' => '+1234567890']);

        // Create Escucha with same phone
        $escucha = Escucha::factory()->create(['telefono' => '+1234567890']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_user_update_links_escuchas_when_telefono_changes()
    {
        $user = User::factory()->create(['telefono' => '+1234567890']);
        $escucha = Escucha::factory()->create(['telefono' => '+0987654321', 'id_usuario_real' => null]);

        // Update user telefono to match escucha
        $user->update(['telefono' => '+0987654321']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }

    public function test_escucha_update_links_to_user_when_telefono_changes()
    {
        $user = User::factory()->create(['telefono' => '+1234567890']);
        $escucha = Escucha::factory()->create(['telefono' => '+0987654321']);

        // Update escucha telefono to match user
        $escucha->update(['telefono' => '+1234567890']);

        $escucha->refresh();
        $this->assertEquals($user->id, $escucha->id_usuario_real);
    }
}