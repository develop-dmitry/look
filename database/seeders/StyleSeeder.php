<?php

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Style::create(['name' => 'Casual', 'slug' => 'casual']);
        Style::create(['name' => 'Деловой', 'slug' => 'business']);
        Style::create(['name' => 'Спортивный', 'slug' => 'sport']);
        Style::create(['name' => 'Минимализм', 'slug' => 'minimal']);
        Style::create(['name' => 'Military', 'slug' => 'military']);
    }
}
