<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,  // Génère un titre fictif
            'body' => $this->faker->paragraph,  // Génère un corps de texte fictif
            'user_id' => User::factory(),       // Associe un utilisateur fictif
        ];
    }
}
