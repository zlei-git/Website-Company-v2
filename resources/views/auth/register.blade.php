@extends('layouts.customer')
@section('title', 'Daftar Akun - Danone Store Official')

@section('content')
<div class="min-h-screen flex">
    {{-- Left: Decorative Brand Image --}}
    <div class="hidden lg:flex lg:w-1/2 bg-[#001E4D] items-center justify-center p-16 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1548839140-29a749e1bc4e?w=1200&q=80" alt="Danone Healthy Nutrition" class="absolute inset-0 w-full h-full object-cover opacity-35">
        <div class="absolute inset-0 bg-gradient-to-t from-[#001E4D] via-transparent to-[#001E4D]/60"></div>
        <div class="relative z-10 max-w-md text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#0072CE] text-white font-black text-2xl mb-6 shadow-lg">
                D
            </div>
            <h2 class="font-bold text-3xl text-white mb-4 leading-tight">"Nutrisi Alami & Hidrasi Sehat untuk Keluarga Indonesia."</h2>
            <p class="text-xs text-[#00A3E0] tracking-[0.25em] uppercase font-bold">Danone Indonesia</p>
        </div>
    </div>
    {{-- Right: Form --}}
    <div class="flex-1 flex items-center justify-center p-8 sm:p-12 bg-white">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-8">
                <div class="w-10 h-10 rounded-full bg-[#002D72] flex items-center justify-center text-white font-black text-base shadow-sm">
                    D
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-2xl tracking-tight text-[#002D72] leading-none">DANONE</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-[#0072CE] font-bold mt-0.5">Official Store</span>
                </div>
            </a>
            <h1 class="text-2xl font-bold text-[#002D72] mb-2">Buat Akun Baru</h1>
            <p class="text-sm text-slate-500 mb-8">Bergabunglah dengan Danone Store untuk mendapatkan promo eksklusif dan kemudahan pelacakan pesanan.</p>

            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-sm text-rose-700">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#0072CE] focus:ring-2 focus:ring-[#0072CE]/20 outline-none">
                </div>
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#0072CE] focus:ring-2 focus:ring-[#0072CE]/20 outline-none">
                </div>
                <div>
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nomor WhatsApp / Telepon</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" 
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#0072CE] focus:ring-2 focus:ring-[#0072CE]/20 outline-none">
                </div>
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" required 
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#0072CE] focus:ring-2 focus:ring-[#0072CE]/20 outline-none">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                           class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#0072CE] focus:ring-2 focus:ring-[#0072CE]/20 outline-none">
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-6 bg-[#0072CE] hover:bg-[#002D72] text-white font-bold rounded-xl shadow-md transition-colors">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-slate-600">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-[#0072CE] font-bold hover:underline">Masuk</a>
            </p>
        </div>
    </div>
</div>
@endsection
