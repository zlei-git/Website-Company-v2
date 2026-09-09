@extends('layouts.customer')

@section('title', 'About Us - Nordic Pure Nutrition & Natural Hydration')

@section('content')
{{-- Editorial Header --}}
<section class="py-20 border-b border-[#E5E0D8] bg-[#FAF8F3]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="text-xs uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold">Our Philosophy</span>
        <h1 class="font-serif text-4xl sm:text-6xl text-[#18181A] font-normal leading-tight">
            Rooted in Glacial Purity, Dedicated to Cellular Vitality.
        </h1>
        <p class="text-base sm:text-lg text-[#71717A] font-light leading-relaxed">
            Founded on the principle that vibrant health begins with what we absorb every morning. We unite pristine volcanic mineral spring waters, living probiotic fermentation, and certified organic plant-based nutrition.
        </p>
    </div>
</section>

{{-- Visual Hero Collage --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 mb-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="aspect-[3/4] rounded-sm overflow-hidden bg-[#EFECE6] border border-[#E8E4DC] shadow-sm">
            <img src="{{ asset('images/cat-waters.jpg') }}" alt="Pristine Volcanic Spring Waters" class="w-full h-full object-cover">
        </div>
        <div class="aspect-[3/4] rounded-sm overflow-hidden bg-[#EFECE6] border border-[#E8E4DC] shadow-md md:-mt-8">
            <img src="{{ asset('images/breakfast-ritual.jpg') }}" alt="The Nordic Morning Nutrition Table" class="w-full h-full object-cover">
        </div>
        <div class="aspect-[3/4] rounded-sm overflow-hidden bg-[#EFECE6] border border-[#E8E4DC] shadow-sm">
            <img src="{{ asset('images/cat-yogurt.jpg') }}" alt="Live Probiotic Cultured Dairy" class="w-full h-full object-cover">
        </div>
    </div>
</section>

{{-- Purity & Live Cultures --}}
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="purity">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-6">
            <span class="text-xs uppercase tracking-[0.2em] text-[#D8C3A5] font-semibold block">Living Science</span>
            <h2 class="font-serif text-3xl sm:text-4xl text-[#18181A]">Purity in Every Drop & Culture</h2>
            <p class="text-[#71717A] leading-relaxed">
                Our volcanic spring waters filter naturally across 15 years through sub-arctic basalt strata, delivering bio-available electrolytes with balanced alkalinity. Our dairy yogurts and kefirs are slow-fermented with active Bifidus strains to nurture the delicate ecosystem of your gut microbiome.
            </p>
            <div class="grid grid-cols-2 gap-6 pt-4 border-t border-[#E8E4DC]">
                <div>
                    <h4 class="font-serif text-2xl text-[#18181A] font-semibold">100%</h4>
                    <p class="text-xs uppercase tracking-wider text-[#71717A]">Single-Origin Springs</p>
                </div>
                <div>
                    <h4 class="font-serif text-2xl text-[#18181A] font-semibold">20B+</h4>
                    <p class="text-xs uppercase tracking-wider text-[#71717A]">Live Probiotic CFUs</p>
                </div>
            </div>
        </div>
        <div class="aspect-[4/3] rounded-sm overflow-hidden bg-[#EFECE6] border border-[#E8E4DC]">
            <img src="{{ asset('images/cat-protein.jpg') }}" alt="Clean High Protein Nutrition" class="w-full h-full object-cover">
        </div>
    </div>
</section>

{{-- Regenerative Stewardship --}}
<section class="py-20 bg-[#F4EFEB] border-y border-[#E8E4DC]" id="sustainability">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold">Circular Stewardship</span>
        <h2 class="font-serif text-3xl sm:text-4xl text-[#18181A]">Sustainable by Origin, Vital by Nature</h2>
        <p class="text-[#71717A] leading-relaxed font-light">
            We partner exclusively with certified organic Nordic oat growers and regenerative dairy cooperatives. Every bottle utilizes 100% recycled food-grade materials or infinitely recyclable glass, transported via certified cold-chain logistics to safeguard cellular potency and ecological balance.
        </p>
        <div class="pt-6">
            <a href="{{ route('products.index') }}" class="btn-primary">Browse Nutrition & Hydration Catalog</a>
        </div>
    </div>
</section>
@endsection
