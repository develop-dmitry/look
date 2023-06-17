<?php

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createStyle('Casual', 'casual');
        $this->createStyle('Деловой', 'business');
        $this->createStyle('Спортивный', 'sport');
        $this->createStyle('Минимализм', 'minimal');
        $this->createStyle('Military', 'military');
    }

    protected function createStyle(string $name, string $slug): void
    {
        try {
            Style::create(['name' => $name, 'slug' => $slug]);
        } catch (QueryException) {
        }
    }
}
