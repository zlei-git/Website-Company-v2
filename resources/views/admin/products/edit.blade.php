@extends('layouts.admin')

@section('title', 'Edit ' . $product->name . ' - Danone Admin')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="border-b border-[#E5E0D8] pb-4 flex items-center justify-between">
        <h1 class="font-serif text-2xl text-[#1C1C1C]">Edit: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="text-xs text-[#777777] hover:underline">&larr; Back to Catalog</a>
    </div>

    @if($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs rounded">
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Piece Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Category *</label>
                <select name="category_id" required class="text-xs">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Price ($) *</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Stock Level *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Status *</label>
                <select name="status" class="text-xs">
                    <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ $product->status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Material / Timber</label>
                <input type="text" name="material" value="{{ old('material', $product->material) }}">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Dimensions</label>
                <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Description *</label>
            <textarea name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Existing Images with Primary selector & Delete --}}
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-2">Current Product Photos</label>
            <div class="flex flex-wrap gap-4 mb-4">
                @foreach($product->images as $img)
                    <div class="relative w-24 h-24 border rounded overflow-hidden p-1 {{ $img->is_primary ? 'border-amber-500 ring-2 ring-amber-400' : 'border-[#E5E0D8]' }}">
                        <img src="{{ $img->image_path }}" class="w-full h-full object-cover">
                        @if($img->is_primary)
                            <span class="absolute bottom-0 inset-x-0 bg-amber-500 text-white text-[9px] text-center font-bold">PRIMARY</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Upload Additional Photos</label>
            <input type="file" name="images[]" multiple accept="image/*" class="text-xs">
        </div>

        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="mr-2 rounded text-[#1C1C1C]">
                <span>Featured on Homepage Curated Selection</span>
            </label>
        </div>

        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
