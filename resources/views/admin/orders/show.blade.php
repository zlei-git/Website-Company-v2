@extends('layouts.admin')

@section('title', 'Consignment Dossier #' . $order->order_number . ' - NordicHome Atelier')

@section('content')
<div class="space-y-8 max-w-5xl mx-auto">
    {{-- Header Dossier Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="flex items-center space-x-2 text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                <a href="{{ route('admin.orders.index') }}" class="hover:text-[#18181A]">&larr; Atelier Dispatches</a>
                <span class="text-[#D8C3A5]">&bull;</span>
                <span>Commission Dossier</span>
            </div>
            <div class="flex items-baseline space-x-4">
                <h1 class="font-serif text-3xl md:text-4xl text-[#18181A] font-normal">#{{ $order->order_number }}</h1>
                <span class="text-xs font-mono text-[#71717A]">Issued: {{ $order->created_at->format('d M Y, H:i') }} CET</span>
            </div>
        </div>

        {{-- Status Dispatch Updater --}}
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center space-x-3 bg-white border border-[#E8E4DC] p-2 rounded-sm">
            @csrf
            @method('PATCH')
            <label class="text-[10px] uppercase tracking-wider text-[#71717A] font-medium pl-1">Fulfillment:</label>
            <select name="status" class="text-xs py-1.5 px-3 bg-[#FAF8F3] border-[#E8E4DC] rounded-sm">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending Allocation</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>In Workshop Crafting</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dispatched / En Route</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Delivered & Installed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Revoked / Cancelled</option>
            </select>
            <button type="submit" class="btn-primary py-1.5 px-4 text-xs">Update</button>
        </form>
    </div>

    {{-- Dossier Columns --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Commissioned Pieces (8 cols) --}}
        <div class="lg:col-span-8 bg-white border border-[#E8E4DC] rounded-sm overflow-hidden space-y-0">
            <div class="p-6 border-b border-[#E8E4DC] flex items-center justify-between">
                <div>
                    <h2 class="font-serif text-xl text-[#18181A] font-medium">Commissioned Editions</h2>
                    <p class="text-xs text-[#71717A] mt-0.5">{{ $order->items->count() }} unique {{ Str::plural('piece', $order->items->count()) }} in this consignment</p>
                </div>
                <span class="text-[10px] uppercase tracking-wider font-mono px-2.5 py-1 bg-[#FAF8F3] border border-[#E8E4DC] text-[#71717A]">
                    Verified Atelier Origin
                </span>
            </div>

            <div class="divide-y divide-[#E8E4DC]">
                @foreach($order->items as $item)
                    @php
                        $itemImg = $item->product?->primaryImage ?? $item->product?->productImages?->first();
                        $imgPath = $itemImg?->image_path;
                        $imageUrl = null;
                        if ($imgPath) {
                            $imageUrl = str_starts_with($imgPath, 'http') ? $imgPath : asset('storage/' . $imgPath);
                        }
                    @endphp
                    <div class="p-6 flex items-center justify-between gap-4 hover:bg-[#FAF8F3]/30 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-[#EFECE6] rounded-xs overflow-hidden flex-shrink-0 border border-[#E8E4DC]">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center font-serif text-sm text-[#71717A]">
                                        {{ substr($item->product_name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-medium text-sm text-[#18181A]">{{ $item->product_name }}</h3>
                                <p class="text-xs text-[#71717A] mt-0.5">
                                    ${{ number_format($item->product_price, 2) }} &times; {{ $item->quantity }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-serif text-base font-medium text-[#18181A] block">
                                ${{ number_format($item->subtotal, 2) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Valuation Summary Ledger --}}
            <div class="p-6 bg-[#FAF8F3] border-t border-[#E8E4DC] space-y-3 text-xs">
                <div class="flex justify-between text-[#71717A]">
                    <span>Atelier Catalogue Subtotal</span>
                    <span class="font-mono">${{ number_format($order->total, 2) }}</span>
                </div>
                <div class="flex justify-between text-[#71717A]">
                    <span>White-Glove Architectural Transport</span>
                    <span class="text-[#7A8B6F] uppercase tracking-wider font-semibold text-[10px]">Complimentary</span>
                </div>
                @if($order->coupon)
                    <div class="flex justify-between text-[#7A8B6F]">
                        <span>Promotional Concession ({{ $order->coupon->code }})</span>
                        <span class="font-mono">Applied</span>
                    </div>
                @endif
                <div class="border-t border-[#E8E4DC] pt-3 flex justify-between items-baseline">
                    <span class="font-serif text-base text-[#18181A] font-medium">Total Ledger Valuation</span>
                    <span class="font-serif text-2xl text-[#18181A] font-semibold">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Client & Delivery Dossier (4 cols) --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Client Dossier --}}
            <div class="bg-white border border-[#E8E4DC] rounded-sm p-6 space-y-4 text-xs">
                <div class="border-b border-[#E8E4DC] pb-3">
                    <span class="text-[10px] uppercase tracking-wider text-[#71717A] font-medium block">Collector Profile</span>
                    <h3 class="font-serif text-lg text-[#18181A] font-medium mt-1">{{ $order->user->name ?? 'Guest Client' }}</h3>
                </div>
                <div class="space-y-2 text-[#71717A]">
                    <div class="flex items-center space-x-2">
                        <span class="text-[#18181A] font-medium">Email:</span>
                        <span>{{ $order->user->email ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[#18181A] font-medium">Phone:</span>
                        <span>{{ $order->user->phone ?? 'Not provided' }}</span>
                    </div>
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="bg-white border border-[#E8E4DC] rounded-sm p-6 space-y-4 text-xs">
                <div class="border-b border-[#E8E4DC] pb-3">
                    <span class="text-[10px] uppercase tracking-wider text-[#71717A] font-medium block">Installation Destination</span>
                    <h3 class="font-serif text-lg text-[#18181A] font-medium mt-1">Delivery Address</h3>
                </div>
                @if($order->address)
                    <div class="space-y-1.5 text-[#71717A] leading-relaxed">
                        <p class="font-medium text-[#18181A]">{{ $order->address->full_name }}</p>
                        <p>{{ $order->address->address }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->postal_code }}</p>
                        <p class="text-[#18181A] font-medium">{{ $order->address->country }}</p>
                        @if($order->address->phone)
                            <p class="pt-2 text-[11px] text-[#71717A]">Recipient Contact: {{ $order->address->phone }}</p>
                        @endif
                    </div>
                @else
                    <p class="text-[#71717A] italic">No physical destination specified for this record.</p>
                @endif
            </div>

            {{-- Operations Print/Actions --}}
            <div class="p-6 bg-[#FAF8F3] border border-[#E8E4DC] rounded-sm space-y-3">
                <button onclick="window.print()" class="btn-secondary w-full py-2.5 text-xs text-center block">
                    Print Consignment Waybill
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
