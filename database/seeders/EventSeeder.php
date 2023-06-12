<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create(['name' => 'Отдых на природе', 'slug' => 'outdoor-recreation']);
        Event::create(['name' => 'Свидание', 'slug' => 'meeting']);
        Event::create(['name' => 'Прогулка по парку', 'slug' => 'walking-on-park']);
        Event::create(['name' => 'На работа', 'slug' => 'work']);
        Event::create(['name' => 'На учебу', 'slug' => 'study']);
    }
}
