<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Circle>
 */
class CircleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->userName(),
            'activity_content' => $this->faker->realText(30),
            'member_count' => $this->faker->numberBetween(5, 50),
            'activity_fee' => $this->faker->numberBetween(500, 5000),
            'activity_time' => $this->faker->dateTime(),
            'activity_location' => $this->faker->realText(20),
            'how_to_join' => $this->faker->url(),
            'sns' => $this->faker->realText(15),
            'free_text' => $this->faker->realText(100)
        ];
    }
}
