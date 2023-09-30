<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fare>
 */
class FareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->name(),
            'destination' => $this->faker->lastName(),
            'fare' => $this->faker->numberBetween(100,999),
            'status' => $this->faker->randomElement(['approve','pending','decline']),
        ];
    }
}
