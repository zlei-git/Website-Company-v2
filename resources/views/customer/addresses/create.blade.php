@extends('layouts.customer')

@section('title', 'Add New Address - Nordic Pure Nutrition')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="border-b border-[#E5E0D8] pb-4 mb-8">
        <span class="text-xs uppercase tracking-[0.2em] text-[#777777] font-semibold block mb-1">Address Book</span>
        <h1 class="font-serif text-3xl text-[#1C1C1C]">Add Delivery Address</h1>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded">
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif

    <div class="bg-white border border-[#E5E0D8] rounded p-6 sm:p-8">
        <form action="{{ route('customer.addresses.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Label (e.g. Home, Studio, Summerhouse)</label>
                <input type="text" name="label" value="{{ old('label', 'Home') }}">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Recipient Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Phone Number *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Street Address *</label>
                <input type="text" name="address" value="{{ old('address') }}" required>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">City *</label>
                    <input type="text" name="city" value="{{ old('city') }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Postal Code *</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Country *</label>
                    <input type="text" name="country" value="{{ old('country', 'Sweden') }}" required>
                </div>
            </div>
            <div class="pt-2">
                <label class="flex items-center text-xs text-[#555555] cursor-pointer">
                    <input type="checkbox" name="is_default" value="1" class="mr-2 rounded text-[#1C1C1C] focus:ring-[#D8C3A5]">
                    <span>Set as primary default address</span>
                </label>
            </div>
            <div class="pt-4 flex items-center space-x-4">
                <button type="submit" class="btn-primary text-xs">Save Address</button>
                <a href="{{ route('customer.addresses.index') }}" class="text-xs text-[#777777] hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
