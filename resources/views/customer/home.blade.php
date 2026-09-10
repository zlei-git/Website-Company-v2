@extends('layouts.customer')

@section('title', 'Nordic - Pure Hydration & Healthy Living Nutrition')

@section('content')
{{-- 1. Architectural Hero Monograph --}}
<section class="relative min-h-[85vh] flex items-end overflow-hidden no-reveal">
    {{-- Pristine Scandinavian Glacial Spring Hero Background --}}
    <img src="{{ asset('images/hero-banner.jpg') }}" 
         alt="Pristine Scandinavian Glacial Mountain Spring Water" 
         class="absolute inset-0 w-full h-full object-cover object-center scale-105 transition-transform duration-1000 ease-out">

    {{-- Natural soft atmospheric light on the left to complement dark editorial typography --}}
    <div class="absolute inset-0 bg-gradient-to-r from-white/75 via-white/30 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-white/65 via-transparent to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 pt-36 w-full">
        <div class="max-w-3xl space-y-6">
            {{-- Location & Issue Ticker --}}
            <div class="flex items-center space-x-3 text-[11px] uppercase tracking-[0.3em] text-[#7A8B6F] font-semibold">
                <span>Nordic Hydration & Nutrition</span>
                <span>•</span>
                <span>Vol. IX - 2026 Collection</span>
            </div>

            {{-- Main Architectural Headline with Crisp Charcoal Typography --}}
            <h1 class="font-serif text-4xl sm:text-6xl lg:text-7xl font-normal leading-[1.05] tracking-tight text-[#18181A]">
                Pure hydration.<br>
                <span class="italic font-light text-[#27272A]">Living nutrition.</span>
            </h1>

            <p class="text-sm sm:text-base text-[#3F3F46] font-normal max-w-xl leading-relaxed">
                Single-origin volcanic spring waters, live probiotic cultured yogurts, and certified organic plant-based milks crafted for everyday vitality.
            </p>

            <div class="pt-4 flex flex-wrap gap-4 items-center">
                <a href="{{ route('products.index') }}" class="btn-primary bg-[#18181A] text-[#FAF8F3] hover:bg-[#2E2E32] border-[#18181A]">
                    Explore Products &rarr;
                </a>
                <a href="#ritual" class="btn-secondary text-[#18181A] border-[#18181A]/50 hover:bg-[#18181A] hover:text-white">
                    The Morning Ritual
                </a>
            </div>
        </div>

        {{-- Bottom Status Strip (Clean Minimalist Line) --}}
        <div class="mt-16 pt-6 border-t border-[#18181A]/20 grid grid-cols-2 sm:grid-cols-4 gap-6 text-xs text-[#52525B]">
            <div>
                <span class="block text-[10px] uppercase tracking-widest text-[#71717A] font-semibold">Spring Origin</span>
                <span class="text-[#18181A] font-mono font-medium">Volcanic Aquifers</span>
            </div>
            <div>
                <span class="block text-[10px] uppercase tracking-widest text-[#71717A] font-semibold">Active Cultures</span>
                <span class="text-[#18181A] font-medium">Live Bifidus & Kefir</span>
            </div>
            <div>
                <span class="block text-[10px] uppercase tracking-widest text-[#71717A] font-semibold">Eco Packaging</span>
                <span class="text-[#18181A] font-medium">100% Recycled & Glass</span>
            </div>
            <div>
                <span class="block text-[10px] uppercase tracking-widest text-[#71717A] font-semibold">Cold-Chain Logistics</span>
                <span class="text-[#18181A] font-medium">Guaranteed Freshness</span>
            </div>
        </div>
    </div>
</section>

{{-- 2. Interactive "The Morning Ritual" Lookbook Experience --}}
<section class="py-24 bg-[#FAF8F3] border-b border-[#E8E4DC]" id="ritual" x-data="{ activePin: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold block mb-2">Daily Wellness Ritual</span>
                <h2 class="font-serif text-3xl sm:text-4xl text-[#18181A]">The Nordic Breakfast Table</h2>
            </div>
            <p class="text-xs sm:text-sm text-[#71717A] max-w-md mt-4 md:mt-0 font-light leading-relaxed">
                Click the interactive points to inspect the clean hydration, living probiotic yogurts, and oat milks selected for everyday health.
            </p>
        </div>

        {{-- Lookbook Interactive Canvas --}}
        <div class="relative rounded-sm overflow-hidden bg-[#EFECE6] aspect-[16/10] sm:aspect-[16/9] shadow-sm">
            <img src="{{ asset('images/breakfast-ritual.jpg') }}" 
                 alt="The Nordic Breakfast Table" 
                 class="w-full h-full object-cover">

            {{-- Pin 1: Mineral Water --}}
            <div class="absolute top-[38%] left-[19%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 1 ? null : 1)" 
                        class="hotspot-pin" 
                        title="AQUA Reflections Natural Still">
                </button>
                <div x-show="activePin === 1" @click.away="activePin = null" x-cloak
                     class="absolute bottom-9 left-1/2 -translate-x-1/2 w-52 bg-white/95 backdrop-blur-sm p-3 border border-[#E8E4DC] shadow-lg rounded-sm text-xs z-30">
                    <span class="text-[9px] uppercase tracking-wider text-[#7A8B6F] block">Natural Hydration</span>
                    <h4 class="font-serif text-sm text-[#18181A] font-semibold">AQUA Reflections Still</h4>
                    <p class="text-[#71717A] text-[11px] mt-0.5">750 ml Glass Bottle</p>
                    <div class="mt-2 pt-2 border-t border-[#E8E4DC] flex justify-between items-center">
                        <span class="font-mono text-[#18181A] font-semibold">$3.50</span>
                        <a href="{{ route('products.index', ['search' => 'Reflections']) }}" class="text-[10px] uppercase font-bold text-[#18181A] hover:underline">View Product &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Pin 2: Probiotic Yogurt --}}
            <div class="absolute top-[62%] left-[42%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 2 ? null : 2)" 
                        class="hotspot-pin" 
                        title="Activia Probiotic Wild Strawberry">
                </button>
                <div x-show="activePin === 2" @click.away="activePin = null" x-cloak
                     class="absolute bottom-9 left-1/2 -translate-x-1/2 w-52 bg-white/95 backdrop-blur-sm p-3 border border-[#E8E4DC] shadow-lg rounded-sm text-xs z-30">
                    <span class="text-[9px] uppercase tracking-wider text-[#7A8B6F] block">Live Probiotics</span>
                    <h4 class="font-serif text-sm text-[#18181A] font-semibold">Activia Wild Strawberry</h4>
                    <p class="text-[#71717A] text-[11px] mt-0.5">4 x 125 g Pots</p>
                    <div class="mt-2 pt-2 border-t border-[#E8E4DC] flex justify-between items-center">
                        <span class="font-mono text-[#18181A] font-semibold">$4.50</span>
                        <a href="{{ route('products.index', ['search' => 'Activia']) }}" class="text-[10px] uppercase font-bold text-[#18181A] hover:underline">View Product &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Pin 3: Plant-Based Oat Milk --}}
            <div class="absolute top-[32%] left-[88%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 3 ? null : 3)" 
                        class="hotspot-pin" 
                        title="Alpro Barista Organic Oat Milk">
                </button>
                <div x-show="activePin === 3" @click.away="activePin = null" x-cloak
                     class="absolute bottom-9 right-0 w-52 bg-white/95 backdrop-blur-sm p-3 border border-[#E8E4DC] shadow-lg rounded-sm text-xs z-30">
                    <span class="text-[9px] uppercase tracking-wider text-[#7A8B6F] block">Plant-Based</span>
                    <h4 class="font-serif text-sm text-[#18181A] font-semibold">Alpro Barista Oat Milk</h4>
                    <p class="text-[#71717A] text-[11px] mt-0.5">1000 ml Tetra Brik</p>
                    <div class="mt-2 pt-2 border-t border-[#E8E4DC] flex justify-between items-center">
                        <span class="font-mono text-[#18181A] font-semibold">$3.60</span>
                        <a href="{{ route('products.index', ['search' => 'Alpro']) }}" class="text-[10px] uppercase font-bold text-[#18181A] hover:underline">View Product &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. Featured Nutrition Showcase --}}
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        {{-- Left: Lead Product Monograph (7 cols) --}}
        <div class="lg:col-span-7 space-y-6">
            <div class="border-b border-[#E8E4DC] pb-4 flex items-baseline justify-between">
                <span class="text-[10px] uppercase tracking-[0.25em] text-[#71717A]">Featured Daily Essential</span>
                <span class="text-xs text-[#71717A]">Curated Purity</span>
            </div>

            @if($featuredProducts->isNotEmpty())
                @php $heroPiece = $featuredProducts->first(); @endphp
                <div class="group bg-white border border-[#E8E4DC] rounded-sm overflow-hidden flex flex-col justify-between">
                    <div class="relative aspect-[4/3] bg-[#EFECE6] overflow-hidden">
                        <img src="{{ $heroPiece->images->where('is_primary', true)->first()?->image_url ?? asset('images/products/aqua-reflections.jpg') }}" 
                             alt="{{ $heroPiece->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 text-[10px] uppercase tracking-widest font-semibold text-[#18181A]">
                            Signature Hydration
                        </div>
                    </div>
                    <div class="p-8 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
                        <div class="space-y-2">
                            <span class="text-[10px] uppercase tracking-widest text-[#7A8B6F] font-semibold">{{ $heroPiece->category->name }}</span>
                            <h3 class="font-serif text-2xl sm:text-3xl text-[#18181A]">{{ $heroPiece->name }}</h3>
                            <p class="text-xs text-[#71717A] max-w-md leading-relaxed line-clamp-2">
                                {{ $heroPiece->description }}
                            </p>
                        </div>
                        <div class="text-left sm:text-right flex-shrink-0 space-y-2">
                            <span class="font-serif text-2xl text-[#18181A] font-medium block">${{ number_format($heroPiece->price, 2) }}</span>
                            <a href="{{ route('products.show', $heroPiece->slug) }}" class="btn-primary text-[11px] py-2.5 px-4">
                                Inspect Product &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Right: Companion Stacking (5 cols) --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="border-b border-[#E8E4DC] pb-4">
                <span class="text-[10px] uppercase tracking-[0.25em] text-[#71717A]">Vital Companions</span>
            </div>

            <div class="space-y-4">
                @foreach($featuredProducts->skip(1)->take(3) as $comp)
                    <a href="{{ route('products.show', $comp->slug) }}" 
                       class="group bg-white border border-[#E8E4DC] hover:border-[#18181A] p-4 rounded-sm flex items-center gap-5 transition-all">
                        <div class="w-24 h-24 bg-[#EFECE6] flex-shrink-0 overflow-hidden rounded-sm">
                            <img src="{{ $comp->images->where('is_primary', true)->first()?->image_url ?? asset('images/products/alpro-oat-milk.jpg') }}" 
                                 alt="{{ $comp->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="flex-grow space-y-1">
                            <span class="text-[9px] uppercase tracking-wider text-[#A1A1AA]">{{ $comp->category->name }}</span>
                            <h4 class="font-serif text-base text-[#18181A] group-hover:text-[#7A8B6F] transition-colors leading-snug">{{ $comp->name }}</h4>
                            <span class="font-mono text-xs font-semibold text-[#18181A]">${{ number_format($comp->price, 2) }}</span>
                        </div>
                        <span class="text-xs text-[#A1A1AA] group-hover:text-[#18181A] group-hover:translate-x-1 transition-all">&rarr;</span>
                    </a>
                @endforeach
            </div>

            {{-- Nutrition Quote Card --}}
            <div class="bg-[#F4EFEB] p-6 rounded-sm border border-[#E8E4DC] space-y-3">
                <p class="font-serif italic text-sm text-[#27272A] leading-relaxed">
                    "Health is not sustained through deprivation, but through the daily purity of what we choose to absorb."
                </p>
                <span class="text-[10px] uppercase tracking-widest text-[#71717A] block">- Dr. Astrid Lindqvist, Head of Nutrition</span>
            </div>
        </div>
    </div>
</section>

{{-- 4. Purity & Nutrition Pillars --}}
<section class="py-20 bg-[#F4EFEB] border-y border-[#E8E4DC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
            <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold">Living Integrity</span>
            <h2 class="font-serif text-3xl sm:text-4xl text-[#18181A]">Our Nutritional Pillars</h2>
            <p class="text-xs sm:text-sm text-[#71717A] font-light leading-relaxed">
                Every bottle and pot adheres to the highest standards of natural provenance, cellular hydration, and live cultures.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('categories.show', 'waters-and-natural-hydration') }}" class="group bg-white p-6 rounded-sm border border-[#E8E4DC] hover:border-[#18181A] transition-all text-center space-y-3">
                <div class="w-16 h-16 rounded-full mx-auto bg-[#D8C3A5]/40 border border-[#D8C3A5] flex items-center justify-center text-xl">
                    💧
                </div>
                <h3 class="font-serif text-lg text-[#18181A] group-hover:text-[#7A8B6F] transition-colors">Volcanic Spring Water</h3>
                <p class="text-[11px] text-[#71717A] leading-relaxed">Filtered through ancient volcanic strata for optimal mineral balance.</p>
                <span class="text-[10px] uppercase tracking-widest font-semibold text-[#18181A] inline-block pt-1">Explore Waters &rarr;</span>
            </a>

            <a href="{{ route('categories.show', 'probiotic-dairy-and-yogurt') }}" class="group bg-white p-6 rounded-sm border border-[#E8E4DC] hover:border-[#18181A] transition-all text-center space-y-3">
                <div class="w-16 h-16 rounded-full mx-auto bg-[#EFECE6] border border-[#E8E4DC] flex items-center justify-center text-xl">
                    🥣
                </div>
                <h3 class="font-serif text-lg text-[#18181A] group-hover:text-[#7A8B6F] transition-colors">Live Active Probiotics</h3>
                <p class="text-[11px] text-[#71717A] leading-relaxed">Billions of beneficial Bifidus and kefir cultures for gut health.</p>
                <span class="text-[10px] uppercase tracking-widest font-semibold text-[#18181A] inline-block pt-1">Explore Yogurts &rarr;</span>
            </a>

            <a href="{{ route('categories.show', 'plant-based-milks-and-drinks') }}" class="group bg-white p-6 rounded-sm border border-[#E8E4DC] hover:border-[#18181A] transition-all text-center space-y-3">
                <div class="w-16 h-16 rounded-full mx-auto bg-[#C59B6D]/30 border border-[#C59B6D] flex items-center justify-center text-xl">
                    🌱
                </div>
                <h3 class="font-serif text-lg text-[#18181A] group-hover:text-[#7A8B6F] transition-colors">100% Plant-Based</h3>
                <p class="text-[11px] text-[#71717A] leading-relaxed">Sustainably farmed European oats and almonds with zero dairy lactose.</p>
                <span class="text-[10px] uppercase tracking-widest font-semibold text-[#18181A] inline-block pt-1">Explore Plant Milks &rarr;</span>
            </a>

            <a href="{{ route('categories.show', 'active-and-high-protein') }}" class="group bg-white p-6 rounded-sm border border-[#E8E4DC] hover:border-[#18181A] transition-all text-center space-y-3">
                <div class="w-16 h-16 rounded-full mx-auto bg-[#D4D4D8]/40 border border-[#D4D4D8] flex items-center justify-center text-xl">
                    ⚡
                </div>
                <h3 class="font-serif text-lg text-[#18181A] group-hover:text-[#7A8B6F] transition-colors">Active Protein & Recovery</h3>
                <p class="text-[11px] text-[#71717A] leading-relaxed">Targeted nutrition to accelerate muscular recovery and energy.</p>
                <span class="text-[10px] uppercase tracking-widest font-semibold text-[#18181A] inline-block pt-1">Explore Active &rarr;</span>
            </a>
        </div>
    </div>
</section>

{{-- 5. Curated Series Monolith Banner --}}
@if($featuredCollection)
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative bg-[#18181A] text-[#FAF8F3] rounded-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-center">
        <div class="lg:col-span-6 p-8 sm:p-16 space-y-6">
            <span class="text-[10px] uppercase tracking-[0.25em] text-[#D8C3A5] font-semibold">Featured Collection</span>
            <h2 class="font-serif text-3xl sm:text-5xl font-normal leading-tight">{{ $featuredCollection->name }}</h2>
            <p class="text-xs sm:text-sm text-[#A1A1AA] font-light leading-relaxed">
                {{ $featuredCollection->description ?? 'Single-origin still and sparkling volcanic waters bottled in sustainable glass.' }}
            </p>
            <div class="pt-2">
                <a href="{{ route('collections.show', $featuredCollection->slug) }}" class="btn-primary bg-[#FAF8F3] text-[#18181A] hover:bg-[#D8C3A5] border-[#FAF8F3]">
                    Explore the {{ $featuredCollection->name }}
                </a>
            </div>
        </div>
        <div class="lg:col-span-6 aspect-[4/3] bg-[#27272A] overflow-hidden">
            @php
                $colImg = $featuredCollection->image ?? 'images/cat-waters.jpg';
                $colImgUrl = str_starts_with($colImg, 'http') ? $colImg : asset($colImg);
            @endphp
            <img src="{{ $colImgUrl }}" 
                 alt="{{ $featuredCollection->name }}" 
                 class="w-full h-full object-cover">
        </div>
    </div>
</section>
@endif

{{-- 6. Nordic Nutrition Journal --}}
<section class="py-20 bg-white border-t border-[#E8E4DC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 border-b border-[#E8E4DC] pb-4">
            <div>
                <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold block mb-1">Publications</span>
                <h2 class="font-serif text-2xl sm:text-3xl text-[#18181A]">The Nutrition Journal</h2>
            </div>
            <a href="{{ route('inspiration.index') }}" class="text-xs uppercase tracking-widest text-[#18181A] hover:underline font-medium">
                All Articles &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($inspirations as $story)
                @php
                    $storyImg = $story->image ?? 'images/cat-waters.jpg';
                    $storyImgUrl = str_starts_with($storyImg, 'http') ? $storyImg : asset($storyImg);
                @endphp
                <article class="space-y-3 group">
                    <a href="{{ route('inspiration.show', $story->slug) }}" class="block aspect-[16/10] bg-[#EFECE6] overflow-hidden rounded-sm">
                        <img src="{{ $storyImgUrl }}" 
                             alt="{{ $story->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <span class="text-[9px] uppercase tracking-wider text-[#7A8B6F] font-semibold">{{ $story->category ?? 'Hydration Science' }}</span>
                    <h3 class="font-serif text-lg text-[#18181A] group-hover:text-[#7A8B6F] transition-colors leading-snug">
                        <a href="{{ route('inspiration.show', $story->slug) }}">{{ $story->title }}</a>
                    </h3>
                    <p class="text-xs text-[#71717A] line-clamp-2 leading-relaxed">
                        {{ $story->excerpt }}
                    </p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection