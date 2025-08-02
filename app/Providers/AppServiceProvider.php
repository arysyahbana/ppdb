<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
        Carbon::setLocale('id');
        App::setLocale('id');
        // if ((bool) env('HTTPS', true)) {
        //     $this->app['url']->forceScheme('https');
        // } else {
        //     $this->app['url']->forceScheme('http');
        // }

        // $this->app['request']->server->set('HTTPS', env('HTTPS'));
    }
}
