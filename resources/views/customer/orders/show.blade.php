@extends('layouts.customer')

@section('title', 'Order #' . $order->order_number . ' - Nordic Pure Nutrition')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="flex text-xs text-[#777777] mb-6 space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#1C1C1C]">Home</a>
        <span>/</span>
        <a href="{{ route('orders.index') }}" class="hover:text-[#1C1C1C]">Orders</a>
        <span>/</span>
        <span class="text-[#1C1C1C] font-mono">#{{ $order->order_number }}</span>
    </nav>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-[#E5E0D8] mb-8 gap-4">
        <div>
            <span class="text-xs uppercase tracking-wider text-[#777777] block">Order Detail</span>
            <h1 class="font-serif text-2xl sm:text-3xl text-[#1C1C1C]">#{{ $order->order_number }}</h1>
            <p class="text-xs text-[#777777] mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>
        <div>
            <span class="badge {{ $order->status === 'completed' ? 'badge-success' : ($order->status === 'cancelled' ? 'badge-danger' : 'badge-info') }} text-xs py-1.5 px-3">
                Status: {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Items List (8 cols) --}}
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white border border-[#E5E0D8] rounded overflow-hidden">
                <div class="p-4 bg-[#FAF8F3] border-b border-[#E5E0D8] font-serif text-sm font-semibold text-[#1C1C1C]">
                    Purchased Pieces
                </div>
                <div class="divide-y divide-[#E5E0D8]">
                    @foreach($order->items as $item)
                        <div class="p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div>
                                <h3 class="font-serif text-base text-[#1C1C1C]">{{ $item->product_name }}</h3>
                                <p class="text-xs text-[#777777]">${{ number_format($item->product_price, 2) }} × {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <span class="font-semibold text-sm text-[#1C1C1C]">${{ number_format($item->subtotal, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Shipping & Totals (4 cols) --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Delivery Address --}}
            <div class="bg-white border border-[#E5E0D8] rounded p-6 space-y-3 text-xs">
                <h3 class="font-serif text-base text-[#1C1C1C] border-b border-[#E5E0D8] pb-2 font-medium">Delivery Address</h3>
                @if($order->address)
                    <p class="font-semibold text-[#1C1C1C]">{{ $order->address->full_name }}</p>
                    <p class="text-[#777777]">{{ $order->address->address }}</p>
                    <p class="text-[#777777]">{{ $order->address->city }}, {{ $order->address->postal_code }}</p>
                    <p class="text-[#777777]">{{ $order->address->country }}</p>
                    <p class="text-[#777777] pt-2">Phone: {{ $order->address->phone }}</p>
                @else
                    <p class="text-[#777777] italic">Standard address recorded.</p>
                @endif
            </div>

            {{-- Breakdown --}}
            <div class="bg-white border border-[#E5E0D8] rounded p-6 space-y-3 text-xs">
                <h3 class="font-serif text-base text-[#1C1C1C] border-b border-[#E5E0D8] pb-2 font-medium">Payment Breakdown</h3>
                <div class="flex justify-between text-[#777777]">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount > 0)
                    <div class="flex justify-between text-[#7A8B6F]">
                        <span>Discount</span>
                        <span>-${{ number_format($order->discount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-[#777777]">
                    <span>White-Glove Delivery</span>
                    <span class="text-[#7A8B6F]">Complimentary</span>
                </div>
                <div class="border-t border-[#E5E0D8] pt-2 flex justify-between font-semibold text-sm text-[#1C1C1C]">
                    <span>Total</span>
                    <span class="font-serif text-lg">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
