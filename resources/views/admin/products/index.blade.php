@extends('layouts.admin')

@section('title', 'Nutrition Products & Editions - Danone Store Indonesia')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Catalogue Ledger &bull; {{ $products->total() }} Editions Registered
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Nutrition Products</h1>
            <p class="text-xs text-[#71717A] mt-1">Manage catalog specifications, workshop pricing, and craftsmanship details.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary text-xs py-2.5 px-5">
            + Create New Piece
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 border border-[#E8E4DC] rounded-sm">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by piece title or specification..." class="text-xs">
            </div>

            <div class="w-44">
                <select name="category" class="text-xs">
                    <option value="">All Spaces / Rooms</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-36">
                <select name="status" class="text-xs">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <button type="submit" class="btn-primary py-2.5 px-5 text-xs">Filter</button>

            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-[#71717A] hover:text-[#18181A] underline px-2">Reset</a>
            @endif
        </form>
    </div>

    {{-- Products Table --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                    <tr>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Piece & Space</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Valuation</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Workshop Stock</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Status</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Curated</th>
                        <th class="py-3.5 px-6 font-medium text-[10px] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E4DC]">
                    @forelse($products as $p)
                        @php
                            $primaryImg = $p->images ? $p->images->where('is_primary', true)->first() : null;
                            $imgPath = $primaryImg?->image_path;
                            $imageUrl = null;
                            if ($imgPath) {
                                $imageUrl = str_starts_with($imgPath, 'http') ? $imgPath : asset('storage/' . $imgPath);
                            }
                        @endphp
                        <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                            <td class="py-4 px-6 flex items-center space-x-3.5">
                                <div class="w-12 h-12 bg-[#EFECE6] rounded-xs overflow-hidden flex-shrink-0 border border-[#E8E4DC]">
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center font-serif text-sm text-[#71717A]">
                                            {{ substr($p->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <span class="font-medium text-[#18181A] block truncate max-w-xs">{{ $p->name }}</span>
                                    <span class="text-[10px] text-[#71717A] block mt-0.5">{{ $p->category->name ?? 'Curated Piece' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-serif text-sm font-medium text-[#18181A]">
                                ${{ number_format($p->price, 2) }}
                            </td>
                            <td class="py-4 px-6">
                                @if($p->stock > 5)
                                    <span class="badge badge-success">
                                        <span class="badge-dot"></span>
                                        {{ $p->stock }} in stock
                                    </span>
                                @elseif($p->stock > 0)
                                    <span class="badge badge-warning">
                                        <span class="badge-dot"></span>
                                        {{ $p->stock }} left
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <span class="badge-dot"></span>
                                        Exhausted
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="badge {{ $p->status === 'active' ? 'badge-info' : 'badge-neutral' }}">
                                    <span class="badge-dot"></span>
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($p->is_featured)
                                    <span class="inline-flex items-center text-[10px] text-[#D8C3A5] font-semibold tracking-wider uppercase bg-[#18181A] px-2 py-0.5 rounded-xs">
                                        ★ Monograph
                                    </span>
                                @else
                                    <span class="text-[#71717A] text-[11px]">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right space-x-3">
                                <a href="{{ route('admin.products.edit', $p->id) }}" class="text-[#18181A] hover:underline font-medium">Edit</a>
                                <a href="{{ route('products.show', $p->slug) }}" target="_blank" class="text-[#71717A] hover:text-[#18181A]">View ↗</a>
                                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive piece from atelier catalog?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#9E2B2B] hover:underline">Archive</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-[#71717A]">
                                No pieces found matching current catalogue filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
