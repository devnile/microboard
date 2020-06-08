<?php

namespace Microboard\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'microboard');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'microboard');

        if ($this->app->runningInConsole()) {
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/microboard'),
            ], 'views');*/

            $this->publishes([
                __DIR__.'/../../public' => public_path('vendor/microboard'),
            ], 'assets');

            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/microboard'),
            ], 'lang');*/
        }
    }
}
