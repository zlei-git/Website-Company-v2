<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'image_path' => 'products/placeholder_' . fake()->numberBetween(1, 5) . '.jpg',
            'is_primary' => false,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
