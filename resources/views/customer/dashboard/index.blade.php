@extends('layouts.customer')

@section('title', 'Customer Dashboard - Nordic Pure Nutrition')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="border-b border-[#E5E0D8] pb-6 mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold block mb-1">Welcome</span>
            <h1 class="font-serif text-3xl sm:text-4xl text-[#1C1C1C]">{{ auth()->user()->name }}</h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('profile.edit') }}" class="btn-secondary py-2 px-4 text-xs">Profile Settings</a>
            <a href="{{ route('customer.addresses.index') }}" class="btn-secondary py-2 px-4 text-xs">Saved Addresses</a>
        </div>
    </div>

    {{-- Metrics Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777] block">Total Orders</span>
            <span class="font-serif text-3xl text-[#1C1C1C] font-semibold block mt-2">{{ $ordersCount ?? 0 }}</span>
            <a href="{{ route('orders.index') }}" class="text-[11px] text-[#7A8B6F] hover:underline mt-2 inline-block">View Orders &rarr;</a>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777] block">Wishlist Items</span>
            <span class="font-serif text-3xl text-[#1C1C1C] font-semibold block mt-2">{{ $wishlistCount ?? 0 }}</span>
            <a href="{{ route('wishlist.index') }}" class="text-[11px] text-[#7A8B6F] hover:underline mt-2 inline-block">View Saved &rarr;</a>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777] block">Reviews Given</span>
            <span class="font-serif text-3xl text-[#1C1C1C] font-semibold block mt-2">{{ $reviewsCount ?? 0 }}</span>
            <span class="text-[11px] text-[#777777] mt-2 inline-block">Verified Feedback</span>
        </div>
        <div class="bg-white border border-[#E5E0D8] rounded p-6">
            <span class="text-xs uppercase tracking-wider text-[#777777] block">Primary Address</span>
            <span class="font-serif text-sm text-[#1C1C1C] font-medium block mt-2 truncate">
                {{ auth()->user()->addresses->where('is_default', true)->first()?->city ?? 'None Set' }}
            </span>
            <a href="{{ route('customer.addresses.index') }}" class="text-[11px] text-[#7A8B6F] hover:underline mt-2 inline-block">Manage &rarr;</a>
        </div>
    </div>

    {{-- Recent Orders Section --}}
    <div class="bg-white border border-[#E5E0D8] rounded overflow-hidden">
        <div class="p-6 border-b border-[#E5E0D8] flex items-center justify-between">
            <h2 class="font-serif text-xl text-[#1C1C1C]">Recent Orders</h2>
            <a href="{{ route('orders.index') }}" class="text-xs text-[#1C1C1C] hover:underline">View All &rarr;</a>
        </div>
        @if(isset($recentOrders) && $recentOrders->count() > 0)
            <div class="divide-y divide-[#E5E0D8]">
                @foreach($recentOrders as $ro)
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-[#FAF8F3]/50">
                        <div>
                            <span class="font-mono font-medium text-[#1C1C1C] text-sm">#{{ $ro->order_number }}</span>
                            <span class="text-xs text-[#777777] block">{{ $ro->created_at->format('M d, Y') }} • {{ $ro->items->count() }} items</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-serif font-semibold text-sm text-[#1C1C1C]">${{ number_format($ro->total, 2) }}</span>
                            <span class="badge {{ $ro->status === 'completed' ? 'badge-success' : 'badge-info' }}">{{ ucfirst($ro->status) }}</span>
                            <a href="{{ route('orders.show', $ro->id) }}" class="btn-secondary py-1 px-3 text-xs">Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-xs text-[#777777]">
                You have not placed any orders yet.
            </div>
        @endif
    </div>
</div>
@endsection
