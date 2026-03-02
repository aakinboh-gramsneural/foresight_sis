@extends('layouts.app')

@section('title', 'Server Error - Foresight CGC')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center bg-navy-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gold-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative text-center px-4 sm:px-6 lg:px-8">
        <p class="text-gold-500 font-heading font-bold text-8xl md:text-9xl mb-4">500</p>
        <h1 class="text-2xl md:text-3xl font-heading font-bold text-white mb-4">Something Went Wrong</h1>
        <p class="text-white/60 font-body text-lg mb-10 max-w-md mx-auto">
            We're experiencing a temporary issue. Please try again later.
        </p>
        <a href="{{ route('home') }}" class="btn-primary">Back to Home</a>
    </div>
</section>
@endsection
