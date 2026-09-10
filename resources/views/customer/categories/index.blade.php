@extends('layouts.customer')

@section('title', 'Categories - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
        <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold">Essential Living Nutrition</span>
        <h1 class="font-serif text-4xl sm:text-5xl text-[#1C1C1C]">Nourishment by Category</h1>
        <p class="text-sm text-[#777777] font-light leading-relaxed">
            From pristine volcanic spring waters to live probiotic cultured yogurts and organic plant milks, explore our certified nutrition range.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($categories as $cat)
            <a href="{{ route('categories.show', $cat->slug) }}" class="group block bg-white border border-[#E5E0D8] rounded overflow-hidden hover:border-[#D8C3A5] transition-all">
                <div class="aspect-[16/10] bg-[#F0EBE1] overflow-hidden relative">
                    <img src="{{ !empty($cat->image) ? (str_starts_with($cat->image, 'http') ? $cat->image : asset($cat->image)) : asset('images/cat-waters.jpg') }}" 
                         alt="{{ $cat->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/15 group-hover:bg-black/5 transition-colors"></div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="font-serif text-2xl text-[#1C1C1C] group-hover:text-[#7A8B6F] transition-colors">{{ $cat->name }}</h2>
                        <span class="text-xs text-[#777777]">{{ $cat->products_count ?? $cat->products->count() }} items</span>
                    </div>
                    <p class="text-xs text-[#777777] line-clamp-2 leading-relaxed">
                        {{ $cat->description ?? 'Pure natural nutrition crafted for everyday health and vitality.' }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
