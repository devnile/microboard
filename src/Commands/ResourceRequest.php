<?php

namespace Microboard\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Illuminate\Support\Str;
use Microboard\Foundations\Traits\MicroboardPathResolver;
use Symfony\Component\Console\Input\InputOption;

class ResourceRequest extends RequestMakeCommand
{
    use MicroboardPathResolver;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'microboard:request';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceColumnsAndTranslationsPrefix($stub, $name);
    }

    /**
     * @param $stub
     * @param $name
     * @return string
     */
    private function replaceColumnsAndTranslationsPrefix(&$stub, $name)
    {
        $columns = '';

        if ($fillables = $this->option('columns')) {
            if (! is_array($fillables)) {
                $fillables = explode(',', $fillables);
            }

            foreach ($fillables as $column) {
                $columns .= "\r\n\t\t\t'{$column}' => ['required', 'string'],";
            }
        } else {
            $columns = "\r\n\t\t\t//";
        }

        $stub = str_replace(
            ['{{ modelName }}', '{{ columns }}'],
            [Str::of(class_basename($this->option('model')))->plural()->snake(), $columns],
            $stub
        );

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/request.stub');
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
            ['model', '', InputOption::VALUE_OPTIONAL, ''],
            ['columns', '', InputOption::VALUE_OPTIONAL, '']
        ];
    }
}
