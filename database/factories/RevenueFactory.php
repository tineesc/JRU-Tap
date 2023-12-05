<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Revenue>
 */
class RevenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = '2023-01-01'; // Adjust the year as needed
        $endDate = '2030-12-31';

        return [
            'name' => $this->faker->name(),
            'card_id' => $this->faker->numerify('###'),
            'fare' => $this->faker->numerify('###'),
            'discount' => $this->faker->numerify('###'),
            'payment_method' => 'card',
            'status' => 'success',
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'updated_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
        ];
    }
}
