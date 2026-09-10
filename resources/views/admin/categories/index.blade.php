@extends('layouts.admin')

@section('title', 'Categories - Danone Store Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="font-serif text-2xl text-[#1C1C1C]">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary text-xs py-2 px-4">+ New Category</a>
    </div>

    <div class="bg-white border border-[#E5E0D8] rounded overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead class="bg-[#FAF8F3] text-[#777777] uppercase tracking-wider border-b border-[#E5E0D8]">
                <tr>
                    <th class="p-3">Category</th>
                    <th class="p-3">Slug</th>
                    <th class="p-3">Products</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E5E0D8]">
                @foreach($categories as $cat)
                    <tr>
                        <td class="p-3 font-medium text-[#1C1C1C]">{{ $cat->name }}</td>
                        <td class="p-3 font-mono text-[#777777]">{{ $cat->slug }}</td>
                        <td class="p-3">{{ $cat->products_count ?? $cat->products->count() }}</td>
                        <td class="p-3">
                            <span class="badge {{ $cat->status ? 'badge-success' : 'badge-neutral' }}">{{ $cat->status ? 'Active' : 'Inactive' }}</span>
                        </td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-[#1C1C1C] hover:underline font-medium">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#842029] hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
