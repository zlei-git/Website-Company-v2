<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->boolean(80) ? fake()->paragraph() : null,
            'is_approved' => fake()->boolean(90),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
