@extends('layouts.admin')

@section('title', 'Edit Coupon - Danone Admin')

@section('content')
<div class="max-w-2xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Edit Coupon: {{ $coupon->code }}</h1>

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Coupon Code *</label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required class="uppercase">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Discount Type *</label>
                <select name="discount_type" class="text-xs">
                    <option value="percentage" {{ $coupon->discount_type === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="fixed" {{ $coupon->discount_type === 'fixed' ? 'selected' : '' }}>Fixed Dollar ($)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Discount Value *</label>
                <input type="number" step="0.01" name="discount_value" value="{{ old('discount_value', $coupon->discount_value) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Min Purchase ($)</label>
                <input type="number" step="0.01" name="min_purchase" value="{{ old('min_purchase', $coupon->min_purchase) }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $coupon->start_date->format('Y-m-d')) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">End Date *</label>
                <input type="date" name="end_date" value="{{ old('end_date', $coupon->end_date->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Total Usage Limit</label>
            <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}">
        </div>

        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $coupon->is_active ? 'checked' : '' }} class="mr-2 rounded text-[#1C1C1C]">
                <span>Active</span>
            </label>
        </div>

        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Update Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
