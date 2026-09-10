<header x-data="{ mobileOpen: false, searchOpen: false, spacesDropdown: false }" 
        class="bg-[#FAF8F3]/95 backdrop-blur-md border-b border-[#E8E4DC] sticky top-0 z-40 transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Navigation Bar --}}
        <div class="flex items-center justify-between h-20">
            {{-- Brand Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex flex-col group">
                    <span class="font-serif text-2xl sm:text-3xl tracking-tight text-[#18181A] font-medium">Nordic</span>
                    <span class="text-[9px] uppercase tracking-[0.3em] text-[#A1A1AA] -mt-1 group-hover:text-[#18181A] transition-colors">Pure Nutrition & Hydration</span>
                </a>
            </div>

            {{-- Center Editorial Links --}}
            <nav class="hidden lg:flex items-center space-x-10 text-[13px] tracking-[0.05em] uppercase font-medium">
                {{-- Categories Dropdown --}}
                <div class="relative" @mouseenter="spacesDropdown = true" @mouseleave="spacesDropdown = false">
                    <button class="flex items-center space-x-1 hover:text-[#18181A] py-2 {{ request()->routeIs('categories.*') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                        <span>Categories</span>
                        <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': spacesDropdown }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="spacesDropdown" x-cloak 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute left-0 top-full w-64 bg-white border border-[#E8E4DC] shadow-lg py-3 rounded-none text-xs">
                        <a href="{{ route('categories.show', 'waters-natural-hydration') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">Natural Mineral Waters</a>
                        <a href="{{ route('categories.show', 'probiotic-dairy-yogurt') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">Probiotic Dairy & Yogurt</a>
                        <a href="{{ route('categories.show', 'plant-based-milks-drinks') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">Plant-Based Milks</a>
                        <a href="{{ route('categories.show', 'active-high-protein') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">High Protein & Recovery</a>
                        <a href="{{ route('categories.show', 'healthy-snacks-bowls') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">Healthy Snacks & Granola</a>
                        <a href="{{ route('categories.show', 'specialized-early-life') }}" class="block px-5 py-2 hover:bg-[#FAF8F3] text-[#27272A] hover:text-[#18181A]">Specialized Nutrition</a>
                        <div class="border-t border-[#E8E4DC] my-1"></div>
                        <a href="{{ route('categories.index') }}" class="block px-5 py-2 font-semibold text-[#18181A] hover:underline">All Categories &rarr;</a>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="hover:text-[#18181A] py-2 {{ request()->routeIs('products.*') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                    All Products
                </a>
                <a href="{{ route('collections.index') }}" class="hover:text-[#18181A] py-2 {{ request()->routeIs('collections.*') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                    Collections
                </a>
                <a href="{{ route('inspiration.index') }}" class="hover:text-[#18181A] py-2 {{ request()->routeIs('inspiration.*') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                    Journal
                </a>
                <a href="{{ route('about') }}" class="hover:text-[#18181A] py-2 {{ request()->routeIs('about') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                    About Us
                </a>
                <a href="{{ route('contact') }}" class="hover:text-[#18181A] py-2 {{ request()->routeIs('contact') ? 'text-[#18181A] border-b border-[#18181A]' : 'text-[#71717A]' }}">
                    Contact
                </a>
            </nav>

            {{-- Right Utilities --}}
            <div class="flex items-center space-x-6">
                {{-- Quick Search Trigger --}}
                <button @click="searchOpen = !searchOpen" class="text-[#27272A] hover:text-[#18181A] p-1 transition-colors" title="Search Products">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>

                {{-- Saved Wishlist --}}
                <a href="{{ route('wishlist.index') }}" class="text-[#27272A] hover:text-[#18181A] p-1 relative transition-colors" title="Saved Wishlist">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    @auth
                        @php $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count(); @endphp
                        @if($wishlistCount > 0)
                            <span class="absolute -top-1 -right-1 bg-[#18181A] text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-medium">{{ $wishlistCount }}</span>
                        @endif
                    @endauth
                </a>

                {{-- Bag / Cart with Total Counter --}}
                <a href="{{ route('cart.index') }}" class="text-[#27272A] hover:text-[#18181A] p-1 relative flex items-center space-x-1.5 transition-colors" title="Shopping Bag">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    @auth
                        @php $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span class="bg-[#18181A] text-[#FAF8F3] text-[10px] px-1.5 py-0.5 rounded-full font-mono">{{ $cartCount }}</span>
                        @endif
                    @endauth
                </a>

                {{-- Account Dropdown / Auth Link --}}
                <div class="relative" x-data="{ userMenu: false }">
                    @auth
                        <button @click="userMenu = !userMenu" class="text-xs uppercase tracking-wider text-[#18181A] font-medium flex items-center space-x-1.5">
                            <span class="w-7 h-7 rounded-full bg-[#EFECE6] flex items-center justify-center text-[11px] font-mono text-[#18181A]">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        </button>
                        <div x-show="userMenu" @click.away="userMenu = false" x-cloak
                             class="absolute right-0 mt-3 w-52 bg-white border border-[#E8E4DC] shadow-xl py-2 z-50 text-xs">
                            <div class="px-4 py-2 border-b border-[#E8E4DC]">
                                <p class="text-[10px] text-[#A1A1AA] uppercase tracking-wider">Signed In</p>
                                <p class="font-medium text-[#18181A] truncate">{{ auth()->user()->name }}</p>
                            </div>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-[#7A8B6F] font-semibold hover:bg-[#FAF8F3]">Admin Studio Desk &rarr;</a>
                            @endif
                            <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 hover:bg-[#FAF8F3] text-[#27272A]">My Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-[#FAF8F3] text-[#27272A]">Orders & Tracking</a>
                            <a href="{{ route('customer.addresses.index') }}" class="block px-4 py-2 hover:bg-[#FAF8F3] text-[#27272A]">Delivery Addresses</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-[#FAF8F3] text-[#27272A]">Account Settings</a>
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-[#E8E4DC] mt-1">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-[#9E2B2B] hover:bg-[#FAF8F3]">Sign Out</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-xs uppercase tracking-[0.15em] font-medium text-[#18181A] hover:text-[#7A8B6F] transition-colors">
                            Sign In
                        </a>
                    @endauth
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-[#18181A] p-1.5 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Search Overlay Bar --}}
    <div x-show="searchOpen" x-cloak 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="border-t border-[#E8E4DC] bg-white py-4 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('products.index') }}" method="GET" class="max-w-3xl mx-auto flex items-center gap-3">
            <input type="text" name="search" placeholder="Search natural mineral waters, probiotic yogurts, organic plant milks, protein snacks..." 
                   class="w-full text-sm border-0 border-b border-[#18181A] rounded-none px-2 py-2 focus:ring-0 focus:border-[#18181A]">
            <button type="submit" class="btn-primary py-2 px-5 text-xs flex-shrink-0">Search</button>
            <button type="button" @click="searchOpen = false" class="text-xs uppercase tracking-widest text-[#71717A] hover:text-[#18181A] ml-2">Close</button>
        </form>
    </div>

    {{-- Mobile Drawer --}}
    <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-[#E8E4DC] bg-white px-6 py-6 space-y-4">
        <nav class="flex flex-col space-y-3 text-sm font-medium tracking-wide">
            <a href="{{ route('home') }}" class="hover:text-[#7A8B6F]">Home</a>
            <a href="{{ route('products.index') }}" class="hover:text-[#7A8B6F]">All Products</a>
            <a href="{{ route('categories.index') }}" class="hover:text-[#7A8B6F]">Categories</a>
            <a href="{{ route('collections.index') }}" class="hover:text-[#7A8B6F]">Collections</a>
            <a href="{{ route('inspiration.index') }}" class="hover:text-[#7A8B6F]">Journal</a>
            <a href="{{ route('about') }}" class="hover:text-[#7A8B6F]">About Us</a>
            <a href="{{ route('contact') }}" class="hover:text-[#7A8B6F]">Contact</a>
        </nav>
    </div>
</header>