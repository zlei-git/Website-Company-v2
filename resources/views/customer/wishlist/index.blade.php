@extends('layouts.customer')

@section('title', 'Saved Wishlist - Nordic Pure Nutrition')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="border-b border-[#E5E0D8] pb-6 mb-8">
        <span class="text-xs uppercase tracking-[0.2em] text-[#777777] font-semibold block mb-1">Curation</span>
        <h1 class="font-serif text-3xl sm:text-4xl text-[#1C1C1C]">Your Saved Wishlist</h1>
        <p class="text-xs sm:text-sm text-[#777777] mt-1 font-light">Pieces you are considering for your sanctuary.</p>
    </div>

    @if($wishlists->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlists as $wish)
                <div class="bg-white border border-[#E5E0D8] rounded overflow-hidden flex flex-col justify-between">
                    <a href="{{ route('products.show', $wish->product->slug) }}" class="block aspect-[4/5] bg-[#F0EBE1] overflow-hidden">
                        <img src="{{ $wish->product->images->first()?->image_url ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&q=80' }}" 
                             alt="{{ $wish->product->name }}" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </a>

                    <div class="p-4 space-y-2 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] uppercase tracking-wider text-[#777777]">{{ $wish->product->category->name }}</span>
                            <h3 class="font-serif text-base text-[#1C1C1C]">
                                <a href="{{ route('products.show', $wish->product->slug) }}" class="hover:text-[#7A8B6F]">{{ $wish->product->name }}</a>
                            </h3>
                            <p class="text-sm font-semibold text-[#1C1C1C] mt-1">${{ number_format($wish->product->price, 2) }}</p>
                        </div>

                        <div class="pt-3 border-t border-[#E5E0D8] flex flex-col gap-2">
                            @if($wish->product->stock > 0)
                                <form action="{{ route('wishlist.moveToCart', $wish->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-primary w-full py-2 text-xs">Move to Cart</button>
                                </form>
                            @else
                                <span class="text-center text-xs text-[#842029] py-1 font-medium">Out of Stock</span>
                            @endif

                            <form action="{{ route('wishlist.toggle', $wish->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-center w-full text-[#842029] hover:underline py-1">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white border border-[#E5E0D8] rounded p-16 text-center max-w-xl mx-auto space-y-4">
            <svg class="w-12 h-12 mx-auto text-[#D8C3A5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h2 class="font-serif text-2xl text-[#1C1C1C]">Your wishlist is currently empty</h2>
            <p class="text-xs sm:text-sm text-[#777777] font-light">
                Browse our natural hydration and living nutrition catalog and save your daily wellness favorites.
            </p>
            <div class="pt-4">
                <a href="{{ route('products.index') }}" class="btn-primary inline-block">Browse Catalog</a>
            </div>
        </div>
    @endif
</div>
@endsection
