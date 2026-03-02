@php
    $footer = \App\Models\FooterSetting::first();
    $contactInfo = \App\Models\ContactInfo::orderBy('order')->get();
@endphp

<footer class="bg-navy-950 text-white relative overflow-hidden">
    {{-- Decorative gold line at top --}}
    <div class="h-px bg-gradient-to-r from-transparent via-gold-500 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Footer --}}
        <div class="py-16 md:py-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6 group">
                    <img src="/images/foresightcgc1.png" alt="Foresight CGC" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                    <div>
                        <span class="text-white font-heading font-bold text-lg leading-tight block">Foresight</span>
                        <span class="text-gold-500 text-[10px] font-heading uppercase tracking-[0.15em] leading-tight block">Corporate Governance</span>
                    </div>
                </a>
                @if($footer && $footer->tagline)
                    <p class="text-white/60 font-body text-sm leading-relaxed mb-6">
                        {{ $footer->tagline }}
                    </p>
                @endif
                {{-- Social Links --}}
                @if($footer && $footer->social_links)
                    <div class="flex gap-3">
                        @foreach($footer->social_links as $social)
                            <a href="{{ $social['url'] ?? '#' }}"
                               class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/60 hover:text-navy-900 hover:bg-gold-500 hover:border-gold-500 transition-all duration-300 hover:-translate-y-0.5"
                               aria-label="{{ $social['name'] ?? '' }}"
                               target="_blank" rel="noopener">
                                @if(($social['icon'] ?? '') === 'linkedin')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                @elseif(($social['icon'] ?? '') === 'twitter')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-heading font-semibold text-sm uppercase tracking-widest text-gold-500 mb-6">Navigation</h4>
                <ul class="space-y-3">
                    @foreach(['home' => 'Home', 'about' => 'About Us', 'services' => 'Our Services', 'contact' => 'Contact'] as $route => $label)
                        <li>
                            <a href="{{ route($route) }}" class="text-white/60 hover:text-gold-400 hover:translate-x-1 inline-block transition-all duration-300 text-sm font-body">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="font-heading font-semibold text-sm uppercase tracking-widest text-gold-500 mb-6">Services</h4>
                <ul class="space-y-3">
                    @foreach(['Governance & Policies', 'Training & Retreats', 'Admin & Compliance', 'Strategic Consulting'] as $service)
                        <li>
                            <a href="{{ route('services') }}" class="text-white/60 hover:text-gold-400 hover:translate-x-1 inline-block transition-all duration-300 text-sm font-body">
                                {{ $service }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-heading font-semibold text-sm uppercase tracking-widest text-gold-500 mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    @foreach($contactInfo as $info)
                        <li class="flex items-start gap-3 group">
                            <span class="text-gold-500 mt-0.5 transition-transform duration-300 group-hover:scale-110">
                                @if($info->type === 'phone')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                @elseif($info->type === 'email')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @elseif($info->type === 'address')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                @elseif($info->type === 'hours')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </span>
                            <span class="text-white/60 text-sm font-body group-hover:text-white/80 transition-colors duration-300">{{ $info->value }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10 py-8">
            @if($footer && $footer->disclaimer)
                <p class="text-white/40 text-xs font-body leading-relaxed mb-6 max-w-4xl">
                    {{ $footer->disclaimer }}
                </p>
            @endif
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-white/40 text-xs font-body">
                    &copy; {{ date('Y') }} Foresight Corporate Governance Consulting. All rights reserved.
                </p>
                <p class="text-white/40 text-xs font-body">
                    Built by <a href="https://toptechng.com/" target="_blank" rel="noopener" class="text-gold-500 font-heading font-semibold hover:text-gold-400 transition-colors duration-300">Toptech</a>
                </p>
                <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
                        class="text-white/40 hover:text-gold-500 transition-colors duration-300 text-xs font-heading uppercase tracking-wider flex items-center gap-2">
                    Back to Top
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</footer>
