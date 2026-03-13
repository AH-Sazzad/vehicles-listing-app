<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'image' => fake()->imageUrl(),
            'slug' => fake()->slug(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'user_id' =>User::factory(),
        ];
    }
}
