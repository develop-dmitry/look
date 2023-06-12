<?php

namespace Database\Factories;

use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothes>
 */
class ClothesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'slug' => $this->faker->slug(),
            'photo' => $this->faker->imageUrl()
        ];
    }
}
