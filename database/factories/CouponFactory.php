<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['percentage', 'fixed']);
        
        return [
            'code' => strtoupper(fake()->unique()->lexify('??????') . fake()->numerify('##')),
            'discount_type' => $type,
            'discount_value' => $type === 'percentage' ? fake()->numberBetween(5, 30) : fake()->numberBetween(10, 100),
            'min_purchase' => fake()->boolean(70) ? fake()->numberBetween(50, 200) : null,
            'max_discount' => $type === 'percentage' && fake()->boolean(50) ? fake()->numberBetween(50, 100) : null,
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+2 months'),
            'usage_limit' => fake()->boolean(50) ? fake()->numberBetween(10, 100) : null,
            'times_used' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
