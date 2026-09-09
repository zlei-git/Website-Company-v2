<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::all();

        for ($i = 0; $i < 25; $i++) {
            Review::create([
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'rating' => rand(3, 5),
                'comment' => 'Beautiful design and exceptional quality. It fits perfectly in my space. Highly recommended.',
                'is_approved' => rand(1, 10) > 2,
                'created_at' => now()->subDays(rand(1, 60)),
            ]);
        }
    }
}
