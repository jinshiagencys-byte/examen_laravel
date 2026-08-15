<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement(['administrateur', 'employe']),
            'statut' => 'active',
            'password_set' => true,
        ];
    }

    public function admin()
    {
        return $this->state([
            'nom' => 'Administrateur',
            'email' => 'admin@examen.test',
            'password' => Hash::make('admin123'),
            'role' => 'administrateur',
            'statut' => 'active',
            'password_set' => true,
        ]);
    }

    public function employee()
    {
        return $this->state([
            'role' => 'employe',
            'statut' => 'active',
        ]);
    }
}
