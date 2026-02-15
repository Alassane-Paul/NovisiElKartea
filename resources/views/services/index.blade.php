@extends('layouts.app')

@section('title', __('header.services'))

@section('content')
<div class="overflow-hidden bg-gray-50">
    {{-- Hero Section --}}
    {{-- Hero Section --}}
    <section class="relative min-h-[40vh] flex items-center justify-center pt-20">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-teal-900 to-[#00695c]">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/40 to-teal-800/20 mix-blend-multiply"></div>
        </div>

        {{-- Decorative SVG Elements --}}
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-[#f9fafb]"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in-up uppercase tracking-tight">
                {{ __('header.services') }}
            </h1>
            <div class="w-20 h-1.5 bg-orange-500 mx-auto rounded-full animate-width-grow"></div>
        </div>
    </section>

    {{-- Services Aggregated List --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="space-y-32">
                @forelse($services as $index => $service)
                    <div class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-12 lg:gap-20">
                        {{-- Service Image/Icon --}}
                        <div class="w-full lg:w-1/2 relative">
                            <div class="aspect-video rounded-2xl overflow-hidden premium-contour relative group">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $service->title[app()->getLocale()] ?? $service->title['es'] }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-teal-700 to-teal-900 flex items-center justify-center">
                                        <i class="{{ $service->icon ?? 'fas fa-hand-holding-heart' }} text-white text-9xl opacity-20 transition-transform group-hover:scale-110 duration-500"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/10 mix-blend-overlay"></div>
                            </div>
                            {{-- Decorative Background Element --}}
                            <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-teal-500/5 rounded-full blur-3xl"></div>
                        </div>

                        {{-- Service Content --}}
                        <div class="w-full lg:w-1/2">
                            <div class="max-w-xl mx-auto lg:mx-0">
                                <span class="text-orange-600 font-bold uppercase tracking-widest text-sm mb-4 block">{{ __('Servicio') }} {{ $index + 1 }}</span>
                                <h2 class="text-3xl md:text-4xl font-bold text-teal-900 mb-6 leading-tight">
                                    {{ $service->title[app()->getLocale()] ?? $service->title['es'] }}
                                </h2>
                                <div class="prose prose-lg text-gray-600 mb-10 leading-relaxed">
                                    {!! $service->content[app()->getLocale()] ?? $service->content['es'] !!}
                                </div>
                                <div class="flex flex-wrap gap-4">
                                     <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center bg-teal-800 hover:bg-teal-900 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        {{ __('header.contact') }}
                                        <i class="fas fa-envelope ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <i class="fas fa-info-circle text-teal-300 text-5xl mb-6"></i>
                        <p class="text-gray-500 text-xl">{{ __('No hay servicios disponibles en este momento.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-teal-900 to-teal-800 rounded-[3rem] p-8 md:p-16 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -ml-32 -mt-32"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-bold mb-8">{{ __('¿Quieres colaborar con nosotros?') }}</h2>
                    <p class="text-teal-100 text-lg mb-12 max-w-2xl mx-auto">
                        {{ __('about.cta_description') }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="{{ route('join.index') }}" class="w-full sm:w-auto bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold py-4 px-10 rounded-2xl shadow-lg transition-all transform hover:-translate-y-1">
                            {{ __('header.join') }}
                        </a>
                        <a href="{{ route('contact.index') }}" class="w-full sm:w-auto bg-transparent border-2 border-white/30 hover:bg-white/10 text-white font-bold py-4 px-10 rounded-2xl transition-all">
                            {{ __('header.contact') }}
                        </a>
                    </div>
                </div>
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
