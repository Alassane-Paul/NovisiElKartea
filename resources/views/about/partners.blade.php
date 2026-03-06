@extends('layouts.app')

@section('title', __('about.partners_title'))

@section('content')
<div class="overflow-hidden">
    {{-- Hero Section --}}
    <section class="relative min-h-[60vh] flex items-center justify-center pt-20">
        {{-- Background Image with Black Gradient Overlay --}}
        @if(isset($page) && $page->featured_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $page->featured_image) }}" class="w-full h-full object-cover" alt="{{ __('about.partners_title') }}">
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
                    {{ $page->current_title ?: __('about.partners_title') }}
                </h1>
                <div class="w-20 h-1.5 bg-[#ff9800] rounded-full animate-width-grow"></div>
            </div>
        </div>
    </section>
</div>

<div class="container mx-auto px-4 py-12">
    @if($page && $page->current_content)
    <div class="prose prose-lg max-w-4xl mx-auto mb-12 text-center" data-aos="fade-up">
        {!! $page->current_content !!}
    </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center overflow-hidden">
        @foreach($partners as $index => $partner)
        <div class="bg-white p-6 rounded-lg premium-contour flex items-center justify-center duration-300"
            data-aos="zoom-in" data-aos-delay="{{ ($index % 6) * 50 }}">
            @if($partner->logo)
            <img src="{{ asset('storage/' . $partner->logo) }}" class="max-h-24 object-contain" alt="{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}">
            @else
            <span class="text-gray-400 font-bold uppercase tracking-widest text-xs">{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}</span>
            @endif
        </div>
        @endforeach
    </div>
</div>
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