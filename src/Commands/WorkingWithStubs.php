<?php

namespace Microboard\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

abstract class WorkingWithStubs extends Command
{
    /** @var Filesystem */
    protected $files;

    /**
     * Set all Stubs replaces
     *
     * @var array
     */
    protected $variables = [];

    /**
     * @param Filesystem $file
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();

        $this->files = $file;
    }

    /**
     * Get stub content and replace variables, then put it into directory
     *
     * @param string $stub
     * @param string $directory output directory
     * @param string $name file name
     * @param array $variables
     */
    public function createFromStub($stub, $directory, $name, $variables = [])
    {
        try {
            $stub = str_replace(
                array_keys($variables),
                array_values($variables),
                $this->files->get($stub)
            );

            $directory = $this->makeDirectory($directory);

            $this->files->put("{$directory}/{$name}", $stub);
        } catch (FileNotFoundException $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    abstract protected function getNameInput();
}
