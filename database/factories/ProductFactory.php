<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraphs(3, true),
            'material' => fake()->randomElement(['Oak Wood', 'Walnut Wood', 'Pine Wood', 'Ash Wood', 'Birch Wood', 'Linen', 'Cotton']),
            'dimensions' => fake()->numberBetween(50, 200) . 'x' . fake()->numberBetween(50, 200) . 'x' . fake()->numberBetween(50, 100) . ' cm',
            'colors' => json_encode([fake()->safeColorName(), fake()->safeColorName()]),
            'price' => fake()->randomFloat(2, 99, 2499),
            'stock' => fake()->numberBetween(0, 50),
            'sku' => strtoupper(Str::random(8)),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'draft']),
            'is_featured' => fake()->boolean(20),
            'views_count' => fake()->numberBetween(0, 1000),
        ];
    }
}
