@extends('layouts.customer')

@section('title', 'Address Book - Nordic Pure Nutrition')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="border-b border-[#E5E0D8] pb-4 mb-8 flex items-center justify-between">
        <div>
            <span class="text-xs uppercase tracking-[0.2em] text-[#777777] font-semibold block mb-1">Account</span>
            <h1 class="font-serif text-3xl text-[#1C1C1C]">Address Book</h1>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#777777] hover:underline">&larr; Dashboard</a>
            <a href="{{ route('customer.addresses.create') }}" class="btn-primary py-2 px-4 text-xs">+ Add Address</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-[#e8ede6] border border-[#7A8B6F] text-[#5a6e50] text-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($addresses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($addresses as $addr)
                <div class="bg-white border {{ $addr->is_default ? 'border-[#1C1C1C] ring-1 ring-[#1C1C1C]' : 'border-[#E5E0D8]' }} rounded p-6 flex flex-col justify-between space-y-4">
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-serif text-base font-semibold text-[#1C1C1C]">{{ $addr->label ?? 'Address' }}</span>
                            @if($addr->is_default)
                                <span class="badge badge-success text-[10px]">Default</span>
                            @endif
                        </div>
                        <p class="font-medium text-[#1C1C1C] pt-1">{{ $addr->full_name }}</p>
                        <p class="text-[#777777]">{{ $addr->address }}</p>
                        <p class="text-[#777777]">{{ $addr->city }}, {{ $addr->postal_code }}</p>
                        <p class="text-[#777777]">{{ $addr->country }}</p>
                        <p class="text-[#777777] pt-1">Tel: {{ $addr->phone }}</p>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                        <div class="space-x-3">
                            <a href="{{ route('customer.addresses.edit', $addr->id) }}" class="text-[#1C1C1C] hover:underline font-medium">Edit</a>
                            <form action="{{ route('customer.addresses.destroy', $addr->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this address?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#842029] hover:underline">Delete</button>
                            </form>
                        </div>
                        @if(!$addr->is_default)
                            <form action="{{ route('customer.addresses.setDefault', $addr->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-[11px] text-[#7A8B6F] hover:underline font-medium">Set Default</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white border border-[#E5E0D8] rounded p-12 text-center space-y-4">
            <p class="font-serif text-xl text-[#1C1C1C]">No addresses saved yet</p>
            <p class="text-xs text-[#777777]">Save your delivery locations to expedite checkout for future pieces.</p>
            <a href="{{ route('customer.addresses.create') }}" class="btn-primary inline-block">Add Your First Address</a>
        </div>
    @endif
</div>
@endsection
