<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Materiel;
use App\Models\Category;
use App\Models\Emprunt;

class EmpruntTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_emprunt_and_return(): void
    {
        $admin = User::factory()->admin()->create();
        $employee = User::factory()->employee()->create();
        $category = Category::factory()->create();
        $materiel = Materiel::factory()->create(['quantite_disponible' => 1, 'category_id' => $category->id, 'etat' => 'disponible']);

        // Create emprunt as employee
        $this->actingAs($employee);

        $response = $this->postJson('/api/emprunts', [
            'materiel_id' => $materiel->id,
            'date_emprunt' => now()->toDateString(),
            'date_prevue_retour' => now()->addDays(3)->toDateString(),
        ]);

        $response->assertStatus(201);
        $empruntId = $response->json('id');

        $this->assertDatabaseHas('emprunts', ['id' => $empruntId, 'statut' => 'en_cours']);
        $this->assertDatabaseHas('materiels', ['id' => $materiel->id, 'quantite_disponible' => 0]);

        // Return emprunt
        $response = $this->postJson("/api/emprunts/{$empruntId}/return", [
            'date_effective_retour' => now()->addDays(2)->toDateString(),
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('emprunts', ['id' => $empruntId, 'statut' => 'retourne']);
        $this->assertDatabaseHas('materiels', ['id' => $materiel->id, 'quantite_disponible' => 1]);
    }
}
