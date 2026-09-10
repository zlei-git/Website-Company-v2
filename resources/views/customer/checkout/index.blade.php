@extends('layouts.customer')

@section('title', 'Finalize Acquisition - Danone Store Indonesia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="border-b border-[#E8E4DC] pb-6 mb-10">
        <span class="text-[10px] uppercase tracking-[0.25em] text-[#7A8B6F] font-semibold block mb-1">Final Step</span>
        <h1 class="font-serif text-3xl sm:text-4xl text-[#18181A]">Delivery & Acquisition</h1>
    </div>

    @if($errors->any())
        <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 text-xs rounded-sm">
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            {{-- Form Column (7 cols) --}}
            <div class="lg:col-span-7 bg-white border border-[#E8E4DC] rounded-sm p-8 space-y-6">
                <h2 class="font-serif text-xl text-[#18181A] border-b border-[#E8E4DC] pb-3">Destination Details</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Recipient Full Name *</label>
                        <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Direct Telephone *</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Street Address & Residence *</label>
                    <input type="text" name="address" value="{{ old('address') }}" required placeholder="Street address, building, apartment">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">City *</label>
                        <input type="text" name="city" value="{{ old('city') }}" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Postal Code *</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Country *</label>
                        <input type="text" name="country" value="{{ old('country', 'Sweden') }}" required>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#18181A] mb-1.5">Catatan Khusus Pengiriman (Opsional)</label>
                    <textarea name="notes" rows="3" placeholder="Petunjuk alamat, lantai/gedung, atau nomor kontak alternatif penerima.">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Summary Column (5 cols) --}}
            <aside class="lg:col-span-5 bg-white border border-[#E8E4DC] rounded-sm p-8 space-y-6">
                <h2 class="font-serif text-xl text-[#18181A] border-b border-[#E8E4DC] pb-3">Ringkasan Pesanan</h2>

                <div class="divide-y divide-[#E8E4DC] max-h-72 overflow-y-auto pr-1">
                    @foreach($cartItems as $item)
                        <div class="py-3 flex justify-between items-center text-xs">
                            <div>
                                <p class="font-serif font-medium text-[#18181A] text-sm">{{ $item->product->name }}</p>
                                <p class="text-[#71717A] text-[11px] font-mono">{{ $item->quantity }}x @ Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="font-mono font-semibold text-[#18181A]">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-3 pt-3 border-t border-[#E8E4DC] text-xs">
                    <div class="flex justify-between text-[#71717A]">
                        <span>Subtotal Produk</span>
                        <span class="font-mono text-[#18181A]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
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

                    <div class="border-t border-[#E8E4DC] pt-4 flex justify-between text-base font-semibold text-[#18181A]">
                        <span>Total Pembayaran</span>
                        <span class="font-mono text-2xl text-[#002D72]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 tracking-widest text-xs">
                    Konfirmasi dan Pesan Sekarang &rarr;
                </button>

                <p class="text-[10px] text-center text-[#71717A] leading-relaxed">
                    Pesanan Anda akan langsung diproses dan dikemas higienis dengan standar rantai dingin. Konfirmasi serta nomor resi pengiriman akan dikirimkan ke email Anda.
                </p>
            </aside>
        </div>
    </form>
</div>
@endsection
