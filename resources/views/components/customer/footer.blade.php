<footer class="bg-[#001E4D] text-white pt-16 pb-10 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Top Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8 pb-14 border-b border-white/10">
            {{-- Column 1: Brand Statement --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-[#0072CE] flex items-center justify-center text-white font-extrabold text-base shadow-sm">
                        D
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-2xl tracking-tight text-white leading-none">DANONE</span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-[#00A3E0] font-bold mt-0.5">Toko Resmi Indonesia</span>
                    </div>
                </div>

                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Toko resmi online Danone Indonesia. Menghadirkan produk nutrisi dan hidrasi terpercaya seperti AQUA, Evian, Activia, Bebelac, SGM, dan Alpro langsung ke rumah Anda dengan jaminan 100% keaslian produk.
                </p>

                {{-- Contact Info --}}
                <div class="pt-2 text-xs text-slate-400 space-y-1.5">
                    <p class="flex items-center gap-2">
                        <span class="font-semibold text-white">Layanan Konsumen:</span> 0800-1-DANONE (Bebas Pulsa)
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="font-semibold text-white">Email Resmi:</span> 
                        <a href="mailto:care@danonestore.co.id" class="text-[#00A3E0] hover:underline">care@danonestore.co.id</a>
                    </p>
                    <p class="text-slate-400">Cyber 2 Tower, Jl. H.R. Rasuna Said, Jakarta Selatan</p>
                </div>
            </div>

            {{-- Column 2: Kategori Produk --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#00A3E0] mb-5">
                    Kategori Produk
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="{{ route('products.index', ['search' => 'AQUA']) }}" class="hover:text-white transition-colors">Air Mineral & Hidrasi</a></li>
                    <li><a href="{{ route('products.index', ['search' => 'Activia']) }}" class="hover:text-white transition-colors">Yogurt Probiotik & Dairy</a></li>
                    <li><a href="{{ route('products.index', ['search' => 'Alpro']) }}" class="hover:text-white transition-colors">Plant-Based (Alpro)</a></li>
                    <li><a href="{{ route('products.index', ['search' => 'Bebelac']) }}" class="hover:text-white transition-colors">Susu Pertumbuhan Anak</a></li>
                    <li><a href="{{ route('products.index', ['search' => 'SGM']) }}" class="hover:text-white transition-colors">Nutrisi Keluarga (SGM)</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-[#00A3E0] font-semibold hover:underline">Semua Kategori &rarr;</a></li>
                </ul>
            </div>

            {{-- Column 3: Layanan Pelanggan --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#00A3E0] mb-5">
                    Layanan Pelanggan
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="{{ route('orders.index') }}" class="hover:text-white transition-colors">Lacak Pesanan</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Hubungi Kami</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Kebijakan Pengembalian</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Panduan Belanja</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Pertanyaan Umum (FAQ)</a></li>
                </ul>
            </div>

            {{-- Column 4: Tentang Danone --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#00A3E0] mb-5">
                    Tentang Kami
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Danone Store</a></li>
                    <li><a href="{{ route('collections.index') }}" class="hover:text-white transition-colors">Brand Resmi Kami</a></li>
                    <li><a href="{{ route('inspiration.index') }}" class="hover:text-white transition-colors">Artikel & Tips Nutrisi</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Komitmen Keberlanjutan</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>

        {{-- Middle Badges: Payment & Shipping Partners --}}
        <div class="py-8 border-b border-white/10 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-3">Metode Pembayaran Aman</span>
                <div class="flex flex-wrap gap-2 text-xs">
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">BCA</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">Mandiri</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">BNI</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">BRI</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">GoPay</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">OVO</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">ShopeePay</span>
                </div>
            </div>
            <div>
                <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-3">Mitra Pengiriman Terpercaya</span>
                <div class="flex flex-wrap gap-2 text-xs">
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">JNE Express</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">J&T</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">SiCepat</span>
                    <span class="px-3 py-1 bg-white/10 rounded font-semibold text-white">GrabExpress</span>
                </div>
            </div>
        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} Danone Indonesia. Semua hak dilindungi undang-undang.</p>
            <div class="flex space-x-6">
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Bantuan</a>
            </div>
        </div>
    </div>
</footer>