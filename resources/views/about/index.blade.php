@extends('layouts.app')

@section('title', __('header.about'))

@section('content')
<div class="overflow-hidden">
    {{-- 1. Hero Section (from 'Qué es') --}}
    <section class="relative min-h-[40vh] md:min-h-[60vh] flex items-center justify-center pt-12 md:pt-16">
        @if($whatPage && $whatPage->featured_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $whatPage->featured_image) }}" class="w-full h-full object-cover" alt="{{ $whatPage->current_title }}">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/90 to-teal-800/60 mix-blend-multiply"></div>
        </div>
        @else
        <div class="absolute inset-0 bg-gradient-to-br from-teal-900 to-[#00695c] z-0"></div>
        @endif

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white py-12">
            <div class="max-w-4xl">
                <nav class="flex mb-4 text-teal-200 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:underline">{{ __('header.home') }}</a>
                    <span class="mx-2">/</span>
                    <span>{{ __('header.about') }}</span>
                </nav>
                <h1 class="text-3xl md:text-6xl font-bold mb-6 leading-tight animate-fade-in-up" data-aos="fade-down">
                    {{ __('header.about') }}
                </h1>
                <div class="w-20 h-1.5 bg-[#ff9800] rounded-full animate-width-grow"></div>
            </div>
        </div>
    </section>

    {{-- 2. "Qué es" Content Section --}}
    @if($whatPage)
    <section class="py-12 relative bg-white border-b border-gray-50" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-teal-900 mb-8">{{ $whatPage->current_title }}</h2>
                <div class="prose prose-lg prose-teal max-w-none text-gray-700 leading-relaxed">
                    {!! $whatPage->current_content !!}
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 3. "Quiénes somos" Section --}}
    <section class="py-12 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4 text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-teal-900 mb-4">{{ __('about.who_title') }}</h2>
            <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full"></div>
        </div>

        <div class="container mx-auto px-4">
            @foreach(['board', 'technical'] as $category)
            @if(isset($members[$category]))
            <div class="mb-12 last:mb-0">
                <h3 class="text-xl md:text-2xl font-bold text-teal-800 mb-10 text-center uppercase tracking-wider" data-aos="fade-up">
                    {{ $category === 'board' ? __('messages.board_directors') : __('messages.technical_team') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($members[$category] as $index => $member)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-xl hover:-translate-y-1 duration-300"
                        data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}">
                        <div class="aspect-[4/5] overflow-hidden bg-gray-100 relative group">
                            @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110" alt="{{ $member->current_name }}">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-user-circle text-8xl"></i>
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-teal-900/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <div class="p-8 text-center">
                            <h4 class="text-xl font-bold text-gray-900 mb-1 text-center">{{ $member->current_name }}</h4>
                            <p class="text-orange-600 font-semibold mb-4 text-sm tracking-wide uppercase text-center">{{ $member->current_position }}</p>
                            @if($member->bio && isset($member->bio[app()->getLocale()]))
                            <div class="text-gray-600 text-sm italic content-justified">{!! $member->bio[app()->getLocale()] !!}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>

    {{-- 4. "Alianzas" Section --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-teal-900 mb-4">{{ __('about.partners_title') }}</h2>
            <div class="w-24 h-1.5 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <div class="container mx-auto px-4">
            @if($partnersPage && (isset($partnersPage->content[app()->getLocale()]) || isset($partnersPage->content['es'])))
            <div class="prose prose-lg max-w-4xl mx-auto mb-10 text-center text-gray-600">
                {!! $partnersPage->content[app()->getLocale()] ?? $partnersPage->content['es'] !!}
            </div>
            @endif

            <div class="relative overflow-hidden py-4">
                {{-- Gradient overlays for a smooth fade effect at edges --}}
                <div class="absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-white to-transparent z-10"></div>
                <div class="absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-white to-transparent z-10"></div>

                <div class="marquee-container" data-aos="fade-up">
                    <div class="marquee-content flex gap-10 items-center">
                        {{-- First set of logos --}}
                        @foreach($partners as $partner)
                        <div class="bg-white p-6 rounded-2xl border border-gray-50 flex items-center justify-center transition-all duration-500 hover:shadow-md h-32 w-48 md:w-64 flex-shrink-0">
                            @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="max-h-20 max-w-full object-contain" alt="{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}">
                            @else
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px] text-center px-2">{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}</span>
                            @endif
                        </div>
                        @endforeach

                        {{-- Duplicate set for seamless loop --}}
                        @foreach($partners as $partner)
                        <div class="bg-white p-6 rounded-2xl border border-gray-50 flex items-center justify-center transition-all duration-500 hover:shadow-md h-32 w-48 md:w-64 flex-shrink-0">
                            @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="max-h-20 max-w-full object-contain" alt="{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}">
                            @else
                            <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px] text-center px-2">{{ $partner->name[app()->getLocale()] ?? $partner->name['es'] }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>

    {{-- 5. Featured Projects Section --}}
    @if($featuredProjects->count() > 0)
    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4 text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-teal-900 mb-4">{{ __('messages.featured_projects') ?? 'Proyectos Destacados' }}</h2>
            <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full"></div>
        </div>

        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($featuredProjects as $idx => $project)
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl shadow-teal-900/5 group hover:shadow-2xl hover:shadow-teal-900/10 transition-all duration-500 hover:-translate-y-2 border border-gray-100"
                    data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                    {{-- Project Image --}}
                    <div class="aspect-video relative overflow-hidden">
                        @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $project->current_title }}">
                        @else
                        <div class="w-full h-full bg-teal-800 flex items-center justify-center">
                            <i class="fas fa-project-diagram text-white/20 text-6xl"></i>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-teal-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-4 left-6">
                            <span class="bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">{{ $project->category ?? __('messages.general') }}</span>
                        </div>
                    </div>

                    {{-- Project Content --}}
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-teal-900 mb-4 leading-tight group-hover:text-teal-700 transition-colors">{{ $project->current_title }}</h3>
                        <div class="text-gray-600 line-clamp-3 mb-6 text-sm leading-relaxed">
                            {!! strip_tags($project->current_description) !!}
                        </div>
                        <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center text-teal-700 font-bold group/link">
                            {{ __('header.see_more') }}
                            <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16" data-aos="fade-up">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center text-teal-800 font-bold hover:gap-3 transition-all duration-300">
                    {{ __('messages.view_all_projects') ?? 'Ver todos los proyectos' }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 6. Final CTA --}}
    <section class="py-12 bg-teal-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="container mx-auto px-4 relative z-10 text-center" data-aos="zoom-in">
            <h2 class="text-3xl md:text-5xl font-bold mb-6">{{ __('about.cta_title') }}</h2>
            <p class="text-teal-100 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                {{ __('about.cta_description') }}
            </p>
            <a href="{{ route('join.index') }}" class="inline-flex items-center justify-center bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold py-4 px-12 rounded-full shadow-2xl transition-all duration-300 transform hover:-translate-y-1 text-lg">
                {{ __('header.join') }}
                <i class="fas fa-arrow-right ml-3 text-sm"></i>
            </a>
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

    @keyframes width-grow {
        from {
            width: 0;
        }

        to {
            width: 5rem;
        }
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }

    .animate-width-grow {
        animation: width-grow 1s ease-out forwards;
    }

    .marquee-container {
        overflow: hidden;
        width: 100%;
    }

    .marquee-content {
        display: flex;
        width: max-content;
        animation: marquee 30s linear infinite;
    }

    .marquee-content:hover {
        animation-play-state: paused;
    }

    /* Adjust animation speed based on number of items if possible, but 30s is a good middle ground */
</style>
@endsection