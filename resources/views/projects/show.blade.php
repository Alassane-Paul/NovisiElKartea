@extends('layouts.app')

@section('title', $project->title[app()->getLocale()] ?? $project->title['es'])

@section('content')
<div class="overflow-hidden bg-white">
    {{-- Hero Section --}}
    <section class="relative min-h-[40vh] md:min-h-[50vh] flex items-center justify-center pt-12 md:pt-16 pb-12">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-teal-900 to-[#00695c]">
            @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover opacity-30" alt="{{ $project->title[app()->getLocale()] ?? $project->title['es'] }}">
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/60 to-teal-800/30 mix-blend-multiply"></div>
        </div>

        {{-- Decorative SVG --}}
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white text-center">
            <span class="text-teal-200 font-bold uppercase tracking-widest text-xs mb-4 block animate-fade-in-down">{{ $project->category ?? __('messages.general') }}</span>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up leading-tight">
                {{ $project->title[app()->getLocale()] ?? $project->title['es'] }}
            </h1>
            <div class="w-20 h-1.5 bg-[#ff9800] mx-auto rounded-full animate-width-grow"></div>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Metadata --}}
                <div class="flex flex-wrap gap-6 mb-12 py-6 border-y border-gray-100 items-center justify-center md:justify-start" data-aos="fade-up">
                    <div class="flex items-center text-gray-500">
                        <i class="far fa-calendar-alt text-teal-600 mr-2"></i>
                        <span class="text-sm font-medium">
                            @if($project->start_date)
                            {{ $project->start_date->format('M Y') }}
                            @endif
                            @if($project->end_date)
                            - {{ $project->end_date->format('M Y') }}
                            @else
                            - {{ __('messages.ongoing') }}
                            @endif
                        </span>
                    </div>
                    @if($project->location)
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-map-marker-alt text-teal-600 mr-2"></i>
                        <span class="text-sm font-medium">{{ $project->location }}</span>
                    </div>
                    @endif
                </div>

                {{-- Description Short --}}
                <div class="text-xl md:text-2xl text-teal-900 font-medium mb-12 italic leading-relaxed text-center" data-aos="fade-up" data-aos-delay="100">
                    {!! $project->description[app()->getLocale()] ?? $project->description['es'] !!}
                </div>

                {{-- Main Content --}}
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed content-justified" data-aos="fade-up" data-aos-delay="200">
                    {!! $project->content[app()->getLocale()] ?? $project->content['es'] !!}
                </div>

                {{-- Contact CTA --}}
                <div class="mt-12 bg-teal-50 rounded-3xl p-8 md:p-12 text-center border border-teal-100" data-aos="zoom-in">
                    <h3 class="text-2xl font-bold text-teal-900 mb-6">{{ __('messages.project_interest_title') }}</h3>
                    <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                        {{ __('messages.project_interest_desc') }}
                    </p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center bg-teal-800 hover:bg-teal-900 text-white font-bold py-4 px-10 rounded-2xl shadow-lg transition-all transform hover:-translate-y-1">
                        {{ __('header.contact') }}
                        <i class="fas fa-paper-plane ml-3 text-sm"></i>
                    </a>
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

    .animate-width-grow {
        animation: width-grow 1s ease-out forwards;
    }

    /* Custom prose styles for dynamic content */
    .prose h2 {
        color: #134e4a;
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .prose h3 {
        color: #0f766e;
        font-weight: 700;
        margin-top: 2rem;
    }

    .prose ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 2rem;
    }

    .prose li {
        position: relative;
        padding-left: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .prose li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #f97316;
        font-weight: 900;
    }

    .prose strong {
        color: #111827;
    }
</style>
@endsection