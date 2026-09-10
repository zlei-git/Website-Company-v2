@extends('layouts.admin')

@section('title', 'Promotional Codes & Vouchers - Danone Operations')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Campaign Privileges &bull; Promotional Vouchers Ledger
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Promotional Codes & Vouchers</h1>
            <p class="text-xs text-[#71717A] mt-1">Manage discount privileges, campaign coupon codes, and redemption limits.</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="btn-primary text-xs py-2.5 px-5">
            + Create New Voucher
        </a>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden shadow-xs">
        <table class="w-full text-left text-xs">
            <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider text-[10px] border-b border-[#E8E4DC]">
                <tr>
                    <th class="py-3.5 px-6 font-semibold">Voucher Code</th>
                    <th class="py-3.5 px-6 font-semibold">Discount</th>
                    <th class="py-3.5 px-6 font-semibold">Min Purchase</th>
                    <th class="py-3.5 px-6 font-semibold">Validity Period</th>
                    <th class="py-3.5 px-6 font-semibold">Redemptions</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8E4DC]">
                @foreach($coupons as $c)
                    <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                        <td class="py-4 px-6 font-mono font-bold text-[#18181A]">{{ $c->code }}</td>
                        <td class="py-4 px-6 font-semibold text-[#18181A]">
                            {{ $c->discount_type === 'percentage' ? $c->discount_value . '%' : '$' . number_format($c->discount_value, 2) }}
                        </td>
                        <td class="py-4 px-6 text-[#52525B]">${{ number_format($c->min_purchase ?? 0, 2) }}</td>
                        <td class="py-4 px-6 text-[#71717A]">{{ $c->start_date->format('M d') }} – {{ $c->end_date->format('M d, Y') }}</td>
                        <td class="py-4 px-6 text-[#52525B] font-mono">{{ $c->times_used }} / {{ $c->usage_limit ?? '∞' }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold {{ $c->is_active ? 'bg-[#F0F4EE] text-[#4A6342]' : 'bg-[#FAF8F3] text-[#71717A]' }}">
                                {{ $c->is_active ? 'Active' : 'Disabled' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('admin.coupons.edit', $c->id) }}" class="text-[#18181A] hover:text-[#7A8B6F] font-semibold underline">Edit</a>
                            <form action="{{ route('admin.coupons.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete voucher code?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
