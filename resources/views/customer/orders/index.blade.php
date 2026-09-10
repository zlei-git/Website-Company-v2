@extends('layouts.customer')

@section('title', 'Your Commission Ledger - NordicHome Atelier')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Collector Account &bull; Atelier History
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl text-[#18181A] font-normal">Your Commissions</h1>
            <p class="text-xs text-[#71717A] mt-1">Review your bespoke orders, track workshop dispatch status, and download invoices.</p>
        </div>
        <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#18181A] hover:underline font-medium">&larr; Return to Profile</a>
    </div>

    @if($orders->count() > 0)
        <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                        <tr>
                            <th class="py-3.5 px-6 font-medium text-[10px]">Reference #</th>
                            <th class="py-3.5 px-6 font-medium text-[10px]">Commission Date</th>
                            <th class="py-3.5 px-6 font-medium text-[10px]">Editions</th>
                            <th class="py-3.5 px-6 font-medium text-[10px]">Valuation</th>
                            <th class="py-3.5 px-6 font-medium text-[10px]">Workshop Status</th>
                            <th class="py-3.5 px-6 font-medium text-[10px] text-right">Dossier</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8E4DC]">
                        @foreach($orders as $order)
                            @php
                                $badgeClass = match($order->status) {
                                    'completed' => 'badge-success',
                                    'shipped' => 'badge-info',
                                    'processing' => 'badge-warning',
                                    'cancelled' => 'badge-danger',
                                    default => 'badge-neutral',
                                };
                            @endphp
                            <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                                <td class="py-4 px-6 font-mono font-medium text-[#18181A]">
                                    #{{ $order->order_number }}
                                </td>
                                <td class="py-4 px-6 text-[#71717A]">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="py-4 px-6 text-[#18181A]">
                                    {{ $order->items->count() }} {{ Str::plural('piece', $order->items->count()) }}
                                </td>
                                <td class="py-4 px-6 font-serif text-sm font-medium text-[#18181A]">
                                    ${{ number_format($order->total, 2) }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="badge {{ $badgeClass }}">
                                        <span class="badge-dot"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center space-x-1 text-xs font-medium text-[#18181A] hover:text-[#7A8B6F] transition-colors">
                                        <span>View Dossier</span>
                                        <span class="text-[10px]">&rarr;</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
                <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="bg-white border border-[#E8E4DC] rounded-sm p-16 text-center space-y-4">
            <span class="text-3xl">🪵</span>
            <h3 class="font-serif text-2xl text-[#18181A]">No commissions recorded yet</h3>
            <p class="text-xs text-[#71717A] max-w-sm mx-auto">When you acquire handcrafted Scandinavian pieces, your full consignment ledger will be accessible here.</p>
            <a href="{{ route('products.index') }}" class="btn-primary text-xs inline-block mt-2">Explore Atelier Collection</a>
        </div>
    @endif
</div>
@endsection
