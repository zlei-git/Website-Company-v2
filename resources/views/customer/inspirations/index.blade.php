@extends('layouts.customer')

@section('title', 'Inspiration Journal - Nordic Pure Nutrition')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
        <span class="text-xs uppercase tracking-[0.2em] text-[#0072CE] font-semibold">Editorial and Wellness</span>
        <h1 class="font-serif text-4xl sm:text-5xl text-[#002D72]">Nordic Nutrition Journal</h1>
        <p class="text-sm text-[#64748B] font-light leading-relaxed">
            Essays on deep cellular hydration, gut microbiome health, organic plant-based living, and sustainable vitality.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($articles as $article)
            <article class="bg-white border border-[#E5E0D8] rounded overflow-hidden group">
                <a href="{{ route('inspiration.show', $article->slug) }}" class="block aspect-[16/10] bg-[#F0EBE1] overflow-hidden">
                    <img src="{{ !empty($article->image) ? (str_starts_with($article->image, 'http') ? $article->image : asset($article->image)) : asset('images/cat-waters.jpg') }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </a>
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between text-xs text-[#777777]">
                        <span class="uppercase tracking-wider text-[#7A8B6F] font-medium">{{ $article->category ?? 'Design' }}</span>
                        <span>{{ $article->published_at?->format('M d, Y') ?? 'Recent' }}</span>
                    </div>
                    <h2 class="font-serif text-xl text-[#1C1C1C] group-hover:text-[#7A8B6F] transition-colors leading-snug">
                        <a href="{{ route('inspiration.show', $article->slug) }}">{{ $article->title }}</a>
                    </h2>
                    <p class="text-xs text-[#777777] line-clamp-3 leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('inspiration.show', $article->slug) }}" class="text-xs font-semibold uppercase tracking-wider text-[#1C1C1C] hover:text-[#7A8B6F]">
                            Read Article &rarr;
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <div class="pt-12">
        {{ $articles->links() }}
    </div>
</div>
@endsection
