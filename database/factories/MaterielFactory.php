<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterielFactory extends Factory
{
    protected $model = Materiel::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'nom' => $this->faker->randomElement([
                'Laptop Dell Latitude',
                'Laptop HP EliteBook',
                'Moniteur 24 pouces',
                'Clé USB 32 Go',
                'Imprimante Laser',
                'Souris sans fil',
                'Casque USB',
                'Ordinateur fixe',
                'Routeur WiFi',
                'Switch réseau',
                'Caméra Web',
                'Projecteur Full HD',
            ]),
            'description' => $this->faker->sentence(8),
            'numero_serie' => strtoupper($this->faker->bothify('SN-####??')),
            'quantite_disponible' => $this->faker->numberBetween(0, 5),
            'etat' => $this->faker->randomElement(['disponible', 'en_maintenance', 'hors_service']),
        ];
    }
}
