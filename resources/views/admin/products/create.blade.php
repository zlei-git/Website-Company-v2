@extends('layouts.admin')

@section('title', 'New Product - Danone Admin')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="border-b border-[#E5E0D8] pb-4">
        <h1 class="font-serif text-2xl text-[#1C1C1C]">Create New Nutrition Product</h1>
    </div>

    @if($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs rounded">
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 sm:p-8 space-y-6">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Piece Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Oslo Lounge Chair">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Category *</label>
                <select name="category_id" required class="text-xs">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Price ($) *</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required placeholder="499.00">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Initial Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', 10) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Status *</label>
                <select name="status" class="text-xs">
                    <option value="active">Active</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Material / Timber</label>
                <input type="text" name="material" value="{{ old('material') }}" placeholder="e.g. Solid European Oak, Matt Oil">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Dimensions</label>
                <input type="text" name="dimensions" value="{{ old('dimensions') }}" placeholder="e.g. W 85 x D 90 x H 78 cm">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Description *</label>
            <textarea name="description" rows="4" required placeholder="Detailed design story, ergonomic nuances, and room styling recommendations.">{{ old('description') }}</textarea>
        </div>

        {{-- Multiple Images --}}
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Product Images</label>
            <input type="file" name="images[]" multiple accept="image/*" class="text-xs file:btn-secondary file:py-1 file:px-3 file:mr-3">
            <span class="text-[10px] text-[#777777] block mt-1">Upload multiple photos. The first uploaded image will be set as primary.</span>
        </div>

        {{-- Featured Toggle --}}
        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" class="mr-2 rounded text-[#1C1C1C] focus:ring-[#D8C3A5]">
                <span>Feature on Homepage Curated Selection</span>
            </label>
        </div>

        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Save & Publish Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
