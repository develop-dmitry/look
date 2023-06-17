<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createEvent('Отдых на природе', 'outdoor-recreation');
        $this->createEvent('Свидание', 'meeting');
        $this->createEvent('Прогулка по парку', 'walking-on-park');
        $this->createEvent('На работа', 'work');
        $this->createEvent('На учебу', 'study');
    }

    public function createEvent(string $name, string $slug): void
    {
        try {
            Event::create(['name' => $name, 'slug' => $slug]);
        } catch (QueryException) {
        }
    }
}
