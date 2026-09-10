@extends('layouts.admin')

@section('title', 'New Category - Danone Admin')

@section('content')
<div class="max-w-2xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Create Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Name *</label>
            <input type="text" name="name" required placeholder="e.g. Living Room">
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Category Image</label>
            <input type="file" name="image" accept="image/*" class="text-xs">
        </div>
        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="status" value="1" checked class="mr-2 rounded text-[#1C1C1C]">
                <span>Active</span>
            </label>
        </div>
        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Save Category</button>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
