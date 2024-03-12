<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViewLog>
 */
class ViewLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'circle_id' => $this->faker->numberBetween(1, 25),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-3 week', $endDate='now'),
        ];
    }
}
