<?php

namespace Tests\Unit;

use App\Models\Tema;
use App\Models\User;
use App\Services\UpsertCatalogoEnSesion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpsertCatalogoEnSesionTest extends TestCase
{
    use RefreshDatabase;

    public function test_upserts_catalog_entries_and_returns_fk_data()
    {
        $user = User::factory()->create();
        $userId = $user->id;
        $data = [
            'tema' => 'Test Theme',
            'memoria_temprana' => 'Test Memory',
        ];

        $fkData = UpsertCatalogoEnSesion::upsert($data, $userId);

        $this->assertArrayHasKey('tema_id', $fkData);
        $this->assertArrayHasKey('memoria_temprana_id', $fkData);

        $tema = Tema::find($fkData['tema_id']);
        $this->assertEquals('Test Theme', $tema->texto);
        $this->assertEquals($userId, $tema->user_id);
    }

    public function test_idempotent_upsert_does_not_create_duplicates()
    {
        $user = User::factory()->create();
        $userId = $user->id;
        $data = [
            'tema' => 'Test Theme',
        ];

        // First upsert
        $fkData1 = UpsertCatalogoEnSesion::upsert($data, $userId);
        $tema1 = Tema::find($fkData1['tema_id']);

        // Second upsert with same data
        $fkData2 = UpsertCatalogoEnSesion::upsert($data, $userId);
        $tema2 = Tema::find($fkData2['tema_id']);

        // Should be the same record
        $this->assertEquals($fkData1['tema_id'], $fkData2['tema_id']);
        $this->assertEquals(1, Tema::where('user_id', $userId)->where('texto', 'Test Theme')->count());
    }

    public function test_ignores_fields_not_in_data()
    {
        $user = User::factory()->create();
        $userId = $user->id;
        $data = [
            'tema' => 'Test Theme',
        ];

        $fkData = UpsertCatalogoEnSesion::upsert($data, $userId);

        $this->assertArrayHasKey('tema_id', $fkData);
        $this->assertArrayNotHasKey('memoria_temprana_id', $fkData);
    }
}