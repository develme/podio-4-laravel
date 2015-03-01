<?php

namespace DevelMe\Podio;

use Illuminate\Support\ServiceProvider;

class PodioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('podio', function ($app) {
            $client_id = env('PODIO_CLIENT_ID');
            $client_secret = env('PODIO_CLIENT_SECRET');
            return new Podio(compact('client_id', 'client_secret'));

        });
    }
}
