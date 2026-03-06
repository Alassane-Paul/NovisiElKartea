<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer(
            ['layouts.app', 'about.*', 'services.*', 'projects.*', 'contact.*', 'home'],
            \App\Http\View\Composers\SettingsComposer::class
        );
        \Illuminate\Support\Facades\View::composer(
            ['layouts.app'],
            \App\Http\View\Composers\MenuComposer::class
        );
        URL::forceScheme('https');
    }
}
