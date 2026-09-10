@extends('layouts.admin')

@section('title', 'Collector Dossier: ' . $customer->name . ' - Nordic Atelier')

@section('content')
<div class="space-y-8 max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="flex items-center space-x-2 text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                <a href="{{ route('admin.customers.index') }}" class="hover:text-[#18181A]">&larr; Collector Directory</a>
                <span class="text-[#D8C3A5]">&bull;</span>
                <span>Client Profile</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-full bg-[#FAF8F3] border border-[#E8E4DC] flex items-center justify-center font-serif text-lg font-medium text-[#18181A]">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="font-serif text-3xl text-[#18181A] font-normal">{{ $customer->name }}</h1>
                    <span class="text-xs text-[#71717A]">Registered on {{ $customer->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="btn-secondary text-xs py-2 px-4">
            &larr; Back to Directory
        </a>
    </div>

    {{-- Metrics Strip --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 bg-white border border-[#E8E4DC] divide-y sm:divide-y-0 sm:divide-x divide-[#E8E4DC]">
        <div class="p-6 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Direct Inquiries</span>
            <span class="font-mono text-sm font-medium text-[#18181A] block">{{ $customer->email }}</span>
            <span class="text-[11px] text-[#71717A] block">{{ $customer->phone ?? 'No phone specified' }}</span>
        </div>

        <div class="p-6 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Total Commissions</span>
            <span class="font-serif text-2xl font-normal text-[#18181A] block">{{ $customer->orders->count() }}</span>
            <span class="text-[11px] text-[#71717A] block">Recorded acquisitions</span>
        </div>

        <div class="p-6 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Gross Valuation</span>
            <span class="font-serif text-2xl font-normal text-[#18181A] block">
                ${{ number_format($customer->orders->sum('total'), 2) }}
            </span>
            <span class="text-[11px] text-[#7A8B6F] block">Lifetime client volume</span>
        </div>
    </div>

    {{-- Acquisition Ledger --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden space-y-0">
        <div class="p-6 border-b border-[#E8E4DC] flex items-center justify-between">
            <div>
                <h2 class="font-serif text-xl text-[#18181A] font-medium">Acquisition Ledger</h2>
                <p class="text-xs text-[#71717A] mt-0.5">Chronological record of commissioned pieces and bespoke orders</p>
            </div>
            <span class="text-[10px] uppercase tracking-wider font-mono text-[#71717A]">
                {{ $customer->orders->count() }} {{ Str::plural('Record', $customer->orders->count()) }}
            </span>
        </div>

        <div class="divide-y divide-[#E8E4DC]">
            @forelse($customer->orders as $o)
                @php
                    $badgeClass = match($o->status) {
                        'completed' => 'badge-success',
                        'shipped' => 'badge-info',
                        'processing' => 'badge-warning',
                        'cancelled' => 'badge-danger',
                        default => 'badge-neutral',
                    };
                @endphp
                <div class="p-5 flex items-center justify-between hover:bg-[#FAF8F3]/40 transition-colors text-xs">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <span class="font-mono font-medium text-[#18181A]">#{{ $o->order_number }}</span>
                            <span class="badge {{ $badgeClass }}">
                                <span class="badge-dot"></span>
                                {{ ucfirst($o->status) }}
                            </span>
                        </div>
                        <span class="text-[11px] text-[#71717A] block">Commissioned on {{ $o->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    <div class="flex items-center space-x-6">
                        <span class="font-serif text-base font-medium text-[#18181A]">${{ number_format($o->total, 2) }}</span>
                        <a href="{{ route('admin.orders.show', $o->id) }}" class="inline-flex items-center text-xs text-[#18181A] hover:text-[#7A8B6F] font-medium">
                            <span>Inspect &rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-xs text-[#71717A]">
                    No past transactions recorded for this collector profile.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
