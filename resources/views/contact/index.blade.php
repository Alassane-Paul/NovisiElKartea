@extends('layouts.app')

@section('title', __('Contact'))

@section('content')
<div class="contact-form container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">{{ __('contact.title') }}</h1>
    
    <form method="POST" action="{{ route('contact.store') }}" class="max-w-lg">
        @csrf
        
        <div class="form-group mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">{{ __('forms.name') }}</label>
            <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        
        <div class="form-group mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('forms.email') }}</label>
            <input type="email" id="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        
        <div class="form-group mb-4">
            <label for="message" class="block text-gray-700 font-bold mb-2">{{ __('forms.message') }}</label>
            <textarea id="message" name="message" rows="5" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        
        <button type="submit" class="btn-submit bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            {{ __('buttons.send') }}
        </button>
    </form>
</div>
@endsection
