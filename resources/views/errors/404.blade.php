@extends('layouts.app')

@section('title', 'Page Not Found - Foresight CGC')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center bg-navy-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative text-center px-4 sm:px-6 lg:px-8">
        <p class="text-gold-500 font-heading font-bold text-8xl md:text-9xl mb-4">404</p>
        <h1 class="text-2xl md:text-3xl font-heading font-bold text-white mb-4">Page Not Found</h1>
        <p class="text-white/60 font-body text-lg mb-10 max-w-md mx-auto">
            The page you're looking for doesn't exist or has been moved.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('home') }}" class="btn-primary">Back to Home</a>
            <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>
@endsection
