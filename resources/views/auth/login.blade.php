@extends('layouts.customer')
@section('title', 'Log In - Danone Store')

@section('content')
<div class="min-h-screen flex">
    {{-- Left: Decorative --}}
    <div class="hidden lg:flex lg:w-1/2 bg-[#1C1C1C] items-center justify-center p-16 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1548839140-29a749e1bc4e?w=1200&q=80" alt="Danone Store" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 max-w-md text-center">
            <h2 class="font-serif text-4xl text-white mb-4 leading-tight italic">"Kualitas nutrisi dan hidrasi terbaik untuk keluarga Anda setiap hari."</h2>
            <p class="text-sm text-[#D8C3A5] tracking-widest uppercase">Danone Store Indonesia</p>
        </div>
    </div>
    {{-- Right: Form --}}
    <div class="flex-1 flex items-center justify-center p-8 sm:p-12 bg-[#FAF8F3]">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="flex items-baseline space-x-1.5 mb-10">
                <span class="font-serif text-3xl tracking-tight text-[#1C1C1C] font-semibold">Danone Store</span>
            </a>
            <h1 class="text-2xl font-serif text-[#1C1C1C] mb-2">Welcome Back</h1>
            <p class="text-sm text-[#777777] mb-8">Sign in to your Danone Store account.</p>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded text-sm text-red-700">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full">
                </div>
                <div>
                    <label for="password" class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Password</label>
                    <input id="password" type="password" name="password" required class="w-full">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-[#777777]">
                        <input type="checkbox" name="remember" class="rounded border-[#D8C3A5] text-[#1C1C1C] focus:ring-[#D8C3A5] mr-2">Remember me
                    </label>
                </div>
                <button type="submit" class="btn-primary w-full">Sign In</button>
            </form>

            <p class="mt-6 text-center text-sm text-[#777777]">
                Don't have an account? <a href="{{ route('register') }}" class="text-[#1C1C1C] font-medium underline">Create one</a>
            </p>

            {{-- Demo Credentials --}}
            <div class="mt-8 pt-6 border-t border-[#E5E0D8]">
                <p class="text-xs text-[#777777] text-center mb-3">Quick Demo Access</p>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" onclick="document.getElementById('email').value='admin@danone.co.id';document.getElementById('password').value='password';"
                        class="text-xs border border-[#E5E0D8] rounded px-3 py-2 text-[#333333] hover:bg-white">Admin Login</button>
                    <button type="button" onclick="document.getElementById('email').value='customer@danone.co.id';document.getElementById('password').value='password';"
                        class="text-xs border border-[#E5E0D8] rounded px-3 py-2 text-[#333333] hover:bg-white">Customer Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
