@extends('layouts.customer')

@section('title', 'Commission Confirmed - NordicHome Atelier')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    {{-- Monogram Atelier Seal --}}
    <div class="w-16 h-16 rounded-full bg-[#FAF8F3] border border-[#E8E4DC] flex items-center justify-center mx-auto mb-6 shadow-xs">
        <svg class="w-7 h-7 text-[#7A8B6F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7"/></svg>
    </div>

    <span class="text-[10px] uppercase tracking-[0.3em] text-[#7A8B6F] font-semibold block mb-2">Tusind Tak &bull; Commission Registered</span>
    <h1 class="font-serif text-3xl sm:text-5xl text-[#18181A] font-normal tracking-tight">Your Pieces are Commissioned</h1>
    <p class="text-xs sm:text-sm text-[#71717A] font-light leading-relaxed max-w-lg mx-auto mt-3 mb-10">
        We have formally registered consignment <strong class="text-[#18181A] font-mono">#{{ $order->order_number }}</strong>. Our Copenhagen workshop is preparing your editions with traditional Nordic joinery.
    </p>

    {{-- Atelier Receipt Monograph --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm p-8 sm:p-10 text-left space-y-6 mb-10 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#E8E4DC] pb-5 gap-3">
            <div>
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#71717A] font-semibold block">Consignment Reference</span>
                <span class="font-mono text-sm font-medium text-[#18181A]">#{{ $order->order_number }}</span>
            </div>
            <div class="sm:text-right">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#71717A] font-semibold block">Workshop Status</span>
                <span class="badge badge-info mt-1">
                    <span class="badge-dot"></span>
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div>
            <h3 class="text-[10px] uppercase tracking-[0.2em] text-[#71717A] font-semibold mb-4">Commissioned Pieces</h3>
            <div class="divide-y divide-[#E8E4DC]">
                @foreach($order->items as $item)
                    <div class="py-3 flex justify-between items-center text-xs">
                        <div class="space-y-0.5">
                            <span class="font-medium text-[#18181A]">{{ $item->product_name }}</span>
                            <span class="text-[10px] text-[#71717A] block">{{ $item->quantity }} &times; ${{ number_format($item->product_price, 2) }}</span>
                        </div>
                        <span class="font-serif font-medium text-sm text-[#18181A]">${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="border-t border-[#E8E4DC] pt-5 space-y-2 text-xs">
            <div class="flex justify-between text-[#71717A]">
                <span>Architectural White-Glove Delivery</span>
                <span class="text-[#7A8B6F] uppercase tracking-wider font-semibold text-[10px]">Complimentary</span>
            </div>
            <div class="flex justify-between items-baseline pt-2 border-t border-[#E8E4DC]">
                <span class="font-serif text-base text-[#18181A]">Total Valuation</span>
                <span class="font-serif text-2xl text-[#18181A] font-semibold">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('orders.show', $order->id) }}" class="btn-primary text-xs py-3 px-8">
            Review Consignment Dossier
        </a>
        <a href="{{ route('products.index') }}" class="btn-secondary text-xs py-3 px-8">
            Explore Scandinavian Catalog
        </a>
    </div>
</div>
@endsection
