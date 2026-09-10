<header class="h-20 bg-white border-b border-[#E8E4DC] px-6 lg:px-10 flex items-center justify-between">
    {{-- Left: Workspace Status & Atelier Indicator --}}
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2 text-xs text-[#71717A]">
            <span class="inline-block w-2 h-2 rounded-full bg-[#00965E] animate-pulse"></span>
            <span class="tracking-wide uppercase text-[10px] font-bold text-[#002D72]">Danone Store Indonesia</span>
            <span class="text-[#0072CE]">&bull;</span>
            <span class="text-[11px] font-mono text-[#71717A]">{{ now()->format('D, d M Y - H:i') }} WIB</span>
        </div>
    </div>

    {{-- Right: Actions & Administrator Profile --}}
    <div class="flex items-center space-x-6">
        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center space-x-1 text-xs text-[#0072CE] font-bold hover:underline transition-colors">
            <span>Buka Toko</span>
            <span class="text-[10px]">↗</span>
        </a>

        <a href="{{ route('admin.products.create') }}" class="hidden sm:inline-flex items-center space-x-1.5 px-3 py-1.5 bg-[#0072CE] hover:bg-[#002D72] text-white text-xs uppercase tracking-wider font-bold rounded-lg transition-colors">
            <span>+ Tambah Produk</span>
        </a>

        {{-- Profile Pill --}}
        <div class="flex items-center space-x-3 border-l border-[#E8E4DC] pl-6">
            <div class="w-8 h-8 rounded-full bg-[#FAF8F3] border border-[#E8E4DC] flex items-center justify-center text-xs font-serif font-medium text-[#18181A]">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="hidden md:flex flex-col text-left">
                <span class="text-xs font-medium text-[#18181A] leading-tight">{{ auth()->user()->name }}</span>
                <span class="text-[10px] uppercase tracking-wider text-[#71717A]">Director of Design</span>
            </div>
        </div>
    </div>
</header>
