<?php

namespace Database\Seeders;

use App\Models\Clothes;
use App\Models\Style;
use Illuminate\Database\Seeder;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = Style::all();

        Clothes::factory(30)
            ->create()
            ->each(static fn(Clothes $clothes) => $clothes->styles()->attach($styles->random()));
    }
}
