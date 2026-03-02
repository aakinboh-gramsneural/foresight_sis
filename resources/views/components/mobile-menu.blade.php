{{-- Full-screen mobile menu --}}
<div x-show="mobileMenuOpen"
     @keydown.escape.window="mobileMenuOpen = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[60] lg:hidden"
     x-cloak>

    {{-- Backdrop - fully opaque, click to close --}}
    <div class="absolute inset-0 bg-navy-950" @click="mobileMenuOpen = false"></div>

    {{-- Menu Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-6">
        {{-- Close Button --}}
        <button @click.stop="mobileMenuOpen = false"
                class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center text-white/70 hover:text-white transition-colors"
                aria-label="Close menu">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Nav Links --}}
        <nav class="flex flex-col items-center gap-8 mb-12">
            @php
                $mobileNavItems = [
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'about', 'label' => 'About'],
                    ['route' => 'services', 'label' => 'Services'],
                    ['route' => 'contact', 'label' => 'Contact'],
                ];
            @endphp

            @foreach($mobileNavItems as $item)
                <a href="{{ route($item['route']) }}"
                   @click="mobileMenuOpen = false"
                   class="text-3xl md:text-4xl font-heading font-bold transition-colors duration-300
                          {{ request()->routeIs($item['route']) ? 'text-gold-500' : 'text-white hover:text-gold-400' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- CTA --}}
        <a href="{{ route('contact') }}"
           @click="mobileMenuOpen = false"
           class="btn-primary">
            Get Started
        </a>

        {{-- Contact Info --}}
        @php
            $mobileEmail = \App\Models\ContactInfo::where('type', 'email')->first();
            $mobilePhone = \App\Models\ContactInfo::where('type', 'phone')->first();
        @endphp
        <div class="absolute bottom-12 text-center text-white/50 text-sm font-body">
            @if($mobileEmail)
                <p>{{ $mobileEmail->value }}</p>
            @endif
            @if($mobilePhone)
                <p class="mt-1">{{ $mobilePhone->value }}</p>
            @endif
        </div>
    </div>
</div>
