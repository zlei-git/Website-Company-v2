@extends('layouts.customer')

@section('title', 'Pure Nutrition & Natural Hydration Catalog - Danone')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Editorial Monograph Header --}}
    <div class="border-b border-[#E8E4DC] pb-8 mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold block mb-1.5">Katalog Nutrisi Danone</span>
            <h1 class="font-serif text-3xl sm:text-5xl text-[#18181A]">Nutrition & Hydration</h1>
            <p class="text-xs sm:text-sm text-[#71717A] mt-2 font-light max-w-xl leading-relaxed">
                Single-origin volcanic spring waters, living probiotic yogurts, organic plant milks, and active performance nutrition for conscious living.
            </p>
        </div>

        <div class="flex items-center space-x-3 text-xs text-[#71717A]">
            <span class="font-mono font-medium text-[#18181A]">{{ $products->total() }}</span>
            <span>Products Available</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        {{-- Sticky Filter Rail (3 cols) --}}
        <aside class="lg:col-span-3 space-y-6">
            <form action="{{ route('products.index') }}" method="GET" class="bg-white p-6 border border-[#E8E4DC] rounded-sm space-y-6">
                {{-- Search Query --}}
                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-2">Search Catalog</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Water, yogurt, oat milk..." class="text-xs">
                </div>

                {{-- Space / Category --}}
                <div class="border-t border-[#E8E4DC] pt-5">
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-3">Nutrition Category</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        @foreach($categories as $cat)
                            <label class="flex items-center text-xs text-[#52525B] cursor-pointer hover:text-[#18181A]">
                                <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }} class="mr-2 text-[#18181A] focus:ring-0">
                                <span>{{ $cat->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Series / Collection --}}
                <div class="border-t border-[#E8E4DC] pt-5">
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-3">Series</label>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                        @foreach($collections as $col)
                            <label class="flex items-center text-xs text-[#52525B] cursor-pointer hover:text-[#18181A]">
                                <input type="radio" name="collection" value="{{ $col->slug }}" {{ request('collection') == $col->slug ? 'checked' : '' }} class="mr-2 text-[#18181A] focus:ring-0">
                                <span>{{ $col->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Price Range --}}
                <div class="border-t border-[#E8E4DC] pt-5">
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-2">Price Bounds ($)</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="text-xs">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="text-xs">
                    </div>
                </div>

                {{-- Availability --}}
                <div class="border-t border-[#E8E4DC] pt-5">
                    <label class="flex items-center text-xs text-[#52525B] cursor-pointer hover:text-[#18181A]">
                        <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} class="mr-2 rounded text-[#18181A] focus:ring-0">
                        <span>Immediate Dispatch Only</span>
                    </label>
                </div>

                <div class="pt-2 flex flex-col gap-2">
                    <button type="submit" class="btn-primary w-full py-2.5 text-xs tracking-widest">Apply Selection</button>
                    @if(request()->hasAny(['search', 'category', 'collection', 'min_price', 'max_price', 'in_stock']))
                        <a href="{{ route('products.index') }}" class="text-center text-xs text-[#71717A] hover:text-[#18181A] underline py-1">Reset All Filters</a>
                    @endif
                </div>
            </form>
        </aside>

        {{-- Catalog Grid Area (9 cols) --}}
        <main class="lg:col-span-9 space-y-8">
            {{-- Top Sort Bar --}}
            <div class="flex items-center justify-between text-xs text-[#71717A] pb-3 border-b border-[#E8E4DC]">
                <span>Displaying {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}</span>

                <form method="GET" action="{{ route('products.index') }}" class="flex items-center space-x-2">
                    @foreach(request()->except('sort') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <label for="sort_select" class="text-[11px] uppercase tracking-wider">Sort:</label>
                    <select id="sort_select" name="sort" onchange="this.form.submit()" class="text-xs py-1.5 px-3 bg-white border-[#E8E4DC] rounded-sm w-auto">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Additions</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Viewed</option>
                    </select>
                </form>
            </div>

            {{-- Products Grid --}}
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="pt-8">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white border border-[#E8E4DC] rounded-sm p-16 text-center space-y-4">
                    <span class="text-3xl">💧</span>
                    <h3 class="font-serif text-2xl text-[#18181A]">No nutrition products found matching criteria</h3>
                    <p class="text-xs text-[#71717A]">Try expanding your price boundaries or clearing your category selections.</p>
                    <a href="{{ route('products.index') }}" class="btn-secondary text-xs inline-block">Reset Filters</a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
