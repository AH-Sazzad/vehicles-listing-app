<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Favorite;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorite::factory(500) ->create();
    }
}
