@extends('layouts.app')

@section('title', __('join.title'))

@section('content')
<div class="relative bg-teal-800 py-10 md:py-12 mb-6 md:mb-8">
    @if($page && $page->featured_image)
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/' . $page->featured_image) }}" class="w-full h-full object-cover opacity-30" alt="{{ $page->title[app()->getLocale()] ?? $page->title['es'] ?? __('join.title') }}">
    </div>
    @endif
    <div class="container mx-auto px-4 relative z-10 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $page->title[app()->getLocale()] ?? $page->title['es'] ?? __('join.title') }}</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        <div class="prose prose-lg">
            @if($page)
            {!! $page->content[app()->getLocale()] ?? $page->content['es'] !!}
            @else
            <p>{{ __('join.default_content') }}</p>
            @endif
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('join.form_title') }}</h2>
            <form method="POST" action="{{ route('join.store') }}">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">{{ __('join.label_name') }}</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all" placeholder="{{ __('join.placeholder_name') }}" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">{{ __('join.label_email') }}</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all" placeholder="{{ __('join.placeholder_email') }}" required>
                </div>
                <div class="mb-8">
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">{{ __('join.label_message') }}</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all" placeholder="{{ __('join.placeholder_message') }}"></textarea>
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-sm">
                    {{ __('join.submit_button') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection