@extends('layouts.app')

@section('title', 'Our Services - Foresight CGC')
@section('meta_description', 'Comprehensive corporate governance services including governance frameworks, training, compliance, and strategic consulting.')

@section('content')

{{-- ========== HERO ========== --}}
<section class="relative h-[60vh] min-h-[400px] max-h-[600px] bg-navy-950 overflow-hidden flex items-center">
    <div class="absolute inset-0">
        <img src="/images/services-hero.jpg" alt="Our Services" class="w-full h-full object-cover opacity-30" data-parallax="-0.2">
    </div>
    <div class="overlay-gradient"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <span class="section-tag text-gold-400 block mb-4">What We Offer</span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-bold text-white leading-tight mb-6">
                Our Services
            </h1>
            <p class="text-xl text-white/60 font-body">
                Comprehensive governance solutions designed to strengthen your organization from the inside out.
            </p>
            <div class="gold-line mt-8"></div>
        </div>
    </div>
</section>

{{-- ========== SERVICE SECTIONS (ZIGZAG) ========== --}}
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-24 md:space-y-32">
            @foreach($sections as $i => $section)
                <div class="zigzag-section grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
                    {{-- Content --}}
                    <div class="zigzag-content {{ $i % 2 === 0 ? 'gsap-fade-left' : 'gsap-fade-right' }}">
                        <span class="section-tag">{{ $section->tag }}</span>
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-heading font-bold text-navy-900 mb-4">
                            {{ $section->title }}
                        </h2>
                        <div class="gold-line mb-6"></div>
                        <p class="text-navy-700 font-body text-lg leading-relaxed mb-8">
                            {{ $section->description }}
                        </p>

                        {{-- Bullet Items --}}
                        @if($section->items)
                            <ul class="space-y-3">
                                @foreach($section->items as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="flex-shrink-0 w-5 h-5 bg-gold-500/10 rounded-full flex items-center justify-center mt-0.5">
                                            <svg class="w-3 h-3 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                        <span class="text-navy-700 font-body">{{ is_array($item) ? $item['text'] : $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="mt-10">
                            <a href="{{ route('contact') }}" class="btn-primary text-xs">
                                Inquire About This Service
                            </a>
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="zigzag-image {{ $i % 2 === 0 ? 'gsap-fade-right' : 'gsap-fade-left' }}">
                        <div class="relative overflow-hidden rounded-2xl img-hover-zoom">
                            <img src="{{ $section->image }}" alt="{{ $section->title }}"
                                 class="w-full h-[400px] md:h-[500px] object-cover"
                                 loading="lazy">
                            {{-- Decorative overlay on hover --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-950/30 to-transparent"></div>
                        </div>
                        {{-- Decorative accent --}}
                        <div class="hidden md:block absolute {{ $i % 2 === 0 ? '-right-4' : '-left-4' }} -bottom-4 w-32 h-32 border-2 border-gold-500/20 rounded-2xl -z-10"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="relative py-24 bg-navy-900 overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center gsap-fade-up">
        <span class="section-tag text-gold-400 block mb-4">Get Started</span>
        <h2 class="text-3xl md:text-4xl font-heading font-bold text-white mb-6">
            Need a Customized Solution?
        </h2>
        <p class="text-white/60 font-body text-lg mb-10 max-w-2xl mx-auto">
            Every organization is unique. Let us design a governance solution tailored to your specific needs and objectives.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}" class="btn-primary text-base">Contact Us Today</a>
            <a href="{{ route('about') }}" class="btn-outline text-base">Learn About Us</a>
        </div>
    </div>
</section>

@endsection
