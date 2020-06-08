<?php

namespace Microboard\Providers;

use Microboard\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class MicroboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot()
    {
        // TODO:: Clean it
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'microboard');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'microboard');
         $this->loadMigrationsFrom(__DIR__ . '/../../database');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('microboard.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/microboard'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/microboard'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/microboard'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                 InstallCommand::class
             ]);
        }
    }

    /**
     * Register the package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'microboard');
        $this->app->singleton(Factory::class);
    }
}
