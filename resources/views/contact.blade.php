@extends('layouts.app')

@section('title', __('Contact'))

@section('content')
<div class="contact-form">
    <h1>{{ __('contact.title') }}</h1>
    
    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">{{ __('forms.name') }}</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">{{ __('forms.email') }}</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="message">{{ __('forms.message') }}</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <button type="submit" class="btn-submit">
            {{ __('buttons.send') }}
        </button>
    </form>
</div>
@endsection