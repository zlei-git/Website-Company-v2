@extends('layouts.customer')
@section('title', 'Register - Nordic Pure Nutrition')

@section('content')
<div class="min-h-screen flex">
    {{-- Left: Decorative --}}
    <div class="hidden lg:flex lg:w-1/2 bg-[#1C1C1C] items-center justify-center p-16 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900&q=80" alt="Scandinavian living" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 max-w-md text-center">
            <h2 class="font-serif text-4xl text-white mb-4 leading-tight italic">"Simplicity is the ultimate sophistication."</h2>
            <p class="text-sm text-[#D8C3A5] tracking-widest uppercase">NordicHome Living</p>
        </div>
    </div>
    {{-- Right: Form --}}
    <div class="flex-1 flex items-center justify-center p-8 sm:p-12 bg-[#FAF8F3]">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="flex items-baseline space-x-1.5 mb-8">
                <span class="font-serif text-3xl tracking-tight text-[#1C1C1C] font-semibold">NordicHome</span>
            </a>
            <h1 class="text-2xl font-serif text-[#1C1C1C] mb-2">Create an Account</h1>
            <p class="text-sm text-[#777777] mb-8">Join the NordicHome family for personalized recommendations and order tracking.</p>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded text-sm text-red-700">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full">
                </div>
                <div>
                    <label for="phone" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Phone Number (Optional)</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="w-full">
                </div>
                <div>
                    <label for="password" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Password</label>
                    <input id="password" type="password" name="password" required class="w-full">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full">
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full">Create Account</button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-[#777777]">
                Already have an account? <a href="{{ route('login') }}" class="text-[#1C1C1C] font-medium underline">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection
