<?php

namespace Microboard\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Laravel\Ui\AuthRouteMethods;
use Microboard\Http\Middleware\Localization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Microboard\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        if (File::exists(base_path('routes/microboard.php'))) {
            $this->mapMicroboardRoutes();
        }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::prefix(config('microboard.routes.prefix', 'admin'))
            ->middleware(['web', Localization::class])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../../routes/web.php');
    }

    /**
     * Define the "Microboard" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapMicroboardRoutes()
    {
        Route::prefix(config('microboard.routes.prefix', 'admin'))
            ->middleware(array_merge(['web', Localization::class], config('microboard.routes.middleware', [])))
            ->name('microboard.')
            ->namespace(
                config('microboard.routes.namespace.base', 'Admin') . '\\' .
                config('microboard.routes.namespace.admin_directory', 'Admin')
            )
            ->group(base_path('routes/microboard.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix(config('microboard.routes.prefix', 'admin') . '/api')
            ->middleware(config('microboard.routes.apiMiddleware', []))
            ->name('microboard.api.')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../../routes/api.php');
    }

    public function register()
    {
        Route::mixin(new AuthRouteMethods);
    }
}
