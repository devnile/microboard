<?php

namespace Microboard\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Laravel\Ui\UiServiceProvider;
use Microboard\Models\User;
use Microboard\Providers\AuthServiceProvider;
use Microboard\Providers\MicroboardServiceProvider;
use Microboard\Providers\RouteServiceProvider;
use Microboard\Providers\ViewServiceProvider;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use MockeryPHPUnitIntegration;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__ . '/../database/');
        $this->artisan('microboard:install')
            ->expectsConfirmation('Create new admin?');
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        if (File::isDirectory('./tests/tmp')) {
            File::deleteDirectory('./tests/tmp/app');
            File::deleteDirectory('./tests/tmp/resources/lang');
            File::deleteDirectory('./tests/tmp/resources/views/admin');
        }
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('microboard.roles.user', User::class);
    }

    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
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
