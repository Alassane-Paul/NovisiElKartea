@extends('layouts.app')

@section('title', $service->title[app()->getLocale()] ?? $service->title['es'])

@section('content')
<div class="overflow-hidden bg-gray-50">
    {{-- Service Hero --}}
    <section class="relative min-h-[40vh] md:min-h-[50vh] flex items-center justify-center pt-16 pb-12 bg-teal-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if($service->image)
            <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover opacity-40 mix-blend-overlay" alt="{{ $service->title[app()->getLocale()] ?? $service->title['es'] }}">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-teal-900 via-teal-900/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-down">
            <div class="inline-flex items-center justify-center p-3 md:p-4 bg-white/10 rounded-2xl mb-6 backdrop-blur-sm border border-white/20">
                <i class="{{ $service->icon ?? 'fas fa-hand-holding-heart' }} text-orange-400 text-2xl md:text-3xl"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 uppercase tracking-tight px-4">
                {{ $service->title[app()->getLocale()] ?? $service->title['es'] }}
            </h1>
            <div class="w-20 h-1 bg-orange-500 mx-auto rounded-full"></div>

            <div class="mt-8">
                <a href="{{ url()->previous() }}" class="text-teal-200 hover:text-white transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left text-xs"></i>
                    {{ __('messages.back') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-teal-900/5 p-8 md:p-12" data-aos="fade-up">
                    {{-- Service Image & Introduction --}}
                    @if($service->image)
                    <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl premium-contour">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-auto object-cover" alt="{{ $service->title[app()->getLocale()] ?? $service->title['es'] }}">
                    </div>
                    @endif

                    @if($service->description[app()->getLocale()] ?? $service->description['es'] ?? false)
                    <div class="text-xl text-teal-800 font-medium mb-12 leading-relaxed border-l-4 border-orange-500 pl-6 italic bg-teal-50/30 py-6 rounded-r-2xl pr-6">
                        {!! $service->description[app()->getLocale()] ?? $service->description['es'] !!}
                    </div>
                    @endif

                    {{-- Main Content --}}
                    <div class="prose prose-lg max-w-none text-gray-600 prose-headings:text-teal-900 prose-a:text-orange-600 prose-strong:text-teal-900 leading-relaxed">
                        {!! $service->content[app()->getLocale()] ?? $service->content['es'] !!}
                    </div>

                    {{-- CTA --}}
                    <div class="mt-16 pt-12 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <h3 class="text-2xl font-bold text-teal-900 mb-2">{{ __('messages.questions_title') }}</h3>
                            <p class="text-gray-500">{{ __('messages.questions_subtitle') }}</p>
                        </div>
                        <a href="{{ route('contact.index') }}" class="w-full md:w-auto inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-10 rounded-2xl transition-all shadow-lg hover:shadow-orange-500/20 transform hover:-translate-y-1">
                            {{ __('header.contact') }}
                            <i class="fas fa-paper-plane ml-3 text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Services CTA --}}
    <section class="pb-12 overflow-hidden">
        <div class="container mx-auto px-4" data-aos="zoom-in">
            <div class="bg-teal-800 rounded-[3rem] p-12 text-center text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                <div class="relative z-10">
                    <h2 class="text-2xl md:text-3xl font-bold mb-6">{{ __('messages.discover_more') }}</h2>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center text-orange-400 font-bold hover:text-orange-300 transition-colors">
                        {{ __('messages.view_all_services') }}
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection