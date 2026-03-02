@extends('layouts.app')

@section('title', ($page->title ?? 'About') . ' - Foresight CGC')
@section('meta_description', $page->meta_description ?? 'Learn about Foresight Corporate Governance Consulting.')

@section('content')

{{-- ========== HERO ========== --}}
<section class="relative h-[60vh] min-h-[400px] max-h-[600px] bg-navy-950 overflow-hidden flex items-center">
    <div class="absolute inset-0">
        <img src="/images/about-hero.jpg" alt="About Foresight CGC" class="w-full h-full object-cover opacity-30" data-parallax="-0.2">
    </div>
    <div class="overlay-gradient"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <span class="section-tag text-gold-400 block mb-4">About Us</span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-bold text-white leading-tight mb-6">
                {{ $page->title ?? 'About Foresight CGC' }}
            </h1>
            <p class="text-xl text-white/60 font-body">
                {{ $content['hero_subtitle'] ?? 'Our Story, Mission & Vision' }}
            </p>
            <div class="gold-line mt-8"></div>
        </div>
    </div>
</section>

{{-- ========== FILM STRIP ========== --}}
<section class="py-8 bg-navy-900 overflow-hidden">
    <div class="flex animate-marquee gap-4">
        @for($i = 0; $i < 2; $i++)
            @foreach(range(1, 6) as $n)
                <div class="film-strip-item flex-shrink-0">
                    <img src="/images/film-{{ $n }}.jpg" alt="Foresight at work"
                         class="w-full h-full object-cover opacity-60 hover:opacity-100 transition-opacity duration-500"
                         loading="lazy">
                </div>
            @endforeach
        @endfor
    </div>
</section>

{{-- ========== OUR STORY ========== --}}
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="gsap-fade-left">
                <span class="section-tag">Our Journey</span>
                <h2 class="section-title mb-6">{{ $content['story_title'] ?? 'Our Story' }}</h2>
                <div class="gold-line mb-8"></div>
                <div class="space-y-6">
                    @php
                        $storyText = $content['story_text'] ?? '';
                        $paragraphs = array_filter(explode("\n", $storyText));
                        if (empty($paragraphs)) $paragraphs = [$storyText];
                    @endphp
                    @foreach($paragraphs as $para)
                        <p class="text-navy-700 font-body text-lg leading-relaxed">{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            {{-- Image --}}
            <div class="relative gsap-fade-right">
                <div class="relative overflow-hidden rounded-2xl img-hover-zoom">
                    <img src="/images/our-story.jpg" alt="Our Story"
                         class="w-full h-[500px] object-cover"
                         loading="lazy">
                </div>
                {{-- Floating stat card --}}
                <div class="absolute -bottom-8 -left-8 bg-navy-900 text-white p-8 rounded-2xl shadow-2xl">
                    <div class="text-4xl font-heading font-bold text-gold-500">20+</div>
                    <div class="text-sm text-white/60 font-body mt-1">Years of Experience</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== MISSION & VISION ========== --}}
<section class="section-padding bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            {{-- Mission --}}
            <div class="bg-white rounded-2xl p-10 md:p-12 card-hover gsap-fade-up">
                <div class="w-14 h-14 bg-navy-900 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-heading font-bold text-navy-900 mb-4">{{ $content['mission_title'] ?? 'Our Mission' }}</h3>
                <div class="gold-line mb-6"></div>
                <p class="text-navy-700 font-body text-lg leading-relaxed">
                    {{ $content['mission_text'] ?? '' }}
                </p>
            </div>

            {{-- Vision --}}
            <div class="bg-white rounded-2xl p-10 md:p-12 card-hover gsap-fade-up">
                <div class="w-14 h-14 bg-navy-900 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-heading font-bold text-navy-900 mb-4">{{ $content['vision_title'] ?? 'Our Vision' }}</h3>
                <div class="gold-line mb-6"></div>
                <p class="text-navy-700 font-body text-lg leading-relaxed">
                    {{ $content['vision_text'] ?? '' }}
                </p>
            </div>
        </div>

        {{-- Values --}}
        @if(!empty($content['values']))
            <div class="mt-16 text-center gsap-fade-up">
                <span class="section-tag">What We Stand For</span>
                <h3 class="text-2xl md:text-3xl font-heading font-bold text-navy-900 mb-10">Our Core Values</h3>
                <div class="flex flex-wrap justify-center gap-4" data-stagger>
                    @foreach($content['values'] as $value)
                        <div class="px-8 py-4 bg-navy-900 text-white font-heading font-medium text-sm rounded-full hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 cursor-default">
                            {{ $value }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ========== CTA ========== --}}
<section class="relative py-24 bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gold-500/5 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center gsap-fade-up">
        <h2 class="text-3xl md:text-4xl font-heading font-bold text-white mb-6">
            Want to Work With Us?
        </h2>
        <p class="text-white/60 font-body text-lg mb-10 max-w-2xl mx-auto">
            Let's discuss how we can help your organization achieve governance excellence.
        </p>
        <a href="{{ route('contact') }}" class="btn-primary text-base">Get in Touch</a>
    </div>
</section>

@endsection
