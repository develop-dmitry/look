<?php

namespace Database\Seeders;

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

        User::factory(5)
            ->create()
            ->each(static fn (User $user) => $user->styles()->attach($styles->random(2)));
    }
}
