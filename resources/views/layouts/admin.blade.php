<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NordicHome Atelier - Studio Desk')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#F4F4F5] text-[#18181B] font-sans antialiased min-h-screen flex selection:bg-[#D8C3A5] selection:text-[#18181A]">

    {{-- Studio Command Sidebar --}}
    @include('components.admin.sidebar')

    {{-- Main Workspace Panel --}}
    <div class="flex-1 flex flex-col min-w-0 min-h-screen overflow-hidden">
        @include('components.admin.topbar')

        {{-- Flash Notices --}}
        @if(session('success'))
            <div class="mx-8 mt-4 p-4 bg-[#F0F4EE] border border-[#7A8B6F] text-[#4A6342] text-xs flex items-center justify-between rounded-sm">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-base leading-none">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-8 mt-4 p-4 bg-red-50 border border-red-300 text-red-700 text-xs flex items-center justify-between rounded-sm">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-base leading-none">&times;</button>
            </div>
        @endif

        <main class="flex-1 overflow-y-auto p-6 sm:p-8 lg:p-10">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
