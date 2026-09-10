@extends('layouts.admin')

@section('title', 'Edit Article - Danone Admin')

@section('content')
<div class="max-w-3xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Edit Article: {{ $inspiration->title }}</h1>

    <form action="{{ route('admin.inspirations.update', $inspiration->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Title *</label>
            <input type="text" name="title" value="{{ old('title', $inspiration->title) }}" required>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category', $inspiration->category) }}">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Author</label>
                <input type="text" name="author" value="{{ old('author', $inspiration->author) }}">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Short Excerpt</label>
            <textarea name="excerpt" rows="2">{{ old('excerpt', $inspiration->excerpt) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Article Content *</label>
            <textarea name="content" rows="10" required>{{ old('content', $inspiration->content) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Replace Cover Image</label>
            <input type="file" name="image" accept="image/*" class="text-xs">
        </div>
        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ $inspiration->is_published ? 'checked' : '' }} class="mr-2 rounded text-[#1C1C1C]">
                <span>Published</span>
            </label>
        </div>
        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Update Article</button>
            <a href="{{ route('admin.inspirations.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
