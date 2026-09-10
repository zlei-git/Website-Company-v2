@extends('layouts.admin')

@section('title', 'New Article - Danone Admin')

@section('content')
<div class="max-w-3xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Publish Journal Article</h1>

    <form action="{{ route('admin.inspirations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Title *</label>
            <input type="text" name="title" required placeholder="e.g. The Architecture of Danone Daylight">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Category</label>
                <input type="text" name="category" placeholder="e.g. Living, Timber Craft, Architecture">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Author</label>
                <input type="text" name="author" value="Danone Indonesia">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Short Excerpt</label>
            <textarea name="excerpt" rows="2" placeholder="Brief 1-2 sentence overview for journal preview cards."></textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Article Content *</label>
            <textarea name="content" rows="10" required placeholder="Write the full editorial story here..."></textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Cover Image</label>
            <input type="file" name="image" accept="image/*" class="text-xs">
        </div>
        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_published" value="1" checked class="mr-2 rounded text-[#1C1C1C]">
                <span>Publish Immediately</span>
            </label>
        </div>
        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Publish Article</button>
            <a href="{{ route('admin.inspirations.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
