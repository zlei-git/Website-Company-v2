@extends('layouts.customer')

@section('title', $collection->name . ' - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="flex text-xs text-[#777777] mb-6 space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#1C1C1C]">Home</a>
        <span>/</span>
        <a href="{{ route('collections.index') }}" class="hover:text-[#1C1C1C]">Collections</a>
        <span>/</span>
        <span class="text-[#1C1C1C] font-medium">{{ $collection->name }}</span>
    </nav>

    <div class="border-b border-[#E5E0D8] pb-8 mb-10">
        <span class="text-xs uppercase tracking-[0.2em] text-[#D8C3A5] font-semibold block mb-2">Curated Series</span>
        <h1 class="font-serif text-3xl sm:text-5xl text-[#1C1C1C] mb-3">{{ $collection->name }}</h1>
        <p class="text-sm text-[#777777] max-w-2xl font-light leading-relaxed">
            {{ $collection->description }}
        </p>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="pt-10">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16 text-[#777777] bg-white border border-[#E5E0D8] rounded">
            <p class="font-serif text-xl text-[#1C1C1C]">No pieces currently associated with this collection.</p>
            <a href="{{ route('products.index') }}" class="btn-secondary mt-4 inline-block">Browse All Products</a>
        </div>
    @endif
</div>
@endsection
