@extends('layouts.admin')

@section('title', 'Admin Dashboard - Danone Store Indonesia')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div>
        <h1 class="font-serif text-3xl text-[#1C1C1C]">Executive Overview</h1>
        <p class="text-xs text-[#777777] mt-1">Real-time store performance, inventory levels, and orders.</p>
    </div>

    {{-- Metrics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777]">Total Revenue</span>
            <span class="font-serif text-3xl font-semibold text-[#1C1C1C] block mt-2">${{ number_format($totalRevenue, 2) }}</span>
            <span class="text-[11px] text-[#7A8B6F] mt-1 block">From completed purchases</span>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777]">Total Orders</span>
            <span class="font-serif text-3xl font-semibold text-[#1C1C1C] block mt-2">{{ $totalOrders }}</span>
            <span class="text-[11px] text-[#777777] mt-1 block">All registered transactions</span>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777]">Customers</span>
            <span class="font-serif text-3xl font-semibold text-[#1C1C1C] block mt-2">{{ $totalCustomers }}</span>
            <span class="text-[11px] text-[#777777] mt-1 block">Active client profiles</span>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777]">Products</span>
            <span class="font-serif text-3xl font-semibold text-[#1C1C1C] block mt-2">{{ $totalProducts }}</span>
            <span class="text-[11px] text-[#777777] mt-1 block">Live catalog offerings</span>
        </div>
    </div>

    {{-- Order Status Breakdown & Low Stock --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Recent Orders (8 cols) --}}
        <div class="lg:col-span-8 bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                <h2 class="font-serif text-lg text-[#1C1C1C]">Recent Transactions</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-[#1C1C1C] hover:underline font-medium">All Orders &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF8F3] text-[#777777] uppercase tracking-wider">
                        <tr>
                            <th class="p-3">Reference</th>
                            <th class="p-3">Customer</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5E0D8]">
                        @forelse($recentOrders as $ro)
                            <tr>
                                <td class="p-3 font-mono font-medium">#{{ $ro->order_number }}</td>
                                <td class="p-3">{{ $ro->user->name ?? 'Guest' }}</td>
                                <td class="p-3 font-semibold">${{ number_format($ro->total, 2) }}</td>
                                <td class="p-3">
                                    <span class="badge {{ $ro->status === 'completed' ? 'badge-success' : 'badge-info' }}">{{ ucfirst($ro->status) }}</span>
                                </td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('admin.orders.show', $ro->id) }}" class="text-[#1C1C1C] hover:underline">Manage</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-4 text-center text-[#777777]">No recent transactions.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Low Stock Alert (4 cols) --}}
        <div class="lg:col-span-4 bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                <h2 class="font-serif text-lg text-[#1C1C1C]">Inventory Monitor</h2>
                <a href="{{ route('admin.inventory.index') }}" class="text-xs text-[#1C1C1C] hover:underline font-medium">Restock &rarr;</a>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts as $lsp)
                    <div class="flex justify-between items-center text-xs p-2.5 bg-[#FAF8F3] rounded border border-[#E5E0D8]">
                        <div>
                            <span class="font-medium text-[#1C1C1C] block truncate max-w-[180px]">{{ $lsp->name }}</span>
                            <span class="text-[10px] text-[#777777]">{{ $lsp->category->name }}</span>
                        </div>
                        <span class="badge badge-warning text-[10px]">{{ $lsp->stock }} left</span>
                    </div>
                @empty
                    <p class="text-xs text-[#777777] italic text-center py-4">All stock levels adequate.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Best Selling Products --}}
    @if(isset($bestSellingProducts) && $bestSellingProducts->count() > 0)
        <div class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
            <h2 class="font-serif text-lg text-[#1C1C1C] border-b border-[#E5E0D8] pb-3">Top Selling Pieces</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach($bestSellingProducts as $bsp)
                    <div class="p-4 bg-[#FAF8F3] rounded border border-[#E5E0D8] space-y-1 text-xs">
                        <span class="font-medium text-[#1C1C1C] block truncate">{{ $bsp->name }}</span>
                        <span class="text-[#777777] block">${{ number_format($bsp->price, 2) }}</span>
                        <span class="text-[#7A8B6F] font-semibold text-[10px] block pt-1">{{ $bsp->total_sold ?? 0 }} units delivered</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
