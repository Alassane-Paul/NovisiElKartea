@extends('layouts.app')

@section('title', __('Home'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">{{ __('Welcome to Novisi Elkartea') }}</h1>
    <p class="mb-4">{{ __('Building bridges between cultures.') }}</p>
</div>
@endsection
