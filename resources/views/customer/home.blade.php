@extends('layouts.customer')

@section('title', 'Danone Store - Toko Resmi Produk Danone Indonesia')

@section('content')
{{-- 1. Danone Official Store Hero --}}
<section class="relative min-h-[80vh] flex items-end overflow-hidden no-reveal bg-[#F0F9FF]">
    {{-- Natural Pure Hydration & Vitality Background --}}
    <img src="https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&w=1920&q=85" 
         alt="Danone Pure Hydration and Nutrition" 
         class="absolute inset-0 w-full h-full object-cover object-center scale-105 transition-transform duration-1000 ease-out opacity-90">

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-r from-white/90 via-white/60 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-transparent to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-32 w-full">
        <div class="max-w-2xl space-y-5">
            {{-- Official Store Badge --}}
            <div class="inline-flex items-center space-x-2 text-xs uppercase tracking-wider text-[#0072CE] font-bold px-3 py-1 bg-white/90 rounded-full shadow-xs">
                <span>✓ Toko Resmi Danone Indonesia</span>
            </div>

            {{-- Main Headline --}}
            <h1 class="font-bold text-4xl sm:text-6xl lg:text-7xl leading-[1.1] tracking-tight text-[#002D72]">
                Nutrisi Terbaik.<br>
                <span class="text-[#0072CE]">Hidrasi Alami.</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-700 font-normal max-w-lg leading-relaxed">
                Belanja produk AQUA, Evian, Activia, Bebelac, SGM, dan Alpro langsung dari toko resmi. 100% produk asli dengan jaminan standar mutu internasional.
            </p>

            <div class="pt-4 flex flex-wrap gap-4 items-center">
                <a href="{{ route('products.index') }}" class="py-3 px-8 bg-[#0072CE] hover:bg-[#002D72] text-white font-bold text-sm rounded-full shadow-md transition-all">
                    Belanja Sekarang &rarr;
                </a>
                <a href="{{ route('categories.index') }}" class="py-3 px-8 bg-white hover:bg-slate-50 text-[#002D72] font-bold text-sm rounded-full border border-[#002D72]/20 hover:border-[#002D72] shadow-xs transition-all">
                    Lihat Kategori
                </a>
            </div>
        </div>

        {{-- Trust Badges Strip --}}
        <div class="mt-14 pt-6 border-t border-[#002D72]/15 grid grid-cols-2 sm:grid-cols-4 gap-6 text-xs text-slate-700">
            <div class="flex items-center space-x-3">
                <span class="text-2xl">🛡️</span>
                <div>
                    <span class="block text-[11px] font-bold text-[#002D72] uppercase tracking-wide">Produk 100% Asli</span>
                    <span class="text-slate-500 text-[11px]">Langsung dari Danone</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-2xl">🚚</span>
                <div>
                    <span class="block text-[11px] font-bold text-[#002D72] uppercase tracking-wide">Gratis Ongkir</span>
                    <span class="text-slate-500 text-[11px]">Min. Belanja Rp200rb</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-2xl">💳</span>
                <div>
                    <span class="block text-[11px] font-bold text-[#002D72] uppercase tracking-wide">Pembayaran Aman</span>
                    <span class="text-slate-500 text-[11px]">Transfer Bank & E-Wallet</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-2xl">🔄</span>
                <div>
                    <span class="block text-[11px] font-bold text-[#002D72] uppercase tracking-wide">Garansi Resmi</span>
                    <span class="text-slate-500 text-[11px]">Jaminan Kualitas 7 Hari</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. Danone Family Nutrition Ritual --}}
<section class="py-20 bg-white border-b border-[#E2E8F0]" id="ritual" x-data="{ activePin: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
            <div>
                <span class="text-[11px] uppercase tracking-[0.2em] text-[#0072CE] font-bold block mb-1.5">Pilihan Nutrisi Harian</span>
                <h2 class="font-bold text-3xl sm:text-4xl text-[#002D72]">Nutrisi & Hidrasi Keluarga</h2>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mt-4 md:mt-0 leading-relaxed">
                Klik titik interaktif pada produk untuk melihat detail manfaat air mineral pegunungan alami, yogurt probiotik, dan minuman bernutrisi Danone.
            </p>
        </div>

        {{-- Interactive Canvas --}}
        <div class="relative rounded-2xl overflow-hidden bg-slate-100 aspect-[16/10] sm:aspect-[16/9] shadow-sm">
            <img src="https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&w=1600&q=80" 
                 alt="Nutrisi dan Hidrasi Danone" 
                 class="w-full h-full object-cover">

            {{-- Pin 1: Mineral Water --}}
            <div class="absolute top-[38%] left-[19%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 1 ? null : 1)" 
                        class="hotspot-pin w-8 h-8 rounded-full bg-[#0072CE] text-white flex items-center justify-center font-bold text-xs shadow-lg animate-pulse" 
                        title="AQUA Reflections">
                    +
                </button>
                <div x-show="activePin === 1" @click.away="activePin = null" x-cloak
                     class="absolute bottom-10 left-1/2 -translate-x-1/2 w-60 bg-white p-4 border border-[#E2E8F0] shadow-xl rounded-xl text-xs z-30">
                    <span class="text-[10px] uppercase tracking-wider text-[#0072CE] font-bold block">Air Mineral Alami</span>
                    <h4 class="text-sm text-[#002D72] font-bold mt-1">AQUA Reflections Still</h4>
                    <p class="text-slate-500 text-[11px] mt-0.5">Botol Kaca Premium 750 ml</p>
                    <div class="mt-3 pt-2 border-t border-slate-100 flex justify-between items-center">
                        <span class="font-bold text-[#002D72]">Rp 35.000</span>
                        <a href="{{ route('products.index', ['search' => 'Reflections']) }}" class="text-[11px] font-bold text-[#0072CE] hover:underline">Lihat Produk &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Pin 2: Probiotic Yogurt --}}
            <div class="absolute top-[62%] left-[42%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 2 ? null : 2)" 
                        class="hotspot-pin w-8 h-8 rounded-full bg-[#00965E] text-white flex items-center justify-center font-bold text-xs shadow-lg animate-pulse" 
                        title="Activia Probiotik">
                    +
                </button>
                <div x-show="activePin === 2" @click.away="activePin = null" x-cloak
                     class="absolute bottom-10 left-1/2 -translate-x-1/2 w-60 bg-white p-4 border border-[#E2E8F0] shadow-xl rounded-xl text-xs z-30">
                    <span class="text-[10px] uppercase tracking-wider text-[#00965E] font-bold block">Yogurt Probiotik</span>
                    <h4 class="text-sm text-[#002D72] font-bold mt-1">Activia Wild Strawberry</h4>
                    <p class="text-slate-500 text-[11px] mt-0.5">Kultur Bifidus Aktif 4 x 120 g</p>
                    <div class="mt-3 pt-2 border-t border-slate-100 flex justify-between items-center">
                        <span class="font-bold text-[#002D72]">Rp 28.500</span>
                        <a href="{{ route('products.index', ['search' => 'Activia']) }}" class="text-[11px] font-bold text-[#00965E] hover:underline">Lihat Produk &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Pin 3: Plant-Based Oat Milk --}}
            <div class="absolute top-[32%] left-[82%] z-20">
                <button type="button" 
                        @click="activePin = (activePin === 3 ? null : 3)" 
                        class="hotspot-pin w-8 h-8 rounded-full bg-[#F59E0B] text-white flex items-center justify-center font-bold text-xs shadow-lg animate-pulse" 
                        title="Alpro Plant-Based">
                    +
                </button>
                <div x-show="activePin === 3" @click.away="activePin = null" x-cloak
                     class="absolute bottom-10 right-0 w-60 bg-white p-4 border border-[#E2E8F0] shadow-xl rounded-xl text-xs z-30">
                    <span class="text-[10px] uppercase tracking-wider text-[#F59E0B] font-bold block">Plant-Based Milk</span>
                    <h4 class="text-sm text-[#002D72] font-bold mt-1">Alpro Barista Oat Milk</h4>
                    <p class="text-slate-500 text-[11px] mt-0.5">1000 ml Bebas Laktosa</p>
                    <div class="mt-3 pt-2 border-t border-slate-100 flex justify-between items-center">
                        <span class="font-bold text-[#002D72]">Rp 45.000</span>
                        <a href="{{ route('products.index', ['search' => 'Alpro']) }}" class="text-[11px] font-bold text-[#F59E0B] hover:underline">Lihat Produk &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. Produk Unggulan Danone --}}
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 pb-4 border-b border-slate-200">
        <div>
            <span class="text-[11px] uppercase tracking-wider text-[#0072CE] font-bold block mb-1">Pilihan Terfavorit</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-[#002D72]">Produk Unggulan Danone</h2>
        </div>
        <a href="{{ route('products.index') }}" class="text-xs uppercase tracking-wider font-bold text-[#0072CE] hover:text-[#002D72] mt-3 sm:mt-0 transition-colors">
            Lihat Semua Produk &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts->take(8) as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

{{-- 4. Pilar Nutrisi Danone --}}
<section class="py-20 bg-slate-50 border-y border-[#E2E8F0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
            <span class="text-[11px] uppercase tracking-wider text-[#0072CE] font-bold">Standar Mutu Danone</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-[#002D72]">Pilar Nutrisi & Kualitas Kami</h2>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                Setiap produk Danone diproduksi dengan komitmen kuat terhadap kemurnian, nutrisi berbasis sains, dan keberlanjutan lingkungan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-[#E2E8F0] shadow-xs text-center space-y-3">
                <div class="w-14 h-14 rounded-full mx-auto bg-[#E0F2FE] text-[#0072CE] flex items-center justify-center text-2xl">
                    💧
                </div>
                <h3 class="font-bold text-base text-[#002D72]">Air Mineral Pegunungan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Terlindungi dari sumber alami vulkanik dengan mineral seimbang untuk hidrasi harian murni.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#E2E8F0] shadow-xs text-center space-y-3">
                <div class="w-14 h-14 rounded-full mx-auto bg-[#DCFCE7] text-[#00965E] flex items-center justify-center text-2xl">
                    🥣
                </div>
                <h3 class="font-bold text-base text-[#002D72]">Probiotik & Mikrobioma</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Miliaran kultur probiotik hidup yang terbukti klinis mendukung kesehatan pencernaan keluarga.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#E2E8F0] shadow-xs text-center space-y-3">
                <div class="w-14 h-14 rounded-full mx-auto bg-[#FEF3C7] text-[#F59E0B] flex items-center justify-center text-2xl">
                    🌱
                </div>
                <h3 class="font-bold text-base text-[#002D72]">Nutrisi Berbasis Nabati</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Pilihan minuman nabati lezat dari kedelai dan oat berkualitas tinggi yang ramah bumi.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#E2E8F0] shadow-xs text-center space-y-3">
                <div class="w-14 h-14 rounded-full mx-auto bg-[#EEF2FF] text-[#002D72] flex items-center justify-center text-2xl">
                    👶
                </div>
                <h3 class="font-bold text-base text-[#002D72]">Nutrisi Tumbuh Kembang</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Didukung riset Nutricia untuk optimasi perkembangan fisik dan kecerdasan anak.</p>
            </div>
        </div>
    </div>
</section>

{{-- 5. Artikel & Tips Nutrisi --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10 pb-4 border-b border-slate-200">
            <div>
                <span class="text-[11px] uppercase tracking-wider text-[#0072CE] font-bold block mb-1">Edukasi & Informasi</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#002D72]">Artikel Nutrisi Danone</h2>
            </div>
            <a href="{{ route('inspiration.index') }}" class="text-xs uppercase tracking-wider font-bold text-[#0072CE] hover:underline">
                Lihat Semua Artikel &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($inspirations as $story)
                @php
                    $storyImg = $story->image ?? 'images/cat-waters.jpg';
                    $storyImgUrl = str_starts_with($storyImg, 'http') ? $storyImg : asset($storyImg);
                @endphp
                <article class="bg-slate-50 rounded-2xl border border-[#E2E8F0] overflow-hidden group hover:shadow-md transition-shadow">
                    <a href="{{ route('inspiration.show', $story->slug) }}" class="block aspect-[16/10] bg-slate-200 overflow-hidden">
                        <img src="{{ $storyImgUrl }}" 
                             alt="{{ $story->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-6 space-y-2.5">
                        <span class="text-[10px] uppercase tracking-wider text-[#0072CE] font-bold">{{ $story->category ?? 'Nutrisi & Kesehatan' }}</span>
                        <h3 class="text-base font-bold text-[#002D72] group-hover:text-[#0072CE] transition-colors leading-snug">
                            <a href="{{ route('inspiration.show', $story->slug) }}">{{ $story->title }}</a>
                        </h3>
                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                            {{ $story->excerpt }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection