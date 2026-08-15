<?php

namespace Database\Factories;

use App\Models\Emprunt;
use App\Models\Materiel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpruntFactory extends Factory
{
    protected $model = Emprunt::class;

    public function definition()
    {
        $dateEmprunt = Carbon::today()->subDays($this->faker->numberBetween(1, 30));

        return [
            'user_id' => User::factory(),
            'materiel_id' => Materiel::factory(),
            'date_emprunt' => $dateEmprunt->toDateString(),
            'date_prevue_retour' => $dateEmprunt->copy()->addDays($this->faker->numberBetween(2, 14))->toDateString(),
            'date_effective_retour' => null,
            'statut' => $this->faker->randomElement(['en_cours', 'retourne']),
        ];
    }
}
