@extends('layouts.app')

@section('title', 'Foresight Corporate Governance Consulting')
@section('meta_description', 'Expert corporate governance, compliance, and strategic consulting services with over 20 years of experience. Building stronger boards and sustainable organizations.')

@section('content')

{{-- ========== HERO SECTION ========== --}}
<section class="relative h-screen min-h-[600px] max-h-[900px] overflow-hidden" x-data="heroCarousel()" x-init="init()">
    {{-- Background Slides --}}
    @foreach($slides as $i => $slide)
        <div class="hero-slide {{ $i === 0 ? 'active' : 'inactive' }}"
             :class="{ 'active': currentSlide === {{ $i }}, 'inactive': currentSlide !== {{ $i }} }">
            <img src="{{ $slide->image }}" alt="{{ $slide->title }}"
                 class="absolute inset-0 w-full h-full object-cover scale-110"
                 data-parallax="-0.2"
                 loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
            <div class="overlay-gradient"></div>
        </div>
    @endforeach

    {{-- Hero Content --}}
    <div class="relative z-20 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-3xl">
                <span class="section-tag text-gold-400 mb-6 block">Corporate Governance Consulting</span>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-white leading-[1.1] mb-6">
                    @if($slides->isNotEmpty())
                        <span x-text="slides[currentSlide]?.title || 'Governance Excellence'">{{ $slides->first()->title }}</span>
                    @else
                        Governance Excellence
                    @endif
                </h1>
                <p class="text-lg md:text-xl text-white/70 font-body mb-10 max-w-xl leading-relaxed">
                    @if($slides->isNotEmpty())
                        <span x-text="slides[currentSlide]?.subtitle || ''">{{ $slides->first()->subtitle }}</span>
                    @endif
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('services') }}" class="btn-primary">Our Services</a>
                    <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
                </div>
            </div>

            {{-- Slide Indicators --}}
            @if($slides->count() > 1)
                <div class="absolute bottom-12 left-4 sm:left-6 lg:left-8 flex gap-3">
                    @foreach($slides as $i => $slide)
                        <button @click="goTo({{ $i }})"
                                class="w-12 h-1 rounded-full transition-all duration-500"
                                :class="currentSlide === {{ $i }} ? 'bg-gold-500 w-16' : 'bg-white/30 hover:bg-white/50'">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ========== STATS SECTION ========== --}}
<section class="relative -mt-20 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-navy-900 rounded-2xl p-8 md:p-12 grid grid-cols-2 lg:grid-cols-4 gap-8 shadow-2xl shadow-navy-950/50">
            @foreach($stats as $stat)
                <div class="text-center">
                    <div class="stat-number" data-counter="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}">0{{ $stat->suffix }}</div>
                    <p class="text-white/50 font-body text-sm mt-2 uppercase tracking-wider">{{ $stat->label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== WHAT WE DO ========== --}}
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 gsap-fade-up">
            <span class="section-tag">What We Do</span>
            <h2 class="section-title">Our Services</h2>
            <div class="gold-line mx-auto mt-6"></div>
            <p class="section-subtitle mx-auto mt-6">
                Comprehensive governance solutions tailored to your organization's unique needs and challenges.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" data-stagger>
            @foreach($services as $service)
                <a href="{{ route('services') }}" class="group block bg-white border border-gray-100 p-8 card-hover rounded-xl">
                    {{-- Icon --}}
                    <div class="w-14 h-14 bg-navy-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-gold-500 transition-colors duration-500">
                        @if($service->icon === 'shield-check')
                            <svg class="w-6 h-6 text-gold-500 group-hover:text-navy-900 transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        @elseif($service->icon === 'academic-cap')
                            <svg class="w-6 h-6 text-gold-500 group-hover:text-navy-900 transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
                        @elseif($service->icon === 'clipboard-document-check')
                            <svg class="w-6 h-6 text-gold-500 group-hover:text-navy-900 transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/></svg>
                        @elseif($service->icon === 'chart-bar')
                            <svg class="w-6 h-6 text-gold-500 group-hover:text-navy-900 transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        @else
                            <svg class="w-6 h-6 text-gold-500 group-hover:text-navy-900 transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-heading font-bold text-navy-900 mb-3">{{ $service->title }}</h3>
                    <p class="text-navy-600 font-body text-sm leading-relaxed">{{ $service->description }}</p>
                    <div class="mt-6 flex items-center text-gold-600 font-heading text-sm font-semibold group-hover:text-gold-500 transition-colors">
                        Learn More
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== WHO WE ARE ========== --}}
<section class="section-padding bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Image --}}
            <div class="relative gsap-fade-left">
                <div class="relative overflow-hidden rounded-2xl img-hover-zoom">
                    <img src="{{ $whoWeAreImage }}"
                         alt="Who We Are"
                         class="w-full h-[500px] object-cover"
                         data-parallax="-0.15"
                         loading="lazy">
                </div>
                {{-- Decorative element --}}
                <div class="absolute -bottom-6 -right-6 w-48 h-48 border-2 border-gold-500/30 rounded-2xl -z-10"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 bg-gold-500/10 rounded-2xl -z-10"></div>
            </div>

            {{-- Content --}}
            <div class="gsap-fade-right">
                <span class="section-tag">About Us</span>
                <h2 class="section-title mb-6">Who We Are</h2>
                <div class="gold-line mb-8"></div>
                <p class="text-navy-700 font-body text-lg leading-relaxed mb-8">
                    {{ $whoWeAre }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('about') }}" class="btn-outline-dark">Learn More</a>
                    <a href="{{ route('contact') }}" class="btn-primary">Get in Touch</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== WHY CHOOSE US ========== --}}
<section class="section-padding bg-navy-900 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 gsap-fade-up">
            <span class="section-tag text-gold-400">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white leading-tight">
                Why Choose Foresight
            </h2>
            <div class="gold-line mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-stagger>
            @foreach($whyCards as $card)
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-10 text-center hover:bg-white/10 transition-all duration-500 group">
                    <div class="w-16 h-16 bg-gold-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gold-500/20 transition-colors duration-500">
                        @if($card['icon'] === 'trophy')
                            <svg class="w-8 h-8 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.996.178-1.768-.767-1.768-1.77 0-1.003.772-1.948 1.768-2.126a48.1 48.1 0 0113.5 0c.996.178 1.768.767 1.768 1.77 0 1.003-.772 1.948-1.768 2.126m-13.5 0V4.5a48.1 48.1 0 0013.5 0V4.236M5.25 4.236V2.466"/></svg>
                        @elseif($card['icon'] === 'puzzle-piece')
                            <svg class="w-8 h-8 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.4 48.4 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z"/></svg>
                        @else
                            <svg class="w-8 h-8 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-heading font-bold text-white mb-4">{{ $card['title'] }}</h3>
                    <p class="text-white/60 font-body text-sm leading-relaxed">{{ $card['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== FAQ SECTION ========== --}}
<section class="section-padding bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 gsap-fade-up">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="gold-line mx-auto mt-6"></div>
        </div>

        <div class="space-y-4" x-data="{ openFaq: null }">
            @foreach($faqs as $i => $faq)
                <div class="border border-gray-200 rounded-xl overflow-hidden gsap-fade-up transition-colors duration-300"
                     :class="openFaq === {{ $i }} ? 'border-gold-500/50 bg-gold-50/30' : 'hover:border-gray-300'">
                    <button @click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex items-center justify-between px-8 py-6 text-left">
                        <span class="font-heading font-semibold text-navy-900 pr-4">{{ $faq->question }}</span>
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-navy-900 flex items-center justify-center transition-transform duration-300"
                              :class="{ 'rotate-180 bg-gold-500': openFaq === {{ $i }} }">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>
                    <div x-show="openFaq === {{ $i }}"
                         x-collapse
                         x-cloak>
                        <div class="px-8 pb-6">
                            <p class="text-navy-700 font-body leading-relaxed">{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== CASE STUDIES MARQUEE ========== --}}
@if($caseStudies->isNotEmpty())
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="text-center gsap-fade-up">
            <span class="section-tag">Our Work</span>
            <h2 class="section-title">Case Studies</h2>
            <div class="gold-line mx-auto mt-6"></div>
        </div>
    </div>

    {{-- Infinite Marquee --}}
    <div class="relative">
        <div class="flex animate-marquee gap-6">
            @for($i = 0; $i < 2; $i++)
                @foreach($caseStudies as $cs)
                    <div class="flex-shrink-0 w-80 md:w-96 group">
                        <div class="relative overflow-hidden rounded-xl aspect-[4/3]">
                            <img src="{{ $cs->image }}" alt="{{ $cs->title }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white font-heading font-bold text-lg">{{ $cs->title }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endfor
        </div>
    </div>
</section>
@endif

{{-- ========== CTA SECTION ========== --}}
<section class="relative py-24 bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gold-500/5 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center gsap-fade-up">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-6">
            Ready to Strengthen Your Governance?
        </h2>
        <p class="text-white/60 font-body text-lg mb-10 max-w-2xl mx-auto">
            Partner with Foresight CGC to build governance frameworks that drive accountability, transparency, and organizational success.
        </p>
        <a href="{{ route('contact') }}" class="btn-primary text-base">
            Start a Conversation
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function heroCarousel() {
        return {
            currentSlide: 0,
            slides: @json($slides),
            interval: null,
            init() {
                if (this.slides.length > 1) {
                    this.interval = setInterval(() => this.next(), 5000);
                }
            },
            next() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            },
            goTo(index) {
                this.currentSlide = index;
                clearInterval(this.interval);
                this.interval = setInterval(() => this.next(), 5000);
            },
        };
    }
</script>
@endpush
