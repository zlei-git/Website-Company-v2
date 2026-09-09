<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 6; $i++) {
            Message::create([
                'name' => fake()->name(),
                'email' => fake()->safeEmail(),
                'subject' => fake()->randomElement(['Order Inquiry', 'Product Stock', 'Shipping Question', 'Feedback']),
                'message' => 'Hello, I have a question regarding one of your products. Please let me know the availability. Thanks!',
                'is_read' => rand(0, 1) === 1,
                'read_at' => null,
            ]);
        }
    }
}
