<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Pure Mountain Springs & Hydration',
                'description' => 'Single-origin still and sparkling volcanic mineral waters bottled in premium recyclable glass for conscious daily living.',
                'image' => 'images/cat-waters.jpg',
            ],
            [
                'name' => 'Probiotic Microbiome Essentials',
                'description' => 'Fermented dairy yogurts, kefir, and bio-active morning shots packed with live cultures to actively nurture your gut health.',
                'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'name' => 'Plant-Based Barista & Morning Ritual',
                'description' => 'Creamy organic oat, roasted almond, and rich coconut milks tailored to pair with specialty coffee roasts and nutrient-dense bowls.',
                'image' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'name' => 'Active Performance & Daily Recovery',
                'description' => 'Clean protein shakes, cholesterol-conscious functional dairy shots, and endurance mineral ions for post-workout vitality.',
                'image' => 'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?auto=format&fit=crop&w=1000&q=80',
            ],
        ];

        $allProducts = Product::all();

        foreach ($collections as $col) {
            $created = Collection::create([
                'name' => $col['name'],
                'slug' => Str::slug($col['name']),
                'description' => $col['description'],
                'image' => $col['image'],
                'status' => true,
            ]);

            if ($allProducts->count() > 0) {
                $created->products()->attach(
                    $allProducts->random(min(6, $allProducts->count()))->pluck('id')->toArray()
                );
            }
        }
    }
}