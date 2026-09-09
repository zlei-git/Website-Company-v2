<footer class="bg-[#1C1C1C] text-[#FAF8F3] pt-16 pb-12 border-t border-[#2A2A2A]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Top Editorial Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8 pb-16 border-b border-[#2D2D2D]">
            {{-- Column 1: Brand Statement --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="flex flex-col">
                    <span class="font-heading text-2xl font-medium tracking-tight text-[#FAF8F3]">Nordic</span>
                    <span class="text-[9px] tracking-[0.3em] uppercase text-[#D8C3A5]">Pure Nutrition & Hydration</span>
                </div>

                <p class="font-heading italic text-lg sm:text-xl text-[#FAF8F3]/90 max-w-md font-normal leading-relaxed">
                    “Pure Living. Conscious Nutrition.”
                </p>

                <p class="text-xs sm:text-sm text-[#A0A0A0] leading-relaxed max-w-sm">
                    Rooted in pristine volcanic aquifers, living probiotic fermentations, and sustainably harvested plant milks. We bring clean, nutrient-dense vitality to your daily routine.
                </p>

                {{-- Contact Info Snippet --}}
                <div class="pt-2 text-xs text-[#888888] space-y-1">
                    <p>Nutrition Studio: Kronprinsens Gade 14, Copenhagen</p>
                    <p>Concierge: <a href="mailto:concierge@nordichome.test" class="text-[#D8C3A5] hover:underline">concierge@nordichome.test</a></p>
                </div>
            </div>

            {{-- Column 2: Shop --}}
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-widest text-[#D8C3A5] mb-5">
                    Shop Categories
                </h4>
                <ul class="space-y-3 text-xs sm:text-sm text-[#B0B0B0]">
                    <li>
                        <a href="{{ route('categories.show', 'waters-natural-hydration') }}" class="hover:text-white transition-colors">
                            Natural Mineral Waters
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.show', 'probiotic-dairy-yogurt') }}" class="hover:text-white transition-colors">
                            Probiotic Yogurt & Dairy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.show', 'plant-based-milks-drinks') }}" class="hover:text-white transition-colors">
                            Plant-Based Milks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.show', 'active-high-protein') }}" class="hover:text-white transition-colors">
                            High Protein & Active
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.show', 'healthy-snacks-bowls') }}" class="hover:text-white transition-colors">
                            Healthy Snacks & Granola
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.show', 'specialized-early-life') }}" class="hover:text-white transition-colors">
                            Specialized Nutrition
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Company & Values --}}
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-widest text-[#D8C3A5] mb-5">
                    Our Standards
                </h4>
                <ul class="space-y-3 text-xs sm:text-sm text-[#B0B0B0]">
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-white transition-colors">
                            Purity & Sourcing
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-white transition-colors">
                            Microbiome Science
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inspiration.index') }}" class="hover:text-white transition-colors">
                            Nutrition Journal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('collections.index') }}" class="hover:text-white transition-colors">
                            Curated Collections
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-white transition-colors">
                            Eco-Packaging Pledge
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Customer Care & Newsletter --}}
            <div class="space-y-4">
                <h4 class="text-xs font-semibold uppercase tracking-widest text-[#D8C3A5] mb-5">
                    Customer Care
                </h4>
                <ul class="space-y-3 text-xs sm:text-sm text-[#B0B0B0]">
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-white transition-colors">
                            Contact & Concierge
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" class="hover:text-white transition-colors">
                            Order Status & Tracking
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-white transition-colors">
                            Cold-Chain Delivery Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-white transition-colors">
                            FAQs & Storage Advice
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#888888] gap-4">
            <p>&copy; {{ date('Y') }} Nordic Nutrition & Hydration. All rights reserved.</p>
            <div class="flex items-center space-x-6">
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Customer Support</a>
            </div>
        </div>
    </div>
</footer>