<?php

namespace Microboard\Foundations\Traits;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait MicroboardPathResolver
{
    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->resourcePath(trim('views/vendors/microboard' . $stub, '/')))
            ? $customPath
            : __DIR__ . '/../../..' . $stub;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return ($this->option('base_path') ?
                rtrim($this->option('base_path'), '\\/') . '/app' :
                $this->laravel['path']) .
            '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Add base_path to command options.
     *
     * @return array
     */
    protected function pathOptions()
    {
        return [
            ['base_path', '', InputOption::VALUE_OPTIONAL, 'Change base path'],
        ];
    }
}
