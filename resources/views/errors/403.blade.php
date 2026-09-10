@extends('layouts.customer')

@section('title', 'Access Denied - Danone Store Indonesia')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center py-20 px-6">
    <div class="text-center max-w-lg mx-auto">
        <span class="text-sm uppercase tracking-widest text-[#842029] font-medium">403 Forbidden</span>
        <h1 class="text-4xl md:text-5xl font-serif text-[#1C1C1C] mt-3 mb-4">Access Denied</h1>
        <p class="text-[#777777] mb-8 leading-relaxed">
            You do not have permission to access this administration area. Please log in with an administrator account.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('home') }}" class="btn-primary w-full sm:w-auto">Return Home</a>
            <a href="{{ route('login') }}" class="btn-secondary w-full sm:w-auto">Log In</a>
        </div>
    </div>
</div>
@endsection
