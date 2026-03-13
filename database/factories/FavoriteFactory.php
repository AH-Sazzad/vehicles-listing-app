<?php

namespace Database\Factories;

use App\Models\favorite;
use App\Models\User;
use App\Models\VehiclesDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'vehicle_id' => VehiclesDetail::factory(),
        ];
    }
}
