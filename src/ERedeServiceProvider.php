<?php

namespace lucasgiovanny\ERede;

use Illuminate\Support\ServiceProvider;

class ERedeServiceProvider extends ServiceProvider
{
    /**
     * Boot method
     * 
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . 'Config/erede.php' => config_path('erede.php')
            ],
            'erede'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/erede.php',
            'erede'
        );

        $this->app->singleton(
            Rede::class,
            function () {
                return new Rede(
                    config('erede.pv'),
                    config('erede.token'),
                    config('erede.sandbox')
                );
            }
        );
    }
}
