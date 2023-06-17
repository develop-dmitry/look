<?php

namespace Database\Seeders;

use App\Models\Clothes;
use App\Models\Style;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = Style::all();
        $clothes = Clothes::limit(10000)->get();

        User::factory(5)
            ->create()
            ->each(function (User $user) use ($styles, $clothes) {
                $user->styles()->attach($styles->random(2));
                $user->clothes()->attach($clothes->random(100));
            });
    }
}
