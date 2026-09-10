<header x-data="{ mobileOpen: false, searchOpen: false, spacesDropdown: false }" 
        class="bg-white/95 backdrop-blur-md border-b border-[#E2E8F0] sticky top-0 z-40 transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Navigation Bar --}}
        <div class="flex items-center justify-between h-20">
            {{-- Brand Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-[#002D72] flex items-center justify-center text-white font-extrabold text-base shadow-sm group-hover:bg-[#0072CE] transition-colors">
                        D
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl sm:text-2xl tracking-tight text-[#002D72] leading-none group-hover:text-[#0072CE] transition-colors">DANONE</span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-[#0072CE] font-bold mt-0.5">Official Store</span>
                    </div>
                </a>
            </div>

            {{-- Center Navigation Links --}}
            <nav class="hidden lg:flex items-center space-x-8 text-[13px] tracking-wide font-semibold text-[#1E293B]">
                {{-- Categories Dropdown --}}
                <div class="relative" @mouseenter="spacesDropdown = true" @mouseleave="spacesDropdown = false">
                    <button class="flex items-center space-x-1.5 hover:text-[#0072CE] py-2 {{ request()->routeIs('categories.*') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                        <span>Kategori Produk</span>
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': spacesDropdown }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="spacesDropdown" x-cloak 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute left-0 top-full w-72 bg-white border border-[#E2E8F0] shadow-xl py-3 rounded-xl text-xs z-50">
                        <a href="{{ route('products.index', ['search' => 'AQUA']) }}" class="flex items-center gap-2 px-5 py-2.5 hover:bg-[#F0F9FF] text-[#1E293B] hover:text-[#0072CE]">
                            <span class="w-2 h-2 rounded-full bg-[#00A3E0]"></span> Air Mineral (AQUA & Evian)
                        </a>
                        <a href="{{ route('products.index', ['search' => 'Activia']) }}" class="flex items-center gap-2 px-5 py-2.5 hover:bg-[#F0F9FF] text-[#1E293B] hover:text-[#0072CE]">
                            <span class="w-2 h-2 rounded-full bg-[#00965E]"></span> Dairy & Probiotik (Activia)
                        </a>
                        <a href="{{ route('products.index', ['search' => 'Alpro']) }}" class="flex items-center gap-2 px-5 py-2.5 hover:bg-[#F0F9FF] text-[#1E293B] hover:text-[#0072CE]">
                            <span class="w-2 h-2 rounded-full bg-[#F59E0B]"></span> Plant-Based Nutrition (Alpro)
                        </a>
                        <a href="{{ route('products.index', ['search' => 'Bebelac']) }}" class="flex items-center gap-2 px-5 py-2.5 hover:bg-[#F0F9FF] text-[#1E293B] hover:text-[#0072CE]">
                            <span class="w-2 h-2 rounded-full bg-[#0072CE]"></span> Nutrisi Anak (Bebelac & SGM)
                        </a>
                        <div class="border-t border-[#E2E8F0] my-2"></div>
                        <a href="{{ route('categories.index') }}" class="block px-5 py-2 font-bold text-[#002D72] hover:text-[#0072CE]">Lihat Semua Kategori &rarr;</a>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="hover:text-[#0072CE] py-2 {{ request()->routeIs('products.*') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                    Semua Produk
                </a>
                <a href="{{ route('collections.index') }}" class="hover:text-[#0072CE] py-2 {{ request()->routeIs('collections.*') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                    Brand Danone
                </a>
                <a href="{{ route('inspiration.index') }}" class="hover:text-[#0072CE] py-2 {{ request()->routeIs('inspiration.*') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                    Artikel Nutrisi
                </a>
                <a href="{{ route('about') }}" class="hover:text-[#0072CE] py-2 {{ request()->routeIs('about') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}" class="hover:text-[#0072CE] py-2 {{ request()->routeIs('contact') ? 'text-[#0072CE] font-bold border-b-2 border-[#0072CE]' : 'text-[#475569]' }}">
                    Hubungi Kami
                </a>
            </nav>

            {{-- Right Utilities --}}
            <div class="flex items-center space-x-5">
                {{-- Quick Search Trigger --}}
                <button @click="searchOpen = !searchOpen" class="text-[#475569] hover:text-[#0072CE] p-1.5 rounded-full hover:bg-slate-100 transition-colors" title="Cari Produk">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>

                {{-- Saved Wishlist --}}
                <a href="{{ route('wishlist.index') }}" class="text-[#475569] hover:text-[#C62828] p-1.5 rounded-full hover:bg-slate-100 relative transition-colors" title="Wishlist Tersimpan">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    @auth
                        @php $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count(); @endphp
                        @if($wishlistCount > 0)
                            <span class="absolute -top-1 -right-1 bg-[#C62828] text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $wishlistCount }}</span>
                        @endif
                    @endauth
                </a>

                {{-- Cart with Total Counter --}}
                <a href="{{ route('cart.index') }}" class="text-[#475569] hover:text-[#0072CE] p-1.5 rounded-full hover:bg-slate-100 relative flex items-center transition-colors" title="Keranjang Belanja">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    @auth
                        @php $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-[#0072CE] text-white text-[9px] min-w-4 h-4 px-1 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @endif
                    @endauth
                </a>

                {{-- Account Dropdown / Auth Link --}}
                <div class="relative" x-data="{ userMenu: false }">
                    @auth
                        <button @click="userMenu = !userMenu" class="text-xs uppercase tracking-wider text-[#002D72] font-bold flex items-center space-x-1.5">
                            <span class="w-8 h-8 rounded-full bg-[#002D72] text-white flex items-center justify-center text-xs font-bold shadow-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        </button>
                        <div x-show="userMenu" @click.away="userMenu = false" x-cloak
                             class="absolute right-0 mt-3 w-56 bg-white border border-[#E2E8F0] shadow-xl rounded-xl py-2 z-50 text-xs">
                            <div class="px-4 py-2 border-b border-[#E2E8F0]">
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold">Masuk Sebagai</p>
                                <p class="font-bold text-[#002D72] truncate">{{ auth()->user()->name }}</p>
                            </div>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-[#0072CE] font-bold hover:bg-[#F0F9FF]">Panel Admin Danone &rarr;</a>
                            @endif
                            <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700">Dashboard Saya</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700">Pesanan & Lacak</a>
                            <a href="{{ route('customer.addresses.index') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700">Alamat Pengiriman</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-slate-50 text-slate-700">Pengaturan Akun</a>
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-[#E2E8F0] mt-1">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 font-semibold hover:bg-rose-50">Keluar (Sign Out)</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-xs uppercase tracking-wider font-bold text-[#002D72] hover:text-[#0072CE] py-2 px-4 rounded-full border border-[#002D72] hover:border-[#0072CE] transition-all">
                            Masuk
                        </a>
                    @endauth
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-[#002D72] p-1.5 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Search Overlay Bar --}}
    <div x-show="searchOpen" x-cloak 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="border-t border-[#E2E8F0] bg-slate-50 py-4 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('products.index') }}" method="GET" class="max-w-3xl mx-auto flex items-center gap-3">
            <input type="text" name="search" placeholder="Cari produk AQUA, Evian, Activia, Bebelac, SGM, Alpro..." 
                   class="w-full text-sm border border-[#CBD5E1] rounded-full px-4 py-2.5 focus:ring-2 focus:ring-[#0072CE] focus:border-[#0072CE] bg-white">
            <button type="submit" class="py-2.5 px-6 bg-[#0072CE] hover:bg-[#002D72] text-white font-bold text-xs rounded-full transition-colors flex-shrink-0">Cari</button>
            <button type="button" @click="searchOpen = false" class="text-xs uppercase tracking-wider font-semibold text-slate-500 hover:text-slate-800 ml-2">Tutup</button>
        </form>
    </div>

    {{-- Mobile Drawer --}}
    <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-[#E2E8F0] bg-white px-6 py-6 space-y-4">
        <nav class="flex flex-col space-y-3 text-sm font-semibold text-[#1E293B]">
            <a href="{{ route('home') }}" class="hover:text-[#0072CE]">Beranda</a>
            <a href="{{ route('products.index') }}" class="hover:text-[#0072CE]">Semua Produk</a>
            <a href="{{ route('categories.index') }}" class="hover:text-[#0072CE]">Kategori Produk</a>
            <a href="{{ route('collections.index') }}" class="hover:text-[#0072CE]">Brand Danone</a>
            <a href="{{ route('inspiration.index') }}" class="hover:text-[#0072CE]">Artikel Nutrisi</a>
            <a href="{{ route('about') }}" class="hover:text-[#0072CE]">Tentang Kami</a>
            <a href="{{ route('contact') }}" class="hover:text-[#0072CE]">Hubungi Kami</a>
        </nav>
    </div>
</header>