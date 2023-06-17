<?php

namespace Database\Seeders;

use App\Models\Clothes;
use App\Models\Event;
use App\Models\Look;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clothes = Clothes::inRandomOrder()->limit(1000)->get();
        $events = Event::all();

        Look::factory(10)
            ->create()
            ->each(static function (Look $look) use ($clothes, $events) {
                $look->clothes()->attach($clothes->random(4));
                $look->events()->attach($events->random(2));
            });
    }
}
