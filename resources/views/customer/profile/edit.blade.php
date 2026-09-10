@extends('layouts.customer')

@section('title', 'Profile Settings - Danone Store Indonesia')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="border-b border-[#E5E0D8] pb-4 mb-8 flex items-center justify-between">
        <div>
            <span class="text-xs uppercase tracking-[0.2em] text-[#777777] font-semibold block mb-1">Account</span>
            <h1 class="font-serif text-3xl text-[#1C1C1C]">Profile & Security</h1>
        </div>
        <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#1C1C1C] hover:underline font-medium">&larr; Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-[#e8ede6] border border-[#7A8B6F] text-[#5a6e50] text-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded">
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif

    <div class="space-y-10">
        {{-- Personal Details --}}
        <div class="bg-white border border-[#E5E0D8] rounded p-6 sm:p-8">
            <h2 class="font-serif text-xl text-[#1C1C1C] border-b border-[#E5E0D8] pb-3 mb-6">Personal Details</h2>
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 max-w-lg">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn-primary text-xs">Save Changes</button>
                </div>
            </form>
        </div>

        {{-- Password Update --}}
        <div class="bg-white border border-[#E5E0D8] rounded p-6 sm:p-8">
            <h2 class="font-serif text-xl text-[#1C1C1C] border-b border-[#E5E0D8] pb-3 mb-6">Update Password</h2>
            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4 max-w-lg">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Current Password</label>
                    <input type="password" name="current_password" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">New Password</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#333333] mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn-primary text-xs">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
