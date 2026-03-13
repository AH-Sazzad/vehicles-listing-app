<?php

namespace Database\Seeders;
use App\Models\VehiclesDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiclesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehiclesDetail::factory(50)->create();
    }
}
