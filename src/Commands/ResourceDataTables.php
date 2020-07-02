<?php

namespace Microboard\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Yajra\DataTables\Generators\DataTablesMakeCommand;
use Microboard\Foundations\Traits\MicroboardPathResolver;

class ResourceDataTables extends DataTablesMakeCommand
{
    use MicroboardPathResolver;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'microboard:datatable';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/datatable.stub');
    }

    /**
     * Parse array from definition.
     *
     * @param string $definition
     * @param int $indentation
     * @return string
     */
    protected function parseColumns($definition, $indentation = 12)
    {
        $columns = is_array($definition) ? $definition : explode(',', $definition);
        $stub    = '';
        $model = $this->option('model') ?
            Str::of(class_basename($this->option('model')))->slug()->plural() :
            '';

        foreach ($columns as $key => $column) {
            $stub .= "Column::make('{$column}')->title(trans('{$model}.fields.{$column}')),";

            if ($key < count($columns) - 1) {
                $stub .= PHP_EOL . str_repeat(' ', $indentation);
            }
        }

        return $stub;
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
            ['model', 'm', InputOption::VALUE_NONE, 'The name of the model to be used.'],
            ['model-namespace', '', InputOption::VALUE_NONE, 'The namespace of the model to be used.'],
            ['action', '', InputOption::VALUE_NONE, 'The path of the action view.'],
            ['table', 't', InputOption::VALUE_NONE, 'Scaffold columns from the table.'],
            ['builder', '', InputOption::VALUE_NONE, 'Extract html() to a Builder class.'],
            ['dom', '', InputOption::VALUE_NONE, 'The dom of the DataTable.'],
            ['buttons', '', InputOption::VALUE_NONE, 'The buttons of the DataTable.'],
            ['columns', '', InputOption::VALUE_NONE, 'The columns of the DataTable.'],
        ];
    }
}
