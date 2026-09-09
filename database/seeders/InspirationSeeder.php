<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inspiration;
use Illuminate\Support\Str;

class InspirationSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'The Science of Deep Cellular Hydration and Natural Minerals',
                'excerpt' => 'Why drinking natural volcanic spring water with bio-available electrolytes supports cognitive clarity and sustained energy throughout your day.',
                'image' => 'images/cat-waters.jpg',
                'category' => 'Hydration Science',
                'author' => 'Dr. Astrid Lindqvist, Clinical Nutritionist',
                'content' => '<p class="text-lg leading-relaxed text-[#1E293B] font-medium">Water is not merely a thirst quencher; it is the fundamental matrix in which all biological processes occur. Optimal cellular hydration depends directly on the balance of dissolved mineral electrolytes, including magnesium, calcium, potassium, and natural bicarbonates.</p><p>When you consume natural volcanic spring water, minerals are present in ionic forms that cell membranes can assimilate with zero metabolic drag. Unlike artificially purified or distilled waters that can actually leach minerals from bodily tissues, mineral-rich glacial waters maintain cellular osmotic pressure and optimize neurotransmitter velocity.</p><h3 class="text-xl font-bold text-[#002D72] mt-8 mb-4">The Cellular Electrolyte Balance</h3><p>Studies show that even a mild 1.5% decrease in cellular water volume impairs short-term memory, elevates perceived fatigue, and compromises physical stamina. By replenishing with natural mineral waters boasting a balanced neutral pH (7.2 to 7.6), you provide your mitochondria with the electrical potential needed for sustained ATP synthesis.</p><p>Make mindful hydration your daily anchor: drink a tall glass of room-temperature volcanic spring water upon waking, followed by consistent sips between meals to keep your cellular vitality at peak performance.</p>',
            ],
            [
                'title' => 'Nurturing the Gut Microbiome: The Power of Live Probiotics',
                'excerpt' => 'Exploring how daily fermented cultured milk, Activia bifidus strains, and bio-kefir restore balance to your inner ecosystem.',
                'image' => 'images/cat-yogurt.jpg',
                'category' => 'Gut and Microbiome',
                'author' => 'Freja Møller, Gut Health Researcher',
                'content' => '<p class="text-lg leading-relaxed text-[#1E293B] font-medium">Your digestive tract hosts over 100 trillion microorganisms, an intricate ecosystem collectively known as the gut microbiome. This internal garden plays a decisive role not only in nutrient absorption, but in regulating immune defenses and mental clarity via the gut-brain axis.</p><p>Daily consumption of authentic fermented dairy and cultured yogurts introduces billions of active lactic acid bacteria (such as Bifidobacterium animalis and Lactobacillus bulgaricus). These beneficial cultures produce short-chain fatty acids (SCFAs), which fortify the intestinal barrier and reduce systemic inflammation.</p><h3 class="text-xl font-bold text-[#002D72] mt-8 mb-4">Culturing Your Daily Defense</h3><p>Unlike heat-treated or shelf-stabilized alternatives, genuine cold-chain probiotic yogurts and kefir retain living, active colony-forming units. Consumed consistently alongside prebiotic fiber from whole grains and wild berries, these strains establish colonization resistance against opportunistic pathogens.</p><p>Integrate a cup of creamy probiotic yogurt or bio-kefir into your morning routine to cultivate microbiome resilience and enjoy seamless digestive comfort all day long.</p>',
            ],
            [
                'title' => 'Crafting the Perfect Plant-Based Morning Coffee with Micro-Foam Oat Milk',
                'excerpt' => 'How whole European organic oats produce the ideal micro-bubble texture for specialty espresso without masking subtle floral flavor notes.',
                'image' => 'images/cat-plant-milk.jpg',
                'category' => 'Barista Rituals',
                'author' => 'Lars Holm, Specialty Coffee Consultant',
                'content' => '<p class="text-lg leading-relaxed text-[#1E293B] font-medium">The intersection of specialty espresso and sustainable plant-based nutrition has unlocked a new horizon for morning coffee rituals. Among all dairy alternatives, whole European organic oat milk stands apart for its naturally creamy mouthfeel and sublime steaming characteristics.</p><p>Oats contain soluble beta-glucan fibers that interact harmoniously with natural plant fats when gently heated, creating a velvety micro-foam with microscopic bubble structure. This micro-foam provides the ideal canvas for intricate latte art while preserving the natural sweetness without any added refined sugars.</p><h3 class="text-xl font-bold text-[#002D72] mt-8 mb-4">The Barista Steaming Protocol</h3><p>To achieve the pinnacle of oat milk latte perfection, steam your chilled oat milk between 58°C and 62°C. Overheating past 65°C can denature oat starches and disrupt foam elasticity. When poured over a double shot of light-roast single origin espresso, the subtle cereal sweetness complements bright floral and citrus flavor notes rather than overpowering them.</p><p>Embrace the clean, carbon-conscious morning ritual that honors both your palate and the planet.</p>',
            ],
            [
                'title' => 'Fueling Cellular Recovery: Clean Protein, Plant Sterols, and Vitality',
                'excerpt' => 'An insightful dietary protocol to enhance muscular repair, maintain healthy cholesterol levels, and fuel an active modern life.',
                'image' => 'images/cat-protein.jpg',
                'category' => 'Active Vitality',
                'author' => 'Søren Vestergaard, Performance Dietitian',
                'content' => '<p class="text-lg leading-relaxed text-[#1E293B] font-medium">Muscular repair and post-workout regeneration require more than just raw calorie surplus; they necessitate bio-available amino acids and bioactive plant compounds that temper exercise-induced oxidative stress.</p><p>Modern nutritional science highlights the efficacy of combining high-purity whey isolate with plant sterols and clean dietary fibers. This dual approach stimulates muscle protein synthesis (MPS) through high leucine concentrations while supporting healthy cardiovascular lipids and cellular membrane integrity.</p><h3 class="text-xl font-bold text-[#002D72] mt-8 mb-4">The 45-Minute Anabolic Window</h3><p>Consuming 20 to 30 grams of easily digestible clean protein within 45 minutes of strenuous exertion maximizes amino acid uptake in depleted skeletal muscle fibers. Paired with natural mineral hydration to restore lost intracellular potassium and sodium, your body shifts rapidly from catabolic breakdown to anabolic recovery.</p><p>Fuel your active lifestyle with purposeful nutrition: pure, easily assimilated protein shakes formulated without artificial fillers, sweeteners, or synthetic gums.</p>',
            ],
        ];

        foreach ($articles as $article) {
            Inspiration::updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'excerpt' => $article['excerpt'],
                    'content' => $article['content'],
                    'image' => $article['image'],
                    'category' => $article['category'],
                    'author' => $article['author'],
                    'is_published' => true,
                    'published_at' => now()->subDays(rand(2, 60)),
                    'views_count' => rand(120, 1800),
                ]
            );
        }
    }
}