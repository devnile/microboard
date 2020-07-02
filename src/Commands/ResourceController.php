<?php

namespace Microboard\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Microboard\Foundations\Traits\MicroboardPathResolver;
use Symfony\Component\Console\Input\InputOption;

class ResourceController extends ControllerMakeCommand
{
    use MicroboardPathResolver;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'microboard:controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/controller.stub');
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param string $model
     * @return string
     *
     * @throws InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (!$this->option('namespaced') && !Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace . $model;
        }

        return $model;
    }

    /**
     * Build the model replacement values.
     *
     * @param array $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $replacements = parent::buildModelReplacements($replace);
        $use = "\r\nuse " . $replacements['{{ namespacedModel }}'] . ';';
        $method = "\r\n\r\n\t/**\r\n\t * @return string\r\n\t */\r\n\t" .
            "protected function getModel(): string\r\n\t{\r\n\t\t" .
            "return {$replacements['{{ model }}']}::class;\r\n\t}";

        if ($this->laravel->getNamespace() . $replacements['{{ model }}'] === $replacements['{{ namespacedModel }}']) {
            $use = '';
            $method = '';
        }

        return array_merge($replacements, [
            '{{ useModel }}' => $use,
            'useModel' => $use,
            '{{ getModelMethod }}' => $method
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ...$this->pathOptions(),
            ['api', null, InputOption::VALUE_NONE, 'Exclude the create and edit methods from the controller.'],
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the controller already exists'],
            ['invokable', 'i', InputOption::VALUE_NONE, 'Generate a single method, invokable controller class.'],
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Generate a resource controller for the given model.'],
            ['parent', 'p', InputOption::VALUE_OPTIONAL, 'Generate a nested resource controller class.'],
            ['resource', 'r', InputOption::VALUE_NONE, 'Generate a resource controller class.'],
            ['namespaced', '', InputOption::VALUE_NONE, 'The Model you provided is includes his namespace.'],
        ];
    }
}
