<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
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
            'driver' => $this->faker->name(),
            'destination' => $this->faker->lastName(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time('H:i'),
            'fare' => $this->faker->numberBetween(100,999),
            'jnumber' => $this->faker->numerify('###'), 
            'status' => $this->faker->randomElement(['Available','Not Available']),
        ];
    }
}
