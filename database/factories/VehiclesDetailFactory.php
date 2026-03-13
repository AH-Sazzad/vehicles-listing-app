<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Category;
use App\Models\VehiclesDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VehiclesDetail>
 */
class VehiclesDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>User::factory(),
            'category_id' =>Category::factory(),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'year' => $this->faker->year(),
            'price' => $this->faker->numberBetween(1000, 50000),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'fuel_type' => $this->faker->randomElement(['petrol', 'diesel', 'electric', 'hybrid']),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'body_type' => $this->faker->randomElement(['sedan', 'suv', 'hatchback', 'coupe']),
            'color' => $this->faker->colorName(),
            'engine_capacity' => $this->faker->numberBetween(1000, 5000),
            'image' => 'vehicles/default.jpg',
            'location' => $this->faker->city(),
            'featured' => $this->faker->boolean(),
            'views' => $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['available', 'sold']),
        ];
    }
}
