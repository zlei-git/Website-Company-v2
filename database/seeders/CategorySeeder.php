<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Waters & Natural Hydration' => [
                'desc' => 'Pure mineral water and natural sparkling hydration sourced from protected volcanic springs.',
                'image' => 'images/cat-waters.jpg',
            ],
            'Probiotic Dairy & Yogurt' => [
                'desc' => 'Live culture fermented yogurts, Greek yogurt, and kefir to nurture your gut microbiome.',
                'image' => 'images/cat-yogurt.jpg',
            ],
            'Plant-Based Milks & Drinks' => [
                'desc' => '100% plant-based almond, oat, and coconut milks crafted for creamy daily nutrition.',
                'image' => 'images/cat-plant-milk.jpg',
            ],
            'Active & High Protein' => [
                'desc' => 'High-protein dairy yogurts and recovery shakes formulated for fitness and cellular vitality.',
                'image' => 'images/cat-protein.jpg',
            ],
            'Healthy Snacks & Bowls' => [
                'desc' => 'Organic granolas, fruit compotes, and whole grain nutrient-dense snack packs.',
                'image' => 'images/cat-snacks.jpg',
            ],
            'Specialized & Early Life' => [
                'desc' => 'Gentle toddler nutrition formulas, pediatric smoothies, and targeted clinical dietary solutions.',
                'image' => 'images/cat-specialized.jpg',
            ],
        ];

        $sort = 1;
        foreach ($categories as $name => $data) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $data['desc'],
                'image' => $data['image'],
                'status' => true,
                'sort_order' => $sort++,
            ]);
        }
    }
}