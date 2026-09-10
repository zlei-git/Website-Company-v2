@extends('layouts.customer')

@section('title', $product->name . ' - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ 
    activeImage: '{{ $product->images->first()?->image_url ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900&q=80' }}',
    activeTab: 'desc'
}">
    {{-- Breadcrumb --}}
    <nav class="flex text-xs text-[#777777] mb-8 space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#1C1C1C]">Home</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-[#1C1C1C]">Products</a>
        <span>/</span>
        <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-[#1C1C1C]">{{ $product->category->name }}</a>
        <span>/</span>
        <span class="text-[#1C1C1C] font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">
        {{-- Gallery (7 cols) --}}
        <div class="lg:col-span-7 space-y-4">
            <div class="relative aspect-[4/5] bg-white border border-[#E5E0D8] rounded overflow-hidden">
                <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-all duration-300">
            </div>

            @if($product->images->count() > 1)
                <div class="flex space-x-3 overflow-x-auto pb-2">
                    @foreach($product->images as $img)
                        <button type="button" @click="activeImage = '{{ $img->image_url }}'" 
                                class="w-20 h-20 flex-shrink-0 border border-[#E5E0D8] rounded overflow-hidden hover:border-[#1C1C1C] transition-colors"
                                :class="{ 'ring-2 ring-[#1C1C1C]': activeImage === '{{ $img->image_url }}' }">
                            <img src="{{ $img->image_url }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info (5 cols) --}}
        <div class="lg:col-span-5 space-y-6">
            <div>
                <span class="text-xs uppercase tracking-[0.2em] text-[#777777] block mb-2">{{ $product->category->name }}</span>
                <h1 class="font-serif text-3xl sm:text-4xl text-[#1C1C1C] leading-tight mb-3">{{ $product->name }}</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-2xl font-serif text-[#1C1C1C] font-semibold">${{ number_format($product->price, 2) }}</span>
                    @if($product->stock > 5)
                        <span class="badge badge-success">In Stock ({{ $product->stock }})</span>
                    @elseif($product->stock > 0)
                        <span class="badge badge-warning">Low Stock ({{ $product->stock }} left)</span>
                    @else
                        <span class="badge badge-danger">Out of Stock</span>
                    @endif
                </div>
            </div>

            <p class="text-sm text-[#777777] leading-relaxed border-t border-b border-[#E5E0D8] py-4">
                {{ $product->description }}
            </p>

            {{-- Materials & Dimensions Quick Info --}}
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[#777777] block uppercase tracking-wider">Ingredients / Source</span>
                    <span class="font-medium text-[#1C1C1C]">{{ $product->material ?? '100% Pure Natural Provenance' }}</span>
                </div>
                <div>
                    <span class="text-[#777777] block uppercase tracking-wider">Serving / Volume</span>
                    <span class="font-medium text-[#1C1C1C]">{{ $product->dimensions ?? 'Standard Pack' }}</span>
                </div>
            </div>

            {{-- Actions --}}
            <div class="space-y-3 pt-2">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center space-x-3">
                        @csrf
                        <div class="w-24 flex-shrink-0">
                            <label class="sr-only">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="text-center font-medium">
                        </div>
                        <button type="submit" class="btn-primary flex-grow">
                            Add to Shopping Cart
                        </button>
                    </form>
                @else
                    <button disabled class="btn-primary w-full opacity-50 cursor-not-allowed">
                        Currently Unavailable
                    </button>
                @endif

                <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-secondary w-full flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-[#777777]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span>Add to Wishlist</span>
                    </button>
                </form>
            </div>

            {{-- Assurances --}}
            <div class="pt-6 border-t border-[#E5E0D8] space-y-2 text-xs text-[#777777]">
                <p>✓ 100% Certified pure volcanic & organic living provenance</p>
                <p>✓ Cold-chain temperature-controlled fresh home delivery</p>
                <p>✓ Live probiotic potency and pure cellular hydration guarantee</p>
            </div>
        </div>
    </div>

    {{-- Tabs: Details, Specs, Reviews --}}
    <div class="border-t border-[#E5E0D8] pt-12 mb-16">
        <div class="flex space-x-8 border-b border-[#E5E0D8] mb-8 text-sm">
            <button @click="activeTab = 'desc'" :class="{ 'border-b-2 border-[#1C1C1C] text-[#1C1C1C] font-semibold': activeTab === 'desc', 'text-[#777777]': activeTab !== 'desc' }" class="pb-3 focus:outline-none">
                Description & Provenance
            </button>
            <button @click="activeTab = 'specs'" :class="{ 'border-b-2 border-[#1C1C1C] text-[#1C1C1C] font-semibold': activeTab === 'specs', 'text-[#777777]': activeTab !== 'specs' }" class="pb-3 focus:outline-none">
                Nutrition Specifications
            </button>
            <button @click="activeTab = 'reviews'" :class="{ 'border-b-2 border-[#1C1C1C] text-[#1C1C1C] font-semibold': activeTab === 'reviews', 'text-[#777777]': activeTab !== 'reviews' }" class="pb-3 focus:outline-none">
                Customer Reviews ({{ $product->reviews->where('is_approved', true)->count() }})
            </button>
        </div>

        <div x-show="activeTab === 'desc'" class="prose max-w-none text-sm text-[#555555] leading-relaxed space-y-4">
            <p>{{ $product->description }}</p>
            <p>Every production batch is laboratory certified for mineral balance, biochemical purity, and live culture count before receiving the standar kualitas resmi Danone.</p>
        </div>

        <div x-show="activeTab === 'specs'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div class="p-4 bg-white border border-[#E5E0D8] rounded flex justify-between">
                <span class="text-[#777777]">Ingredients & Source</span>
                <span class="font-medium text-[#1C1C1C]">{{ $product->material ?? 'Single-Origin Natural Ingredients' }}</span>
            </div>
            <div class="p-4 bg-white border border-[#E5E0D8] rounded flex justify-between">
                <span class="text-[#777777]">Pack Size / Volume</span>
                <span class="font-medium text-[#1C1C1C]">{{ $product->dimensions ?? 'Standard Pack' }}</span>
            </div>
            <div class="p-4 bg-white border border-[#E5E0D8] rounded flex justify-between">
                <span class="text-[#777777]">Storage Requirement</span>
                <span class="font-medium text-[#1C1C1C]">Keep refrigerated at 2-4°C / Cool dry place</span>
            </div>
            <div class="p-4 bg-white border border-[#E5E0D8] rounded flex justify-between">
                <span class="text-[#777777]">Sustainable Packaging</span>
                <span class="font-medium text-[#1C1C1C]">100% Recyclable / FSC-Certified Carton</span>
            </div>
        </div>

        <div x-show="activeTab === 'reviews'" x-cloak class="space-y-8">
            <div class="space-y-4">
                @forelse($product->reviews->where('is_approved', true) as $review)
                    <div class="p-6 bg-white border border-[#E5E0D8] rounded space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-sm text-[#1C1C1C]">{{ $review->user->name ?? 'Verified Collector' }}</span>
                            <span class="text-xs text-[#777777]">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex text-amber-500 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <p class="text-xs text-[#555555] leading-relaxed">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-xs text-[#777777] italic py-4">No verified reviews for this piece yet.</p>
                @endforelse
            </div>

            @auth
                @if($canReview && !$hasReviewed)
                    <div class="p-6 bg-[#FAF8F3] border border-[#E5E0D8] rounded">
                        <h4 class="font-serif text-lg text-[#1C1C1C] mb-4">Leave a Verified Review</h4>
                        <form action="{{ route('reviews.store', $product) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs uppercase tracking-wider text-[#333333] mb-1">Rating</label>
                                <select name="rating" class="text-xs w-auto">
                                    <option value="5">★★★★★ (5/5 Excellence)</option>
                                    <option value="4">★★★★☆ (4/5 Very Good)</option>
                                    <option value="3">★★★☆☆ (3/5 Good)</option>
                                    <option value="2">★★☆☆☆ (2/5 Fair)</option>
                                    <option value="1">★☆☆☆☆ (1/5 Poor)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wider text-[#333333] mb-1">Your Comment</label>
                                <textarea name="comment" rows="3" required placeholder="Share your experience living with this piece..." class="text-xs"></textarea>
                            </div>
                            <button type="submit" class="btn-primary text-xs">Submit Review</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Related Products --}}
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="border-t border-[#E5E0D8] pt-12">
            <h3 class="font-serif text-2xl text-[#1C1C1C] mb-8">Complementary Pieces</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rel)
                    @include('components.product-card', ['product' => $rel])
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
