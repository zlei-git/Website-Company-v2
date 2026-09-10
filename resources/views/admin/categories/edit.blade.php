@extends('layouts.admin')

@section('title', 'Edit Category - Danone Admin')

@section('content')
<div class="max-w-2xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Edit Category: {{ $category->name }}</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Name *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Description</label>
            <textarea name="description" rows="3">{{ old('description', $category->description) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Replace Image</label>
            <input type="file" name="image" accept="image/*" class="text-xs">
        </div>
        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }} class="mr-2 rounded text-[#1C1C1C]">
                <span>Active</span>
            </label>
        </div>
        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Update Category</button>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
