<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MercadoPago;

class MercadoPagoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MercadoPago', function ($app) {
            MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
            return MercadoPago\SDK::class;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}