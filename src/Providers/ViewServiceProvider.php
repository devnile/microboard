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
                __DIR__ . '/../../resources/views/index.blade.php' =>
                    resource_path('views/vendor/microboard/index.blade.php'),
                __DIR__ . '/../../resources/views/layouts/partials/navbar-links.blade.php' =>
                    resource_path('views/vendor/microboard/layouts/partials/navbar-links.blade.php'),
                __DIR__ . '/../../resources/views/layouts/partials/notifications.blade.php' =>
                    resource_path('views/vendor/microboard/layouts/partials/notifications.blade.php'),
                __DIR__ . '/../../resources/views/layouts/partials/logo.blade.php' =>
                    resource_path('views/vendor/microboard/layouts/partials/logo.blade.php'),
                __DIR__ . '/../../resources/views/layouts/partials/user.blade.php' =>
                    resource_path('views/vendor/microboard/layouts/partials/user.blade.php'),
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
            'argonTextarea',
            'microboard::textarea',
            ['name', 'value', 'attributes']
        );

        FormBuilder::component(
            'argonSelect',
            'microboard::select',
            ['name', 'list', 'value', 'attributes']
        );

        FormBuilder::component(
            'argonCheckbox',
            'microboard::checkbox',
            ['name', 'value', 'checked', 'attributes']
        );

        FormBuilder::component(
            'argonToggle',
            'microboard::toggle',
            ['name', 'value', 'checked', 'attributes']
        );

        FormBuilder::component(
            'avatar',
            'microboard::avatar',
            ['value', 'attributes']
        );

        FormBuilder::component(
            'files',
            'microboard::files',
            ['value', 'attributes']
        );

        FormBuilder::component(
            'trix',
            'microboard::trix',
            ['name', 'value', 'attributes']
        );
    }
}
