<?php

namespace Microboard\Tests;

use Laravel\Ui\UiServiceProvider;
use Microboard\Providers\AuthServiceProvider;
use Microboard\Providers\MicroboardServiceProvider;
use Microboard\Providers\RouteServiceProvider;
use Microboard\Providers\ViewServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__ . '/../database/');
    }

    protected function getPackageProviders($app)
    {
        return [
            UiServiceProvider::class,

            MicroboardServiceProvider::class,
            RouteServiceProvider::class,
            AuthServiceProvider::class,
            ViewServiceProvider::class
        ];
    }
}
