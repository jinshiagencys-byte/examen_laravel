<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->randomElement([
                'Ordinateurs',
                'Périphériques',
                'Réseau',
                'Audio et Vidéo',
                'Accessoires',
                'Téléphonie',
            ]),
            'description' => $this->faker->sentence(8),
        ];
    }
}
