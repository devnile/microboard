<?php

namespace Microboard\Providers;

use Microboard\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;
use Microboard\Factory;

class MicroboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot()
    {
         $this->loadMigrationsFrom(__DIR__ . '/../../database');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('microboard.php'),
            ], 'config');

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
