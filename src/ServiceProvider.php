<?php

namespace CherryneChou\LaravelCart;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
      $this->app->singleton(Cart::class, function () {
            return new Cart();
        });

        $this->app->alias(Cart::class, 'cart');
    }

     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Cart::class, 'cart'];
    }
}
