@extends('layouts.app')

@section('title', __('header.projects'))

@section('content')
<div class="overflow-hidden bg-white">
    {{-- Hero Section --}}
    {{-- Hero Section --}}
    <section class="relative min-h-[40vh] flex items-center justify-center pt-20">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-teal-900 to-[#00695c]">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/40 to-teal-800/20 mix-blend-multiply"></div>
        </div>

        {{-- Decorative SVG Elements --}}
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in-up uppercase tracking-tight">
                {{ __('header.projects') }}
            </h1>
            <div class="w-20 h-1.5 bg-[#ff9800] mx-auto rounded-full animate-width-grow"></div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($projects as $project)
                    <div class="group bg-white rounded-2xl overflow-hidden premium-contour transition-all duration-500 hover:-translate-y-2 flex flex-col">
                        {{-- Project Image --}}
                        <div class="aspect-[4/3] overflow-hidden relative">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $project->title[app()->getLocale()] ?? $project->title['es'] }}">
                            @else
                                <div class="w-full h-full bg-teal-800 flex items-center justify-center">
                                    <i class="fas fa-project-diagram text-white text-6xl opacity-20"></i>
                                </div>
                            @endif
                            {{-- Badge --}}
                            @if($project->featured)
                                <div class="absolute top-4 right-4 bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                    {{ __('Destacado') }}
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/20 mix-blend-multiply opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        {{-- Project Content --}}
                        <div class="p-8 flex-grow flex flex-col">
                            <span class="text-teal-600 font-bold uppercase tracking-widest text-[10px] mb-3 block italic">{{ $project->category ?? __('General') }}</span>
                            <h3 class="text-2xl font-bold text-teal-900 mb-4 leading-tight group-hover:text-orange-600 transition-colors">
                                {{ $project->title[app()->getLocale()] ?? $project->title['es'] }}
                            </h3>
                            <p class="text-gray-600 mb-8 line-clamp-3 text-sm leading-relaxed">
                                {{ $project->description[app()->getLocale()] ?? $project->description['es'] }}
                            </p>
                            <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                <span class="text-xs text-gray-400 flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $project->start_date ? $project->start_date->format('M Y') : '---' }}
                                </span>
                                <a href="{{ route('contact.index') }}" class="text-teal-800 font-bold text-sm flex items-center hover:text-orange-600 transition-colors">
                                    {{ __('Saber más') }}
                                    <i class="fas fa-chevron-right ml-2 text-[10px] transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-24 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
                        <i class="fas fa-folder-open text-gray-300 text-6xl mb-6"></i>
                        <h3 class="text-xl font-bold text-gray-500">{{ __('No hay proyectos activos en este momento.') }}</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-teal-900 mb-8">{{ __('¿Tienes una idea para un proyecto?') }}</h2>
                <p class="text-gray-600 text-lg mb-12 leading-relaxed">
                    {{ __('Estamos siempre abiertos a nuevas propuestas que fomenten la interculturalidad y la justicia social. Cuéntanos tu idea.') }}
                </p>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center bg-teal-800 hover:bg-teal-900 text-white font-bold py-4 px-12 rounded-2xl shadow-xl transition-all transform hover:-translate-y-1">
                    {{ __('header.contact') }}
                    <i class="fas fa-paper-plane ml-3 text-sm"></i>
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
</style>
@endsection
