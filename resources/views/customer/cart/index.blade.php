@extends('layouts.customer')

@section('title', 'Shopping Bag - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="border-b border-[#E8E4DC] pb-6 mb-10 flex items-baseline justify-between">
        <div>
            <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold block mb-1">Acquisition</span>
            <h1 class="font-serif text-3xl sm:text-4xl text-[#18181A]">Your Selected Pieces</h1>
        </div>
        <a href="{{ route('products.index') }}" class="text-xs uppercase tracking-widest text-[#71717A] hover:text-[#18181A]">&larr; Return to Catalog</a>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            {{-- Pieces List (8 cols) --}}
            <div class="lg:col-span-8 bg-white border border-[#E8E4DC] rounded-sm divide-y divide-[#E8E4DC]">
                @foreach($cartItems as $item)
                    <div class="p-6 flex flex-col sm:flex-row items-center gap-6">
                        {{-- Thumbnail --}}
                        <div class="w-24 h-24 bg-[#FAF8F3] border border-[#E8E4DC] rounded-sm overflow-hidden flex-shrink-0">
                            <img src="{{ $item->product->images->first()?->image_url ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&q=80' }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-full h-full object-cover">
                        </div>

                        {{-- Details --}}
                        <div class="flex-grow space-y-1 text-center sm:text-left">
                            <span class="text-[9px] uppercase tracking-wider text-[#A1A1AA]">{{ $item->product->category->name }}</span>
                            <h2 class="font-serif text-lg text-[#18181A]">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-[#7A8B6F]">{{ $item->product->name }}</a>
                            </h2>
                            <p class="font-mono text-xs text-[#71717A]">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>

                        {{-- Qty Updater --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" 
                                   class="w-16 text-center text-xs py-1.5 px-2 border-[#E8E4DC] rounded-none font-mono" 
                                   onchange="this.form.submit()">
                        </form>

                        {{-- Subtotal & Remove --}}
                        <div class="text-right flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto gap-2">
                            <span class="font-mono font-semibold text-sm text-[#18181A]">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[11px] text-[#9E2B2B] hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="p-4 bg-[#FAF8F3] flex justify-between items-center text-xs text-[#71717A]">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="hover:text-[#9E2B2B] underline">Kosongkan Keranjang</button>
                    </form>
                    <span class="text-[#00965E] font-medium">✓ Pengiriman Higienis Rantai Dingin Aktif</span>
                </div>
            </div>

            {{-- Summary Sidebar (4 cols) --}}
            <aside class="lg:col-span-4 bg-white border border-[#E8E4DC] rounded-sm p-6 space-y-6">
                <h3 class="font-serif text-lg text-[#18181A] border-b border-[#E8E4DC] pb-3">Ringkasan Pesanan</h3>

                <div class="space-y-3 text-xs">
                    <div class="flex justify-between text-[#71717A]">
                        <span>Subtotal Produk</span>
                        <span class="font-mono font-medium text-[#18181A]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    @if($coupon)
                        <div class="flex justify-between text-[#00965E]">
                            <span>Potongan Kupon ({{ is_object($coupon) ? $coupon->code : ($coupon['code'] ?? '') }})</span>
                            <span class="font-mono font-semibold">-Rp {{ number_format($discount, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between text-[#71717A]">
                        <span>Pengiriman Khusus</span>
                        <span class="text-[#00965E] uppercase tracking-wider text-[10px] font-bold">Gratis</span>
                    </div>

                    <div class="border-t border-[#E8E4DC] pt-4 flex justify-between text-sm font-semibold text-[#18181A]">
                        <span>Total Pembayaran</span>
                        <span class="font-mono text-xl text-[#002D72]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Coupon Input --}}
                <div class="border-t border-[#E8E4DC] pt-4">
                    @if($coupon)
                        <div class="flex items-center justify-between bg-[#F0FDF4] border border-[#BBF7D0] p-2.5 rounded-sm text-xs">
                            <span class="font-mono font-semibold text-[#00965E]">Kupon {{ is_object($coupon) ? $coupon->code : ($coupon['code'] ?? '') }} aktif</span>
                            <form action="{{ route('cart.removeCoupon') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#9E2B2B] hover:underline text-[11px]">&times; Hapus</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="code" placeholder="Code (e.g. DANONE10)" class="text-xs uppercase" required>
                            <button type="submit" class="btn-secondary py-2 px-3 text-[11px] flex-shrink-0">Apply</button>
                        </form>
                    @endif
                </div>

                <a href="{{ route('checkout.index') }}" class="btn-primary w-full text-center block py-3.5 tracking-widest text-xs">
                    Proceed to Delivery &rarr;
                </a>
            </aside>
        </div>
    @else
        <div class="bg-white border border-[#E8E4DC] rounded-sm p-16 text-center max-w-lg mx-auto space-y-4">
            <span class="text-3xl">💧</span>
            <h2 class="font-serif text-2xl text-[#18181A]">Your shopping bag is empty</h2>
            <p class="text-xs text-[#71717A] font-light leading-relaxed">
                Discover our single-origin volcanic spring waters, living probiotic yogurts, and organic plant milks.
            </p>
            <div class="pt-4">
                <a href="{{ route('products.index') }}" class="btn-primary inline-block text-xs tracking-widest">Explore Products</a>
            </div>
        </div>
    @endif
</div>
@endsection
