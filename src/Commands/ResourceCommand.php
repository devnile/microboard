<?php

namespace Microboard\Commands;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ResourceCommand extends WorkingWithStubs
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'microboard:resource
                            {model : The name of resource class}
                            {--views-directory=admin}
                            {--view-namespace=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->qualifyClass($this->getNameInput());
        $this->setVariables($model);

        // create permissions for this model
        // create policy file
        // create datatable file
        try {
            $this->createLanguageFiles();
            $this->createDatatable();
            $this->createController();
            $this->createFormRequests();
            $this->createResourceViews();
        } catch (FileNotFoundException $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('model'));
    }

    /**
     * Set model variables
     *
     * @var string $model
     */
    public function setVariables($model)
    {
        $base_name = class_basename($model);

        $this->variables = [
            '%NAMESPACE%' => $this->rootNamespace(),
            '%RESOURCE_MODEL%' => $model,
            '%RESOURCE_MODEL_BASE%' => class_basename($model),
            '%RESOURCE_NAME_PLURAL%' => (string)Str::of($base_name)->snake()->plural(),
            '%RESOURCE_NAME_SINGULAR%' => (string)Str::of($base_name)->snake()->singular(),
            '%VIEW_NAMESPACE%' => $this->option('view-namespace'),
            '%VIEW_DIRECTORY%' => $this->option('views-directory') . '/' . ((string)Str::of($base_name)->snake()->plural()) . '/',
            '%BLADE_VIEW_DIRECTORY%' => $this->option('views-directory') . '.' . ((string)Str::of($base_name)->snake()->plural()),
            '%COLUMNS%' => (new $model)->getFillable()
        ];
    }

    /**
     * Create resource views
     *
     * @throws FileNotFoundException
     */
    private function createResourceViews()
    {
        $transPrefix = $this->variables['%VIEW_NAMESPACE%'] . $this->variables['%RESOURCE_NAME_PLURAL%'];
        $columns = '';

        foreach ($this->variables['%COLUMNS%'] as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $columns .= "\n\t\t\t\t\t<tr><th width=\"25%\">@lang('{$transPrefix}.fields.{$column}')</th>" .
                "<td>{{ \${$this->variables['%RESOURCE_NAME_SINGULAR%']}->{$column} }}</td></tr>";
        }

        foreach (['index', 'show', 'edit', 'create'] as $view) {
            $this->createFromStub(
                __DIR__ . '/../../stubs/resource/' . $view . '.stub',
                'resources/views/' . $this->variables['%VIEW_DIRECTORY%'],
                $view . '.blade.php',
                array_merge($this->variables, ['%COLUMNS%' => $columns])
            );
        }

        $this->createFromStub(
            __DIR__ . '/../../stubs/resource/form.stub',
            'resources/views/' . $this->variables['%VIEW_DIRECTORY%'],
            'form.blade.php',
            array_merge($this->variables, $this->buildFormInputs())
        );
    }

    /**
     * @return string[]
     * @throws FileNotFoundException
     */
    private function buildFormInputs()
    {
        $columns = '';

        foreach ($this->variables['%COLUMNS%'] as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $this->variables['%COLUMN_NAME%'] = $column;

            $variables = Arr::only($this->variables, [
                '%RESOURCE_NAME_SINGULAR%', '%VIEW_NAMESPACE%', '%RESOURCE_NAME_PLURAL%', '%COLUMN_NAME%'
            ]);

            $columns .= str_replace(
                array_keys($variables),
                array_values($variables),
                $this->files->get(__DIR__ . '/../../stubs/resource/form-input.stub')
            );
        }

        return [
            '%COLUMNS%' => $columns
        ];
    }

    /**
     * Create lang file for this model
     */
    private function createLanguageFiles()
    {
        $columns = "\n\t\t'id' => '#',";

        foreach ($this->variables['%COLUMNS%'] as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $columns .= "\n\t\t'{$column}' => '{$column}',";
        }

        $this->createFromStub(
            __DIR__ . '/../../stubs/resource.stub',
            'resources/lang/ar/',
            $this->variables['%RESOURCE_NAME_PLURAL%'] . '.php',
            array_merge($this->variables, ['%COLUMNS%' => $columns])
        );
    }

    /**
     * Create datatable class
     */
    private function createDatatable()
    {
        $transPrefix = $this->variables['%VIEW_NAMESPACE%'] . $this->variables['%RESOURCE_NAME_PLURAL%'];
        $columns = "\n\t\t\tColumn::make('id')->title(trans('{$transPrefix}.fields.id'))->width('1%'),";

        foreach ($this->variables['%COLUMNS%'] as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $columns .= "\n\t\t\tColumn::make('{$column}')->title(trans('{$transPrefix}.fields.{$column}')),";
        }

        $this->createFromStub(
            __DIR__ . '/../../stubs/resource-datatable.stub',
            'app/DataTables/',
            Str::studly($this->variables['%RESOURCE_NAME_SINGULAR%'] . 'DataTable') . '.php',
            array_merge($this->variables, ['%COLUMNS%' => $columns])
        );
    }

    /**
     * Create datatable class
     */
    private function createController()
    {
        $this->createFromStub(
            __DIR__ . '/../../stubs/resource-controller.stub',
            'app/Http/Controllers/',
            Str::studly($this->variables['%RESOURCE_NAME_SINGULAR%'] . 'Controller') . '.php',
            Arr::only($this->variables, [
                '%RESOURCE_MODEL%', '%RESOURCE_NAME_PLURAL%', '%RESOURCE_NAME_SINGULAR%',
                '%RESOURCE_MODEL_BASE%', '%NAMESPACE%', '%VIEW_NAMESPACE%', '%BLADE_VIEW_DIRECTORY%'
            ])
        );
    }

    /**
     * Create datatable class
     */
    private function createFormRequests()
    {
        $columns = '';

        foreach ($this->variables['%COLUMNS%'] as $column) {
            $columns .= "\n\t\t\t'{$column}' => ['nullable'],";
        }

        foreach (['store', 'update'] as $method) {
            $this->createFromStub(
                __DIR__ . '/../../stubs/' . $method . '-resource-form-request.stub',
                'app/Http/Requests/' . $this->variables['%RESOURCE_MODEL_BASE%'] . '/',
                Str::studly($method . 'FormRequest') . '.php',
                array_merge($this->variables, ['%COLUMNS%' => $columns])
            );
        }
    }
}
