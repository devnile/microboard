<?php

namespace Microboard\Tests;

use Microboard\MicroboardServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app)
    {
        return [
            MicroboardServiceProvider::class
        ];
    }
}
