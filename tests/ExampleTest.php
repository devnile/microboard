<?php

namespace Microboard\Tests;

use Orchestra\Testbench\TestCase;
use Devnile\Microboard\MicroboardServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MicroboardServiceProvider::class];
    }
}
