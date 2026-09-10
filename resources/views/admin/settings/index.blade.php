@extends('layouts.admin')

@section('title', 'Atelier Settings - NordicHome Studio')

@section('content')
<div class="max-w-3xl space-y-6">
    <div>
        <div class="text-[10px] uppercase tracking-[0.25em] text-[#D8C3A5] font-bold mb-1">
            NordicHome &bull; København Flagship
        </div>
        <h1 class="text-3xl text-[#18181A] font-medium font-heading">Studio & Brand Settings</h1>
        <p class="text-xs text-[#71717A] mt-1">Configure atelier concierge details, flagship studio coordinates, and customer communications.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-[#E8E4DC] rounded-xl p-6 sm:p-8 space-y-6 shadow-xs">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#27272A] mb-1">Brand / Studio Name</label>
                <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'Nordic Pure Nutrition' }}" required class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#27272A] mb-1">Concierge Email</label>
                <input type="email" name="company_email" value="{{ $settings['company_email'] ?? 'concierge@nordichome.test' }}" required class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#27272A] mb-1">Studio Telephone</label>
                <input type="text" name="company_phone" value="{{ $settings['company_phone'] ?? '+45 33 12 34 56' }}" class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-[#27272A] mb-1">Atelier Hours</label>
                <input type="text" name="business_hours" value="{{ $settings['business_hours'] ?? 'Mon - Fri: 09:00 - 18:00 CET' }}" class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-[#27272A] mb-1">Flagship Address</label>
            <input type="text" name="company_address" value="{{ $settings['company_address'] ?? 'Kronprinsens Gade 14, 1114 København K, Denmark' }}" class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
        </div>

        <div class="border-t border-[#E8E4DC] pt-4 space-y-4">
            <h3 class="text-sm font-semibold text-[#18181A]">Studio Social & Press Channels</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] text-[#71717A] mb-1 font-medium">Instagram Atelier</label>
                    <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? 'https://instagram.com/nordichome' }}" placeholder="https://instagram.com/nordichome" class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
                </div>
                <div>
                    <label class="block text-[11px] text-[#71717A] mb-1 font-medium">Pinterest Lookbook</label>
                    <input type="url" name="social_pinterest" value="{{ $settings['social_pinterest'] ?? 'https://pinterest.com/nordichome' }}" placeholder="https://pinterest.com/nordichome" class="w-full rounded-md border border-[#E8E4DC] px-3 py-2 text-sm focus:border-[#18181A] focus:outline-none">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[#E8E4DC]">
            <button type="submit" class="bg-[#18181A] hover:bg-[#D8C3A5] hover:text-[#18181A] text-white text-xs py-2.5 px-6 rounded-md font-medium tracking-wide transition-colors">Save Atelier Settings</button>
        </div>
    </form>
</div>
@endsection