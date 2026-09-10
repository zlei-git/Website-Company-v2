<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        // Map product slugs to their local image files
        // Products with AI-generated packshots get their own image
        // Others reuse a similar product's image from the same category
        $productImageMap = [
            // Waters & Natural Hydration
            'aqua-reflections-natural-still' => 'products/aqua-reflections.jpg',
            'evian-french-alps-natural-spring-water' => 'products/evian-spring.jpg',
            'volvic-touch-of-fruit-lemon-lime' => 'products/volvic-lemon-lime.jpg',
            'aqua-sparkling-mineral-infusion' => 'products/aqua-sparkling.jpg',
            'nordic-glacier-pure-electrolyte-water' => 'products/nordic-glacier.jpg',

            // Probiotic Dairy & Yogurt
            'activia-probiotic-wild-strawberry' => 'products/activia-strawberry.jpg',
            'activia-zero-greek-style-natural-yogurt' => 'products/activia-greek.jpg',
            'danone-oikos-triple-zero-vanilla-greek-yogurt' => 'products/oikos-vanilla.jpg',
            'actimel-daily-immunity-shot-mixed-berries' => 'products/actimel-berries.jpg',
            'nordic-bio-kefir-traditional-cultured-milk' => 'products/nordic-kefir.jpg',

            // Plant-Based Milks & Drinks
            'alpro-barista-organic-oat-milk' => 'products/alpro-oat-milk.jpg',
            'alpro-roasted-almond-unsweetened-milk' => 'products/alpro-almond-milk.jpg',
            'silk-organic-creamy-soymilk' => 'products/silk-soymilk.jpg',
            'alpro-coconut-almond-refresh-drink' => 'products/alpro-coconut-almond.jpg',
            'nordic-cold-pressed-golden-oat-latte' => 'products/alpro-oat-milk.jpg',

            // Active & High Protein (reuse similar for non-generated)
            'danone-hipro-25g-protein-shake-chocolate' => 'products/actimel-berries.jpg',
            'danone-hipro-20g-protein-pudding-caramel' => 'products/oikos-vanilla.jpg',
            'danacol-plant-sterol-cardiovascular-shot' => 'products/actimel-berries.jpg',
            'nordic-clean-whey-recovery-strawberry-cream' => 'products/activia-strawberry.jpg',
            'nordic-performance-electrolyte-fizz-tablets' => 'products/nordic-glacier.jpg',

            // Healthy Snacks & Bowls (reuse similar)
            'artisanal-nordic-honey-granola-crunch' => 'products/alpro-oat-milk.jpg',
            'organic-acai-berry-chia-breakfast-bowl' => 'products/activia-strawberry.jpg',
            'alpro-plant-based-vanilla-soya-dessert' => 'products/oikos-vanilla.jpg',
            'scandinavian-rye-seed-crispbread' => 'products/alpro-almond-milk.jpg',
            'nordic-wild-lingonberry-apple-compote' => 'products/activia-strawberry.jpg',

            // Specialized & Early Life (reuse similar)
            'bebelac-nutri-step-toddler-formula-3' => 'products/oikos-vanilla.jpg',
            'aptamil-profutura-organic-follow-on-formula' => 'products/silk-soymilk.jpg',
            'fortimel-plant-based-complete-clinical-shake' => 'products/alpro-oat-milk.jpg',
            'organic-puree-pouch-nordic-pear-raspberry' => 'products/activia-strawberry.jpg',
            'nutricia-neocate-lcp-hypoallergenic-formula' => 'products/silk-soymilk.jpg',
        ];

        // Category fallback pools for secondary images
        $categoryFallback = [
            'water' => [
                'products/aqua-reflections.jpg',
                'products/evian-spring.jpg',
                'products/volvic-lemon-lime.jpg',
                'products/aqua-sparkling.jpg',
                'products/nordic-glacier.jpg',
            ],
            'dairy' => [
                'products/activia-strawberry.jpg',
                'products/activia-greek.jpg',
                'products/oikos-vanilla.jpg',
                'products/actimel-berries.jpg',
                'products/nordic-kefir.jpg',
            ],
            'plant' => [
                'products/alpro-oat-milk.jpg',
                'products/alpro-almond-milk.jpg',
                'products/silk-soymilk.jpg',
                'products/alpro-coconut-almond.jpg',
            ],
            'protein' => [
                'products/actimel-berries.jpg',
                'products/nordic-glacier.jpg',
                'products/oikos-vanilla.jpg',
                'products/activia-strawberry.jpg',
            ],
            'snack' => [
                'products/alpro-oat-milk.jpg',
                'products/alpro-almond-milk.jpg',
                'products/activia-strawberry.jpg',
                'products/oikos-vanilla.jpg',
            ],
            'special' => [
                'products/silk-soymilk.jpg',
                'products/oikos-vanilla.jpg',
                'products/alpro-oat-milk.jpg',
            ],
        ];

        ProductImage::truncate();

        foreach ($products as $product) {
            $slug = $product->slug;
            $catSlug = $product->category->slug ?? '';

            // Determine primary image
            $primaryImage = $productImageMap[$slug] ?? null;
            if (!$primaryImage) {
                $pool = $this->getCategoryPool($catSlug, $categoryFallback);
                $primaryImage = $pool[$product->id % count($pool)];
            }

            $info = pathinfo($primaryImage);
            $basePath = $info['dirname'] . '/' . $info['filename'];

            // 1. Primary Studio Packshot
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $basePath . '.jpg',
                'is_primary' => true,
                'sort_order' => 0,
            ]);

            // 2. Macro Detail Angle
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $basePath . '-detail.jpg',
                'is_primary' => false,
                'sort_order' => 1,
            ]);

            // 3. Lifestyle / Context Angle
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $basePath . '-lifestyle.jpg',
                'is_primary' => false,
                'sort_order' => 2,
            ]);
        }
    }

    private function getCategoryPool(string $catSlug, array $pools): array
    {
        if (str_contains($catSlug, 'water')) return $pools['water'];
        if (str_contains($catSlug, 'dairy') || str_contains($catSlug, 'yogurt')) return $pools['dairy'];
        if (str_contains($catSlug, 'plant')) return $pools['plant'];
        if (str_contains($catSlug, 'protein') || str_contains($catSlug, 'active')) return $pools['protein'];
        if (str_contains($catSlug, 'snack') || str_contains($catSlug, 'bowl')) return $pools['snack'];
        return $pools['special'];
    }
}