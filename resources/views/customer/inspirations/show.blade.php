@extends('layouts.customer')

@section('title', $inspiration->title . ' - NordicHome Journal')

@section('content')
<article class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center space-y-4 mb-10">
            <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold">{{ $inspiration->category ?? 'Nordic Living' }}</span>
            <h1 class="font-serif text-3xl sm:text-5xl text-[#1C1C1C] leading-tight">{{ $inspiration->title }}</h1>
            <div class="flex items-center justify-center space-x-4 text-xs text-[#777777] pt-2">
                <span>By {{ $inspiration->author ?? 'NordicHome Studio' }}</span>
                <span>•</span>
                <span>{{ $inspiration->published_at?->format('F d, Y') ?? 'Recently Published' }}</span>
            </div>
        </div>

        {{-- Main Visual --}}
        <div class="aspect-[16/9] rounded-lg overflow-hidden mb-12 bg-[#F0EBE1]">
            <img src="{{ !empty($inspiration->image) ? (str_starts_with($inspiration->image, 'http') ? $inspiration->image : asset($inspiration->image)) : asset('images/cat-waters.jpg') }}" 
                 alt="{{ $inspiration->title }}" 
                 class="w-full h-full object-cover">
        </div>

        {{-- Excerpt Callout --}}
        @if($inspiration->excerpt)
            <div class="border-l-2 border-[#D8C3A5] pl-6 py-2 mb-10">
                <p class="font-serif italic text-lg sm:text-xl text-[#333333] leading-relaxed">
                    "{{ $inspiration->excerpt }}"
                </p>
            </div>
        @endif

        {{-- Body --}}
        <div class="prose max-w-none text-base text-[#333333] leading-relaxed space-y-6">
            {!! $inspiration->content !!}
        </div>

        {{-- Back CTA --}}
        <div class="mt-16 pt-8 border-t border-[#E5E0D8] flex justify-between items-center">
            <a href="{{ route('inspiration.index') }}" class="text-xs uppercase tracking-widest text-[#1C1C1C] hover:text-[#7A8B6F] font-medium">
                &larr; Back to Journal
            </a>
        </div>
    </div>
</article>

{{-- Related Articles --}}
@if(isset($relatedArticles) && $relatedArticles->count() > 0)
    <section class="py-16 bg-[#F5F2EB] border-t border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-serif text-2xl text-[#1C1C1C] mb-8 text-center">Related Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedArticles as $rel)
                    <div class="bg-white border border-[#E5E0D8] rounded p-5 space-y-3">
                        <span class="text-[10px] uppercase tracking-wider text-[#7A8B6F]">{{ $rel->category }}</span>
                        <h3 class="font-serif text-lg text-[#1C1C1C]">
                            <a href="{{ route('inspiration.show', $rel->slug) }}" class="hover:text-[#7A8B6F]">{{ $rel->title }}</a>
                        </h3>
                        <p class="text-xs text-[#777777] line-clamp-2">{{ $rel->excerpt }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
