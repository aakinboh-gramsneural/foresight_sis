{{-- Sticky Navigation --}}
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 nav-top transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="/images/foresightcgc1.png" alt="Foresight CGC" class="h-10 md:h-12 w-auto transition-transform duration-300 group-hover:scale-105">
                <div class="hidden sm:block">
                    <span class="text-white font-heading font-bold text-lg leading-tight block">Foresight</span>
                    <span class="text-gold-500 text-[10px] font-heading uppercase tracking-[0.15em] leading-tight block">Corporate Governance</span>
                </div>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navItems = [
                        ['route' => 'home', 'label' => 'Home'],
                        ['route' => 'about', 'label' => 'About'],
                        ['route' => 'services', 'label' => 'Services'],
                        ['route' => 'contact', 'label' => 'Contact'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="nav-link-underline px-5 py-2 text-sm font-heading font-medium tracking-wide transition-colors duration-300
                              {{ request()->routeIs($item['route']) ? 'text-gold-500 active' : 'text-white/80 hover:text-white' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <a href="{{ route('contact') }}" class="ml-4 btn-primary text-xs py-3 px-6">
                    Get Started
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden relative z-[70] w-10 h-10 flex items-center justify-center"
                    :class="{ 'hidden': mobileMenuOpen }"
                    aria-label="Toggle menu">
                <div class="w-6 flex flex-col gap-1.5">
                    <span class="block h-0.5 bg-white rounded-full transition-all duration-300"></span>
                    <span class="block h-0.5 bg-white rounded-full transition-all duration-300"></span>
                    <span class="block h-0.5 bg-white rounded-full transition-all duration-300"></span>
                </div>
            </button>
        </div>
    </div>
</nav>
