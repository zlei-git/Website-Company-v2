@extends('layouts.customer')

@section('title', 'Page Not Found - Nordic Pure Nutrition')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center py-20 px-6">
    <div class="text-center max-w-lg mx-auto">
        <span class="text-sm uppercase tracking-widest text-[#777777] font-medium">404 Error</span>
        <h1 class="text-4xl md:text-5xl font-serif text-[#1C1C1C] mt-3 mb-4">Page Not Found</h1>
        <p class="text-[#777777] mb-8 leading-relaxed">
            The product or page you are looking for might have been moved, renamed, or is temporarily unavailable.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('home') }}" class="btn-primary w-full sm:w-auto">Return Home</a>
            <a href="{{ route('products.index') }}" class="btn-secondary w-full sm:w-auto">Explore Catalog</a>
        </div>
    </div>
</div>
@endsection
