@extends('layouts.admin')

@section('title', 'New Coupon - Danone Admin')

@section('content')
<div class="max-w-2xl space-y-6">
    <h1 class="font-serif text-2xl text-[#1C1C1C]">Create Promotion Coupon</h1>

    <form action="{{ route('admin.coupons.store') }}" method="POST" class="bg-white border border-[#E5E0D8] rounded p-6 space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Coupon Code *</label>
                <input type="text" name="code" required placeholder="e.g. DANONE10" class="uppercase">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Discount Type *</label>
                <select name="discount_type" class="text-xs">
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Dollar ($)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Discount Value *</label>
                <input type="number" step="0.01" name="discount_value" required placeholder="10.00">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Min Purchase ($)</label>
                <input type="number" step="0.01" name="min_purchase" placeholder="100.00">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Start Date *</label>
                <input type="date" name="start_date" value="{{ date('Y-m-d') }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">End Date *</label>
                <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime('+3 months')) }}" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Total Usage Limit</label>
            <input type="number" name="usage_limit" placeholder="Leave empty for unlimited">
        </div>

        <div>
            <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="mr-2 rounded text-[#1C1C1C]">
                <span>Active</span>
            </label>
        </div>

        <div class="pt-4 flex items-center space-x-4 border-t border-[#E5E0D8]">
            <button type="submit" class="btn-primary text-xs">Save Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
