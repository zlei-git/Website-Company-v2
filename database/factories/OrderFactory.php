<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50, 5000);
        $discount = fake()->boolean(30) ? fake()->randomFloat(2, 10, 50) : 0;
        
        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'order_number' => Order::generateOrderNumber(),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => max(0, $subtotal - $discount),
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'completed', 'completed', 'cancelled']),
            'notes' => fake()->boolean(20) ? fake()->sentence() : null,
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
