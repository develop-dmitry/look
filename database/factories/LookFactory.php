<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Look>
 */
class LookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minTemperature = $this->faker->numberBetween(-50, 50);
        $maxTemperature = $this->faker->numberBetween($minTemperature, 50);
        $averageTemperature = $this->faker->numberBetween($minTemperature, $maxTemperature);

        return [
            'name' => $this->faker->text(20),
            'slug' => $this->faker->slug(),
            'photo' => $this->faker->imageUrl(),
            'min_temperature' => $minTemperature,
            'max_temperature' => $maxTemperature,
            'average_temperature' => $averageTemperature,
        ];
    }
}
