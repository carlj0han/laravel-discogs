<?php

namespace Jolita\LaravelDiscogs;

use Illuminate\Support\ServiceProvider;
use Jolita\DiscogsApi\DiscogsApi;
use GuzzleHttp\Client;

class DiscogsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-discogs.php' => config_path('laravel-discogs.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-discogs.php', 'laravel-discogs');

        $this->app->singleton('discogs', function () {

            $config = config('laravel-discogs');

            return new DiscogsApi(app(Client::class), $config['token'], $config['headers']['User-Agent']);
        });

    }
}
