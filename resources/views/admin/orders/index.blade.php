@extends('layouts.admin')

@section('title', 'Consignment Dispatches & Logistics - Danone Store Indonesia')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Atelier Logistics &bull; {{ $orders->total() }} Recorded Consignments
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Client Dispatches</h1>
            <p class="text-xs text-[#71717A] mt-1">Fulfillment tracking, white-glove transport, and client delivery dossiers.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs py-2 px-4">
                &larr; Studio Overview
            </a>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 border border-[#E8E4DC] rounded-sm">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search consignment reference #..." class="text-xs">
            </div>

            <div class="w-44">
                <select name="status" class="text-xs">
                    <option value="">All Fulfillment Stages</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Allocation</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Workshop Crafting</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dispatched / En Route</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Delivered & Installed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Revoked / Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn-primary py-2.5 px-5 text-xs">Filter</button>

            @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-[#71717A] hover:text-[#18181A] underline px-2">Reset</a>
            @endif
        </form>
    </div>

    {{-- Orders Table --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                    <tr>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Consignment #</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Client / Collector</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Commission Date</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Valuation</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Status</th>
                        <th class="py-3.5 px-6 font-medium text-[10px] text-right">Dossier</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E4DC]">
                    @forelse($orders as $o)
                        @php
                            $badgeClass = match($o->status) {
                                'completed' => 'badge-success',
                                'shipped' => 'badge-info',
                                'processing' => 'badge-warning',
                                'cancelled' => 'badge-danger',
                                default => 'badge-neutral',
                            };
                        @endphp
                        <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                            <td class="py-4 px-6 font-mono font-medium text-[#18181A]">
                                #{{ $o->order_number }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-medium text-[#18181A] block">{{ $o->user->name ?? 'Guest Client' }}</span>
                                <span class="text-[10px] text-[#71717A] block mt-0.5">{{ $o->user->email ?? 'Direct Consignment' }}</span>
                            </td>
                            <td class="py-4 px-6 text-[#71717A]">
                                <span class="text-xs text-[#18181A] block">{{ $o->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-[#71717A] block mt-0.5">{{ $o->created_at->format('H:i') }} CET</span>
                            </td>
                            <td class="py-4 px-6 font-serif text-sm font-medium text-[#18181A]">
                                ${{ number_format($o->total, 2) }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="badge {{ $badgeClass }}">
                                    <span class="badge-dot"></span>
                                    {{ ucfirst($o->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $o->id) }}" class="inline-flex items-center space-x-1 text-xs font-medium text-[#18181A] hover:text-[#7A8B6F] transition-colors">
                                    <span>Inspect</span>
                                    <span class="text-[10px]">&rarr;</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-[#71717A]">
                                No consignments recorded matching the specified filter criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $orders->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
