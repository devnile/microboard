<?php

namespace Microboard\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
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
            $this->publishes([
                __DIR__ . '/../../resources/views/layout/partials/navbar-links.blade.php' =>
                    resource_path('views/vendor/microboard/layout/partials/navbar-links.blade.php'),
                __DIR__ . '/../../resources/views/layout/partials/notifications.blade.php' =>
                    resource_path('views/vendor/microboard/layout/partials/notifications.blade.php'),
                __DIR__ . '/../../resources/views/layout/partials/user.blade.php' =>
                    resource_path('views/vendor/microboard/layout/partials/user.blade.php'),
            ], 'views');

            $this->publishes([
                __DIR__ . '/../../public' => public_path('vendor/microboard'),
            ], 'assets');

            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/microboard'),
            ], 'lang');*/
        }

        $this->registerFormComponents();
    }

    public function registerFormComponents()
    {
        FormBuilder::component(
            'argonInput',
            'microboard::input',
            ['name', 'type', 'value', 'attributes']
        );

        FormBuilder::component(
            'argonCheckbox',
            'microboard::checkbox',
            ['name', 'value', 'attributes']
        );
    }
}
