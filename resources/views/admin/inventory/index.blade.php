@extends('layouts.admin')

@section('title', 'Workshop Reserve & Inventory - NordicHome Atelier')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Material Allocation &bull; Copenhagen Workshop
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Workshop Reserve</h1>
            <p class="text-xs text-[#71717A] mt-1">Audit finished editions, adjust workshop quantities, and flag replenishment orders.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs py-2 px-4">
                &larr; Studio Overview
            </a>
        </div>
    </div>

    {{-- Inventory Table --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                    <tr>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Nutrition Product</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Space / Living Area</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Reserve Units</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Reserve Health</th>
                        <th class="py-3.5 px-6 font-medium text-[10px] text-right">Quick Allocation</th>
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
                                <div class="w-10 h-10 bg-[#EFECE6] rounded-xs overflow-hidden flex-shrink-0 border border-[#E8E4DC]">
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center font-serif text-xs text-[#71717A]">
                                            {{ substr($p->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-medium text-[#18181A] block">{{ $p->name }}</span>
                                    <span class="font-mono text-[10px] text-[#71717A] block mt-0.5">${{ number_format($p->price, 2) }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-[#71717A]">
                                {{ $p->category->name ?? 'Standard Edition' }}
                            </td>
                            <td class="py-4 px-6 font-mono font-medium text-[#18181A] text-sm">
                                {{ $p->stock }}
                            </td>
                            <td class="py-4 px-6">
                                @if($p->stock > 5)
                                    <span class="badge badge-success">
                                        <span class="badge-dot"></span>
                                        Optimal Reserve
                                    </span>
                                @elseif($p->stock > 0)
                                    <span class="badge badge-warning">
                                        <span class="badge-dot"></span>
                                        Low Reserve (Restock)
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <span class="badge-dot"></span>
                                        Exhausted
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.inventory.update', $p->id) }}" method="POST" class="inline-flex items-center justify-end space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="stock" value="{{ $p->stock }}" min="0" class="w-20 py-1 px-2 text-xs font-mono text-center border-[#E8E4DC]">
                                    <button type="submit" class="btn-primary py-1 px-3 text-[10px] tracking-wider uppercase">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-[#71717A]">
                                No inventory records found in the workshop catalog.
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
