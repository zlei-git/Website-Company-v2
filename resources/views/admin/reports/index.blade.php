@extends('layouts.admin')

@section('title', 'Financial Audits & Atelier Reports - Danone Store Indonesia')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Studio Financials &bull; Fiscal Performance
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Atelier Reports</h1>
            <p class="text-xs text-[#71717A] mt-1">Periodical fiscal analysis, spatial revenue breakdown, and average acquisition value.</p>
        </div>

        {{-- Date Filter --}}
        <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap items-center gap-2 bg-white border border-[#E8E4DC] p-2 rounded-sm">
            <input type="date" name="start_date" value="{{ request('start_date', $startDate ?? date('Y-m-01')) }}" class="text-xs py-1 px-2 border-[#E8E4DC] rounded-xs font-mono">
            <span class="text-xs text-[#71717A]">&rarr;</span>
            <input type="date" name="end_date" value="{{ request('end_date', $endDate ?? date('Y-m-d')) }}" class="text-xs py-1 px-2 border-[#E8E4DC] rounded-xs font-mono">
            <button type="submit" class="btn-primary py-1.5 px-3 text-xs uppercase tracking-wider">Filter</button>
        </form>
    </div>

    {{-- Period Metric Strip --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 bg-white border border-[#E8E4DC] divide-y sm:divide-y-0 sm:divide-x divide-[#E8E4DC]">
        <div class="p-6 lg:p-8 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Period Revenue</span>
            <div class="font-serif text-3xl font-normal text-[#18181A]">
                ${{ number_format($periodRevenue ?? 0, 2) }}
            </div>
            <span class="text-[11px] text-[#7A8B6F] block">Commission receipts</span>
        </div>

        <div class="p-6 lg:p-8 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Period Dispatches</span>
            <div class="font-serif text-3xl font-normal text-[#18181A]">
                {{ $periodOrders ?? 0 }}
            </div>
            <span class="text-[11px] text-[#71717A] block">Fulfilled client consignments</span>
        </div>

        <div class="p-6 lg:p-8 space-y-1">
            <span class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-medium block">Average Acquisition Value</span>
            <div class="font-serif text-3xl font-normal text-[#18181A]">
                ${{ number_format(($periodOrders ?? 0) > 0 ? ($periodRevenue ?? 0) / $periodOrders : 0, 2) }}
            </div>
            <span class="text-[11px] text-[#71717A] block">Mean commission volume</span>
        </div>
    </div>

    {{-- Spatial Revenue Breakdown --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm p-6 lg:p-8 space-y-6">
        <div class="border-b border-[#E8E4DC] pb-4">
            <h2 class="font-serif text-xl text-[#18181A] font-medium">Revenue by Living Space</h2>
            <p class="text-xs text-[#71717A] mt-0.5">Distribution of acquisitions across interior design zones</p>
        </div>

        <div class="space-y-4">
            @forelse($categoryRevenue ?? [] as $cr)
                <div class="flex items-center justify-between p-4 bg-[#FAF8F3]/50 border border-[#E8E4DC] text-xs">
                    <span class="font-medium text-[#18181A] text-sm">{{ $cr->name }}</span>
                    <span class="font-serif font-medium text-base text-[#18181A]">${{ number_format($cr->total_revenue ?? 0, 2) }}</span>
                </div>
            @empty
                <p class="text-xs text-[#71717A] italic py-4 text-center">No category revenue recorded in this fiscal window.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
