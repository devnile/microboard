<?php

namespace Microboard\Commands;

use Arrilot\Widgets\Console\WidgetMakeCommand as Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Console\Input\InputOption;

class WidgetMakeCommand extends Command
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     * @throws BindingResolutionException
     */
    protected function getStub()
    {
        $stubPath = $this->laravel->make('config')->get('laravel-widgets.widget.stub');

        if (is_null($stubPath)) {
            return __DIR__ . '/../../stubs/widget.stub';
        }

        return $this->laravel->basePath() . '/' . $stubPath;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['plain', '', InputOption::VALUE_OPTIONAL, 'Use plain stub. No view is being created too.', true],
        ];
    }
}
