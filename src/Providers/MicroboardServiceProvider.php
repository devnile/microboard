<?php

namespace Microboard\Providers;

use Carbon\Carbon;
use Microboard\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;
use Microboard\Commands\ResourceCommand;
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
                __DIR__ . '/../../stubs/web.stub' => base_path('routes/microboard.php'),
                __DIR__ . '/../../stubs/user.stub' => app_path('User.php'),
                __DIR__ . '/../../stubs/datatable-script.stub' => resource_path('views/vendor/datatables/script.blade.php'),
                __DIR__ . '/../../stubs/user-placeholder.png' => public_path('storage/user-placeholder.png'),
            ], 'microboard');

             $this->commands([
                 InstallCommand::class,
                 ResourceCommand::class
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
