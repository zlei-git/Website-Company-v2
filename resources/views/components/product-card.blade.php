@props([
    'product',
    'showCategory' => true,
    'showQuickAdd' => true,
])

@php
    $primaryImg = $product->primaryImage ?? ($product->images ? ($product->images->where('is_primary', true)->first() ?? $product->images->first()) : null);
    $imageUrl = $primaryImg?->image_url ?? 'https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&w=800&q=80';

    $isWishlisted = false;
    if (auth()->check()) {
        $isWishlisted = in_array($product->id, auth()->user()->wishlistProductIds());
    }

    $isOutOfStock = $product->stock <= 0;
    $isLowStock = $product->stock > 0 && $product->stock <= 5;
@endphp

<div class="group relative flex flex-col h-full bg-white border border-[#E8E4DC] rounded-sm overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] hover:-translate-y-2 hover:border-[#18181A] hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.12)]">
    {{-- Image Container (4:5 Aspect Ratio) with interactive hover sheen --}}
    <div class="relative w-full aspect-[4/5] bg-[#FAF8F3] overflow-hidden">
        {{-- Luxury diagonal light shimmer sweep on hover --}}
        <div class="pointer-events-none absolute inset-0 z-10 bg-gradient-to-tr from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></div>

        <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full overflow-hidden">
            <img src="{{ $imageUrl }}" 
                 alt="{{ $product->name }}" 
                 loading="lazy"
                 class="w-full h-full object-cover object-center transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:scale-110"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&w=800&q=80';" />
        </a>

        {{-- Top Badges Overlay --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1.5 z-10 pointer-events-none">
            @if($product->is_featured)
                <x-badge type="charcoal" size="sm">Featured</x-badge>
            @endif

            @if($isOutOfStock)
                <x-badge type="danger" size="sm">Out of Stock</x-badge>
            @elseif($isLowStock)
                <x-badge type="warning" size="sm">Only {{ $product->stock }} Left</x-badge>
            @endif
        </div>

        {{-- Wishlist Button --}}
        <div class="absolute top-3 right-3 z-10">
            @auth
                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            title="{{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
                            class="w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-[#E5E0D8] flex items-center justify-center text-[#1C1C1C] hover:text-[#9b3a2b] hover:border-[#D8C3A5] transition-all shadow-xs">
                        <svg class="w-4 h-4 {{ $isWishlisted ? 'fill-[#9b3a2b] text-[#9b3a2b]' : 'fill-none stroke-currentColor stroke-[1.75]' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   title="Sign in to save to Wishlist"
                   class="w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-[#E5E0D8] flex items-center justify-center text-[#1C1C1C] hover:text-[#9b3a2b] hover:border-[#D8C3A5] transition-all shadow-xs">
                    <svg class="w-4 h-4 fill-none stroke-currentColor stroke-[1.75]" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </a>
            @endauth
        </div>

        {{-- Quick Add To Cart Bar (Slide up with spring ease) --}}
        @if($showQuickAdd)
            <div class="absolute inset-x-3 bottom-3 z-10 translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-400 ease-[cubic-bezier(0.16,1,0.3,1)] pointer-events-auto">
                @if(!$isOutOfStock)
                    @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-full py-2.5 px-4 bg-[#18181A]/95 hover:bg-black text-[#FAF8F3] text-xs uppercase tracking-wider font-medium flex items-center justify-center gap-2 rounded-sm shadow-lg backdrop-blur-sm transition-all hover:scale-[1.02] active:scale-[0.98]">
                                <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Quick Add</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full py-2.5 px-4 bg-[#18181A]/95 hover:bg-black text-[#FAF8F3] text-xs uppercase tracking-wider font-medium flex items-center justify-center gap-2 rounded-sm shadow-lg backdrop-blur-sm transition-all hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>Sign In to Add</span>
                        </a>
                    @endauth
                @else
                    <button type="button" disabled 
                            class="w-full py-2.5 px-4 bg-[#F0EBE1] text-[#777777] text-xs uppercase tracking-wider font-medium flex items-center justify-center gap-2 rounded-sm cursor-not-allowed">
                        <span>Sold Out</span>
                    </button>
                @endif
            </div>
        @endif
    </div>

    {{-- Details Body --}}
    <div class="p-4 flex flex-col flex-grow justify-between bg-white">
        <div>
            @if($showCategory && $product->category)
                <div class="text-[10px] sm:text-[11px] font-medium tracking-widest text-[#777777] uppercase mb-1">
                    <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-[#1C1C1C] transition-colors">
                        {{ $product->category->name }}
                    </a>
                </div>
            @endif

            <h3 class="font-heading text-[15px] sm:text-base font-normal text-[#1C1C1C] group-hover:text-[#7A8B6F] transition-colors line-clamp-1">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>

            @if($product->dimensions)
                <p class="text-[11px] text-[#71717A] mt-0.5">
                    {{ $product->dimensions }}
                </p>
            @endif

            @if($product->averageRating() > 0)
                <div class="mt-1 flex items-center gap-1.5 text-xs text-[#777777]">
                    <div class="flex text-[#D8C3A5]">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 {{ $i <= round($product->averageRating()) ? 'fill-current' : 'text-[#E5E0D8] fill-current' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[11px] text-[#888888]">({{ number_format($product->averageRating(), 1) }})</span>
                </div>
            @endif
        </div>

        <div class="mt-3 pt-3 border-t border-[#F0EBE1] flex items-center justify-between">
            <span class="text-sm sm:text-base font-medium text-[#1C1C1C]">
                ${{ number_format($product->price, 2) }}
            </span>

            <span class="text-[11px] text-[#777777]">
                @if($isOutOfStock)
                    <span class="text-[#9b3a2b] font-medium">Out of Stock</span>
                @elseif($isLowStock)
                    <span class="text-[#8a631c] font-medium">{{ $product->stock }} left</span>
                @else
                    <span class="text-[#7A8B6F] font-medium">In Stock</span>
                @endif
            </span>
        </div>
    </div>
</div>
