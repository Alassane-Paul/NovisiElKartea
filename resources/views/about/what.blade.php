@extends('layouts.app')

@section('title', $page->current_title)

@section('content')
<div class="overflow-hidden">
    {{-- Hero Section --}}
    <section class="relative min-h-[60vh] flex items-center justify-center pt-12 md:pt-16">
        {{-- Background Image with Parallax-like Overlay --}}
        @if($page->featured_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $page->featured_image) }}" class="w-full h-full object-cover" alt="{{ $page->current_title }}">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/90 to-teal-800/60 mix-blend-multiply"></div>
        </div>
        @else
        <div class="absolute inset-0 bg-gradient-to-br from-teal-900 to-[#00695c] z-0"></div>
        @endif

        {{-- Decorative SVG Elements --}}
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white py-12">
            <div class="max-w-4xl">
                <nav class="flex mb-4 text-teal-200 text-sm font-medium animate-fade-in-down">
                    <a href="{{ route('home') }}" class="hover:underline">{{ __('header.home') }}</a>
                    <span class="mx-2">/</span>
                    <span>{{ __('header.about') }}</span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight animate-fade-in-up" data-aos="fade-down" data-aos-duration="1000">
                    {{ $page->current_title }}
                </h1>
                <div class="w-20 h-1.5 bg-[#ff9800] rounded-full animate-width-grow"></div>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-12 relative bg-white">
        {{-- Subtle Background Pattern --}}
        <div class="absolute top-0 right-0 w-64 h-64 opacity-5 pointer-events-none -translate-y-1/2 translate-x-1/4">
            <svg viewBox="0 0 100 100" class="w-full h-full text-teal-900 fill-current">
                <circle cx="50" cy="50" r="40" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="8 4" />
            </svg>
        </div>

        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg lg:prose-xl prose-teal max-w-none text-gray-700 leading-relaxed space-y-8 animate-fade-in" data-aos="fade-up">
                    {!! $page->current_content !!}
                </div>

                {{-- Call to Action Card --}}
                <div class="mt-12 bg-gray-50 rounded-3xl p-8 md:p-12 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow duration-300" data-aos="zoom-in-up" data-aos-duration="1000">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#ff9800]/10 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold text-teal-900 mb-2">{{ __('about.cta_title') }}</h3>
                            <p class="text-gray-600 max-w-md">{{ __('about.cta_description') }}</p>
                        </div>
                        <a href="{{ route('join.index') }}" class="inline-flex items-center justify-center bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold py-4 px-10 rounded-2xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            {{ __('header.join') }}
                            <i class="fas fa-arrow-right ml-3 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes width-grow {
        from {
            width: 0;
        }

        to {
            width: 5rem;
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out forwards;
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out forwards;
    }

    .animate-width-grow {
        animation: width-grow 1s ease-out forwards;
    }
</style>
@endsection