<aside class="studio-sidebar flex-shrink-0 flex flex-col justify-between hidden md:flex border-r border-[#27272A]">
    <div>
        {{-- Studio Header --}}
        <div class="h-20 flex items-center px-6 border-b border-[#27272A]">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col">
                <span class="font-serif text-xl font-medium text-white tracking-tight">NordicHome</span>
                <span class="text-[9px] uppercase tracking-[0.3em] text-[#D8C3A5] -mt-0.5">Atelier Studio Desk</span>
            </a>
        </div>

        {{-- Nav Groupings --}}
        <nav class="p-4 space-y-6 text-xs">
            {{-- Section 1: Overview --}}
            <div>
                <span class="px-3 text-[9px] uppercase tracking-[0.25em] text-[#71717A] font-semibold block mb-2">Overview</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="studio-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4 text-[#D8C3A5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span>Executive Atelier</span>
                    </a>
                </div>
            </div>

            {{-- Section 2: Catalog --}}
            <div>
                <span class="px-3 text-[9px] uppercase tracking-[0.25em] text-[#71717A] font-semibold block mb-2">Pieces & Spaces</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.products.index') }}" class="studio-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Nutrition Products</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="studio-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Categories & Nutrition</span>
                    </a>
                    <a href="{{ route('admin.collections.index') }}" class="studio-nav-item {{ request()->routeIs('admin.collections.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Nutritional Collections</span>
                    </a>
                    <a href="{{ route('admin.inventory.index') }}" class="studio-nav-item {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Inventory & Stock</span>
                    </a>
                </div>
            </div>

            {{-- Section 3: Operations --}}
            <div>
                <span class="px-3 text-[9px] uppercase tracking-[0.25em] text-[#71717A] font-semibold block mb-2">Operations</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.orders.index') }}" class="studio-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Dispatches (Orders)</span>
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="studio-nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Customers & Members</span>
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="studio-nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        <span>Feedback Moderation</span>
                    </a>
                    <a href="{{ route('admin.coupons.index') }}" class="studio-nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>Promotional Codes</span>
                    </a>
                </div>
            </div>

            {{-- Section 4: Editorial & Settings --}}
            <div>
                <span class="px-3 text-[9px] uppercase tracking-[0.25em] text-[#71717A] font-semibold block mb-2">Editorial & System</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.inspirations.index') }}" class="studio-nav-item {{ request()->routeIs('admin.inspirations.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span>Journal Publications</span>
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="studio-nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Concierge Inquiries</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="studio-nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Atelier Reports</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="studio-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Configuration</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    {{-- Bottom Utility --}}
    <div class="p-4 border-t border-[#27272A] space-y-2 text-xs">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center px-3 py-2 text-[#71717A] hover:text-white transition-colors">
            <span class="mr-2">↗</span> View Live Store
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-2 text-[#9E2B2B] hover:text-red-400 transition-colors">
                <span class="mr-2">⏻</span> Sign Out
            </button>
        </form>
    </div>
</aside>
