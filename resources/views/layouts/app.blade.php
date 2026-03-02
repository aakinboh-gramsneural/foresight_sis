<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Foresight Corporate Governance Consulting')</title>
    <meta name="description" content="@yield('meta_description', 'Foresight Corporate Governance Consulting - Expert governance, compliance, and strategic consulting services with over 20 years of experience.')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Foresight Corporate Governance Consulting')">
    <meta property="og:description" content="@yield('meta_description', 'Expert governance, compliance, and strategic consulting services.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/foresightcgc1.png') }}">
    <meta property="og:site_name" content="Foresight Corporate Governance Consulting">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'Foresight Corporate Governance Consulting')">
    <meta name="twitter:description" content="@yield('meta_description', 'Expert governance, compliance, and strategic consulting services.')">
    <meta name="twitter:image" content="{{ asset('images/foresightcgc1.png') }}">

    <!-- Canonical & Sitemap -->
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/images/foresightcgc1.png" type="image/png">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "Foresight Corporate Governance Consulting",
        "description": "Expert corporate governance, compliance, and strategic consulting services with over 20 years of experience.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/foresightcgc1.png') }}",
        "telephone": "4036671396",
        "email": "admin@foresightcosec.com",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Calgary",
            "addressRegion": "Alberta",
            "addressCountry": "CA"
        },
        "areaServed": "CA",
        "priceRange": "$$",
        "serviceType": ["Corporate Governance", "Board Development", "Compliance Consulting", "Strategic Planning", "Training & Retreats"],
        "foundingDate": "2004",
        "sameAs": []
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Analytics (replace UA_ID with your tracking ID) -->
    @if(config('services.google.analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
    @endif

    @stack('head')
</head>
<body class="font-body" x-data="{ mobileMenuOpen: false }" :class="{ 'overflow-hidden': mobileMenuOpen }">

    {{-- Skip to Content (Accessibility) --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[200] focus:bg-gold-500 focus:text-navy-900 focus:px-4 focus:py-2 focus:font-heading focus:font-semibold focus:text-sm">
        Skip to main content
    </a>

    {{-- Scroll Progress Bar --}}
    <div id="scroll-progress"></div>

    {{-- Page transition overlay --}}
    <div class="page-transition-overlay" id="page-transition"></div>

    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Mobile Menu --}}
    @include('components.mobile-menu')

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Back to Top Button --}}
    <button id="back-to-top" aria-label="Back to top">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    @stack('scripts')

</body>
</html>
