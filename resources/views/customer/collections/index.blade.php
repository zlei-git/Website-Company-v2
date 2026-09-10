@extends('layouts.customer')

@section('title', 'Nutritional Collections - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
        <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold">Curated Wellness</span>
        <h1 class="font-serif text-4xl sm:text-5xl text-[#1C1C1C]">Nutritional Collections</h1>
        <p class="text-sm text-[#777777] font-light leading-relaxed">
            Targeted nutrition suites developed around biological vitality - from pure volcanic hydration to bio-active probiotic essentials and clean plant milks.
        </p>
    </div>

    <div class="space-y-12">
        @foreach($collections as $col)
            <div class="bg-white border border-[#E5E0D8] rounded overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-center group">
                <div class="lg:col-span-7 aspect-[16/9] lg:aspect-[4/3] bg-[#F0EBE1] overflow-hidden">
                    <img src="{{ !empty($col->image) ? (str_starts_with($col->image, 'http') ? $col->image : asset($col->image)) : asset('images/cat-waters.jpg') }}" 
                         alt="{{ $col->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="lg:col-span-5 p-8 sm:p-12 space-y-4">
                    <span class="text-xs uppercase tracking-[0.2em] text-[#D8C3A5] font-semibold block">Series</span>
                    <h2 class="font-serif text-3xl text-[#1C1C1C]">{{ $col->name }}</h2>
                    <p class="text-xs sm:text-sm text-[#777777] leading-relaxed">
                        {{ $col->description ?? 'Targeted wellness collections designed to elevate your daily biological vitality with clean nutrition.' }}
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('collections.show', $col->slug) }}" class="btn-primary">
                            Explore {{ $col->name }} &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
