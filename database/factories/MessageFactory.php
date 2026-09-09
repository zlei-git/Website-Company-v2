<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
            'is_read' => fake()->boolean(60),
            'read_at' => null,
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
