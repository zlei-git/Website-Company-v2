@extends('layouts.admin')

@section('title', 'Journal Publications & Editorial - Nordic Operations')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Editorial Desk &bull; Journal Articles Ledger
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Journal Publications</h1>
            <p class="text-xs text-[#71717A] mt-1">Manage nutrition science publications, lifestyle essays, and editorial stories.</p>
        </div>
        <a href="{{ route('admin.inspirations.create') }}" class="btn-primary text-xs py-2.5 px-5">
            + Create New Article
        </a>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden shadow-xs">
        <table class="w-full text-left text-xs">
            <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider text-[10px] border-b border-[#E8E4DC]">
                <tr>
                    <th class="py-3.5 px-6 font-semibold">Article Title</th>
                    <th class="py-3.5 px-6 font-semibold">Category / Pillar</th>
                    <th class="py-3.5 px-6 font-semibold">Published Date</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8E4DC]">
                @foreach($inspirations as $art)
                    <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                        <td class="py-4 px-6 font-medium text-[#18181A]">{{ $art->title }}</td>
                        <td class="py-4 px-6 text-[#52525B]">{{ $art->category ?? 'Hydration Science' }}</td>
                        <td class="py-4 px-6 text-[#71717A]">{{ $art->published_at?->format('M d, Y') ?? 'Draft' }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold {{ $art->is_published ? 'bg-[#F0F4EE] text-[#4A6342]' : 'bg-[#FAF8F3] text-[#71717A]' }}">
                                {{ $art->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('admin.inspirations.edit', $art->id) }}" class="text-[#18181A] hover:text-[#7A8B6F] font-semibold underline">Edit</a>
                            <form action="{{ route('admin.inspirations.destroy', $art->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete article?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($inspirations->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $inspirations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
