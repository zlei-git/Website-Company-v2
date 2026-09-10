@extends('layouts.admin')

@section('title', 'Design Series & Collections - Danone Store Indonesia')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Monograph Collections &bull; Curated Editions
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Design Series</h1>
            <p class="text-xs text-[#71717A] mt-1">Group pieces by architectural design language, material provenance, and collaborative series.</p>
        </div>
        <a href="{{ route('admin.collections.create') }}" class="btn-primary text-xs py-2.5 px-5">
            + Create New Series
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                    <tr>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Series Name</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Identifier Slug</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Editions Included</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Curation Status</th>
                        <th class="py-3.5 px-6 font-medium text-[10px] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E4DC]">
                    @forelse($collections as $col)
                        <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                            <td class="py-4 px-6 font-medium text-[#18181A]">
                                {{ $col->name }}
                            </td>
                            <td class="py-4 px-6 font-mono text-[11px] text-[#71717A]">
                                /{{ $col->slug }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-mono text-xs text-[#18181A]">
                                    {{ $col->products->count() }}
                                </span>
                                <span class="text-[10px] text-[#71717A] ml-1">pieces</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="badge {{ $col->status ? 'badge-success' : 'badge-neutral' }}">
                                    <span class="badge-dot"></span>
                                    {{ $col->status ? 'Active Series' : 'Draft / Inactive' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-3">
                                <a href="{{ route('admin.collections.edit', $col->id) }}" class="text-[#18181A] hover:underline font-medium">Edit</a>
                                <form action="{{ route('admin.collections.destroy', $col->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive this design series?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#9E2B2B] hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-[#71717A]">
                                No design series recorded in the atelier ledger.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
