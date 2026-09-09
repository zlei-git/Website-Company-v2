<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InspirationFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence();
        $isPublished = fake()->boolean(80);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => '<p>' . implode('</p><p>', fake()->paragraphs(5)) . '</p>',
            'image' => 'inspirations/placeholder.jpg',
            'category' => fake()->randomElement(['Design Tips', 'Home Tours', 'Materials', 'Guides']),
            'author' => fake()->name(),
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'views_count' => fake()->numberBetween(0, 5000),
        ];
    }
}
