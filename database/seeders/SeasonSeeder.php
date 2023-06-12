<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::create(['name' => 'Зима', 'slug' => 'winter']);
        Season::create(['name' => 'Весна', 'slug' => 'spring']);
        Season::create(['name' => 'Лето', 'slug' => 'summer']);
        Season::create(['name' => 'Осень', 'slug' => 'autumn']);
    }
}
