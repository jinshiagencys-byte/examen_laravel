<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Materiel;

class MaterielCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_update_delete_materiel(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $this->actingAs($admin);

        // Create
        $response = $this->postJson('/api/materiels', [
            'category_id' => $category->id,
            'nom' => 'Test Materiel',
            'description' => 'Desc',
            'numero_serie' => 'SN-1234',
            'quantite_disponible' => 2,
            'etat' => 'disponible',
        ]);

        $response->assertStatus(201)->assertJsonFragment(['nom' => 'Test Materiel']);
        $materielId = $response->json('id');

        // Update
        $response = $this->putJson("/api/materiels/{$materielId}", [
            'quantite_disponible' => 5,
        ]);
        $response->assertStatus(200)->assertJsonFragment(['quantite_disponible' => 5]);

        // Delete
        $response = $this->deleteJson("/api/materiels/{$materielId}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('materiels', ['id' => $materielId]);
    }
}
