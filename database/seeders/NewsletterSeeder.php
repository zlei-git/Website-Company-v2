<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 12; $i++) {
            NewsletterSubscriber::create([
                'email' => fake()->unique()->safeEmail(),
                'is_active' => true,
            ]);
        }
    }
}
