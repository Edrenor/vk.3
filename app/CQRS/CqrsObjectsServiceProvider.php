<?php namespace App\CQRS;

use Illuminate\Support\ServiceProvider;

class CqrsObjectsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Objects::class, function ($app) {
            return new Objects();
        });
    }
}
