<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nordic - Pure Hydration & Living Nutrition')</title>
    <meta name="description" content="@yield('meta_description', 'Single-origin volcanic spring waters, live probiotic yogurts, and organic plant-based milks for conscious living.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FAF8F3] text-[#333333] font-sans antialiased min-h-screen flex flex-col selection:bg-[#D8C3A5] selection:text-[#1C1C1C]">

    <!-- Global Alert / Flash Messages -->
    <div class="fixed top-4 right-4 z-50 max-w-md w-full pointer-events-none">
        <div class="pointer-events-auto space-y-2">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="bg-white border-l-4 border-[#7A8B6F] p-4 shadow-sm rounded-r flex items-center justify-between text-sm">
                    <div class="flex items-center space-x-3 text-[#333333]">
                        <svg class="w-5 h-5 text-[#7A8B6F] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-[#777777] hover:text-[#1C1C1C] ml-4">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" 
                     class="bg-white border-l-4 border-[#842029] p-4 shadow-sm rounded-r flex items-center justify-between text-sm">
                    <div class="flex items-center space-x-3 text-[#333333]">
                        <svg class="w-5 h-5 text-[#842029] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-[#777777] hover:text-[#1C1C1C] ml-4">&times;</button>
                </div>
            @endif
        </div>
    </div>

    <!-- Navigation -->
    @include('components.customer.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.customer.footer')

    @stack('scripts')
</body>
</html>
