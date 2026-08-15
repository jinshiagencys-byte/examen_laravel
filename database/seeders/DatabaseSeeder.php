<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Emprunt;
use App\Models\Materiel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->admin()->create();

        $employees = User::factory()->count(10)->employee()->create();

        $categories = Category::factory()->count(5)->create();

        $materiels = Materiel::factory()->count(30)->create([
            'quantite_disponible' => 1,
        ]);

        foreach ($employees as $index => $employee) {
            $materiel = $materiels->random();
            $dateEmprunt = Carbon::now()->subDays($index + 1);

            Emprunt::factory()->create([
                'user_id' => $employee->id,
                'materiel_id' => $materiel->id,
                'date_emprunt' => $dateEmprunt->toDateString(),
                'date_prevue_retour' => $dateEmprunt->copy()->addDays(7)->toDateString(),
                'date_effective_retour' => $index % 2 === 0 ? $dateEmprunt->copy()->addDays(5)->toDateString() : null,
                'statut' => $index % 2 === 0 ? 'retourne' : 'en_cours',
            ]);
        }

        Emprunt::factory()->count(3)->create([
            'user_id' => $admin->id,
            'statut' => 'en_cours',
        ]);
    }
}
