@extends('layouts.app')

@section('title', 'Contact Us - Foresight CGC')
@section('meta_description', 'Get in touch with Foresight Corporate Governance Consulting. We are ready to help your organization achieve governance excellence.')

@section('content')

{{-- ========== HERO ========== --}}
<section class="relative h-[50vh] min-h-[350px] max-h-[500px] bg-navy-950 overflow-hidden flex items-center">
    <div class="absolute inset-0">
        <img src="/images/contact-hero.jpg" alt="Contact Us" class="w-full h-full object-cover opacity-20" data-parallax="-0.2">
    </div>
    <div class="overlay-gradient"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <span class="section-tag text-gold-400 block mb-4">Get In Touch</span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-bold text-white leading-tight mb-6">
                Contact Us
            </h1>
            <p class="text-xl text-white/60 font-body">
                Ready to strengthen your organization's governance? We'd love to hear from you.
            </p>
            <div class="gold-line mt-8"></div>
        </div>
    </div>
</section>

{{-- ========== CONTACT FORM & INFO ========== --}}
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-16">
            {{-- Contact Form --}}
            <div class="lg:col-span-3 gsap-fade-left">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-navy-900 mb-2">Send Us a Message</h2>
                <p class="text-navy-600 font-body mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-8 p-6 bg-green-50 border border-green-200 rounded-xl" x-data="{ show: true }" x-show="show">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-green-800 font-heading font-semibold">Message Sent!</p>
                                <p class="text-green-700 font-body text-sm mt-1">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="ml-auto text-green-400 hover:text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST"
                      x-data="contactForm()"
                      @submit.prevent="submitForm($el)"
                      class="space-y-6">
                    @csrf

                    {{-- Honeypot fields - hidden from humans, traps bots --}}
                    <div class="absolute -left-[9999px]" aria-hidden="true">
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                        <input type="text" name="phone_number" tabindex="-1" autocomplete="off">
                    </div>

                    {{-- Timestamp for speed check --}}
                    <input type="hidden" name="_form_loaded" value="{{ now()->timestamp }}">

                    {{-- JS verification token - only set by JavaScript --}}
                    <input type="hidden" name="_js_token" value="">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-heading font-medium text-navy-900 mb-2">Full Name *</label>
                            <input type="text" name="name" id="name" required
                                   value="{{ old('name') }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl font-body text-navy-900 placeholder-gray-400 focus:outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 transition-all duration-300"
                                   placeholder="John Doe">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 font-body">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-heading font-medium text-navy-900 mb-2">Email Address *</label>
                            <input type="email" name="email" id="email" required
                                   value="{{ old('email') }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl font-body text-navy-900 placeholder-gray-400 focus:outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 transition-all duration-300"
                                   placeholder="john@example.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 font-body">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Subject --}}
                    <div>
                        <label for="subject" class="block text-sm font-heading font-medium text-navy-900 mb-2">Subject</label>
                        <input type="text" name="subject" id="subject"
                               value="{{ old('subject') }}"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl font-body text-navy-900 placeholder-gray-400 focus:outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 transition-all duration-300"
                               placeholder="How can we help?">
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div>
                        <label for="message" class="block text-sm font-heading font-medium text-navy-900 mb-2">Message *</label>
                        <textarea name="message" id="message" rows="6" required
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl font-body text-navy-900 placeholder-gray-400 focus:outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 transition-all duration-300 resize-none"
                                  placeholder="Tell us about your governance needs...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CAPTCHA --}}
                    <div>
                        <label for="captcha" class="block text-sm font-heading font-medium text-navy-900 mb-2">Security Check *</label>
                        <div class="flex items-center gap-4">
                            <div id="captcha-image" class="flex-shrink-0 select-none">
                                @include('components.captcha-svg', ['question' => session('captcha_question')])
                            </div>
                            <button type="button" @click="refreshCaptcha()" title="Get a new question" class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-gray-50 border border-gray-200 text-navy-400 hover:text-gold-600 hover:border-gold-300 transition-all duration-300">
                                <svg class="w-5 h-5" :class="{ 'animate-spin': refreshing }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </button>
                        </div>
                        <input type="number" name="captcha" id="captcha" required
                               class="mt-3 w-40 px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl font-body text-navy-900 placeholder-gray-400 focus:outline-none focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 transition-all duration-300"
                               placeholder="Your answer">
                        @error('captcha')
                            <p class="mt-2 text-sm text-red-600 font-body">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit" class="btn-primary w-full sm:w-auto" :disabled="submitting">
                            <span x-show="!submitting">Send Message</span>
                            <span x-show="submitting" x-cloak class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="lg:col-span-2 gsap-fade-right">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-navy-900 mb-2">Contact Information</h2>
                <p class="text-navy-600 font-body mb-8">Reach out through any of the following channels.</p>

                <div class="space-y-6">
                    @foreach($contactInfo as $info)
                        <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-xl hover:bg-gold-50/50 transition-colors duration-300 group">
                            <div class="w-12 h-12 bg-navy-900 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-gold-500 transition-colors duration-300">
                                @if($info->type === 'phone')
                                    <svg class="w-5 h-5 text-gold-500 group-hover:text-navy-900 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                @elseif($info->type === 'email')
                                    <svg class="w-5 h-5 text-gold-500 group-hover:text-navy-900 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @elseif($info->type === 'address')
                                    <svg class="w-5 h-5 text-gold-500 group-hover:text-navy-900 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                @elseif($info->type === 'hours')
                                    <svg class="w-5 h-5 text-gold-500 group-hover:text-navy-900 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-heading font-semibold text-navy-900">{{ $info->label }}</h4>
                                @if($info->type === 'phone')
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $info->value) }}" class="text-navy-600 font-body hover:text-gold-600 transition-colors">{{ $info->value }}</a>
                                @elseif($info->type === 'email')
                                    <a href="mailto:{{ $info->value }}" class="text-navy-600 font-body hover:text-gold-600 transition-colors">{{ $info->value }}</a>
                                @else
                                    <p class="text-navy-600 font-body">{{ $info->value }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Map placeholder --}}
                <div class="mt-8 rounded-xl overflow-hidden h-64 bg-gray-200 relative">
                    <div class="absolute inset-0 flex items-center justify-center bg-navy-900/5">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-navy-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-navy-400 font-heading font-medium text-sm">Calgary, Alberta, Canada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function contactForm() {
        return {
            submitting: false,
            refreshing: false,
            init() {
                // Set JS verification token — bots without JS won't have this
                const token = btoa(Date.now().toString(36) + '|foresight');
                this.$el.querySelector('[name="_js_token"]').value = token;
            },
            async refreshCaptcha() {
                this.refreshing = true;
                try {
                    const res = await fetch('{{ route("captcha.refresh") }}', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const data = await res.json();
                    document.getElementById('captcha-image').innerHTML = data.svg;
                    document.getElementById('captcha').value = '';
                } catch (e) {}
                this.refreshing = false;
            },
            submitForm(form) {
                this.submitting = true;
                form.submit();
            }
        };
    }
</script>
@endpush
