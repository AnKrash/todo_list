<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'status' => fake()->randomElement(['todo', 'done']),
            'priority' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeThisMonth(),
            'completed_at' => fake()->optional()->dateTimeThisMonth(),
        ];
    }
}
