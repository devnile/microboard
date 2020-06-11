<?php

namespace Microboard\Commands;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Facades\Microboard\Factory;
use Microboard\Models\Role;

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
                            {--view-namespace=}
                            {--abilities=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $abilities = [
        'viewAny', 'view', 'create', 'update', 'delete'
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->qualifyClass($this->getNameInput());
        $this->setVariables($model);

        // Create permissions for this resource.
        if ($this->hasOption('abilities')) {
            $this->abilities = explode(',', $this->option('abilities'));
        }

        Factory::createResourcesPermissionsFor(Role::first(), [
            $this->variables['%RESOURCE_NAME_PLURAL%'] => $this->abilities
        ]);

        try {
            $this->createPolicy();
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
            '%BLADE_VIEW_DIRECTORY%' => ($this->hasOption('views-directory') ? ($this->option() . '.') : '') .
                ((string)Str::of($base_name)->snake()->plural()),
        ];
    }

    /**
     * Create resource views
     *
     * @throws FileNotFoundException
     */
    private function createResourceViews()
    {
        $directory = 'resources/views/' . $this->variables['%VIEW_DIRECTORY%'];

        foreach (['index', 'show', 'edit', 'create'] as $view) {
            $this->createFromStub(
                __DIR__ . '/../../stubs/resource/' . $view . '.stub',
                $directory,
                $view . '.blade.php',
                array_merge($this->variables, ['%COLUMNS%' => $this->buildShowViewColumns()])
            );
        }

        $this->createFromStub(
            __DIR__ . '/../../stubs/resource/form.stub',
            $directory,
            'form.blade.php',
            array_merge($this->variables, ['%COLUMNS%' => $this->buildFormInputs()])
        );

        $this->info(sprintf(
            'Resource views created successfully, [%s]',
            $directory
        ));
    }

    /**
     * Create lang file for this model
     *
     * TODO:: Support multiple languages
     */
    private function createLanguageFiles()
    {
        $this->createFromStub(
            __DIR__ . '/../../stubs/resource.stub',
            $directory = 'resources/lang/' . (config('app.locale')),
            $file = $this->variables['%RESOURCE_NAME_PLURAL%'] . '.php',
            array_merge($this->variables, ['%COLUMNS%' => $this->buildLanguageFilesColumns()])
        );

        $this->info(sprintf(
            'Resource languages file created successfully, [%s/%s]',
            $directory, $file
        ));
    }

    /**
     * Create datatable class
     */
    private function createDatatable()
    {
        $this->createFromStub(
            __DIR__ . '/../../stubs/resource-datatable.stub',
            $directory = 'app/DataTables/',
            $file = Str::studly($this->variables['%RESOURCE_NAME_SINGULAR%'] . 'DataTable') . '.php',
            array_merge($this->variables, ['%COLUMNS%' => $this->buildDatatableColumns()])
        );

        $this->info(sprintf(
            'Datatable class created successfully, [%s%s]',
            $directory, $file
        ));
    }

    /**
     * Create controller class
     */
    private function createController()
    {
        $this->createFromStub(
            __DIR__ . '/../../stubs/resource-controller.stub',
            $directory = 'app/Http/Controllers/',
            $file = Str::studly($this->variables['%RESOURCE_NAME_SINGULAR%'] . 'Controller') . '.php',
            $this->variables
        );

        $this->info(sprintf(
            'Controller created successfully, [%s%s]',
            $directory, $file
        ));
    }

    /**
     * Create form request classes
     */
    private function createFormRequests()
    {
        $directory = 'app/Http/Requests/' . $this->variables['%RESOURCE_MODEL_BASE%'] . '/';

        foreach (['store', 'update'] as $method) {
            $this->createFromStub(
                __DIR__ . '/../../stubs/' . $method . '-resource-form-request.stub',
                $directory,
                Str::studly($method . 'FormRequest') . '.php',
                array_merge($this->variables, ['%COLUMNS%' => $this->buildFormRequestColumns()])
            );
        }

        $this->info(sprintf(
            'Form requests created successfully, [%s]',
            $directory
        ));
    }

    /**
     * Create policy class
     */
    private function createPolicy()
    {
        $this->createFromStub(
            __DIR__ . '/../../stubs/resource-policy.stub',
            $directory = 'app/Policies/',
            $file = Str::studly($this->variables['%RESOURCE_MODEL_BASE%'] . 'Policy') . '.php',
            $this->variables
        );

        $this->info(sprintf(
            'Form requests created successfully, [%s%s]',
            $directory, $file
        ));
    }

    /**
     * get fillable columns from given model
     *
     * @return array
     */
    private function getModelColumns()
    {
        return (new $this->variables['%RESOURCE_MODEL%'])->getFillable();
    }

    /**
     * build resource's columns as html from form-input.stub
     *
     * @return string
     *
     * @throws FileNotFoundException
     */
    private function buildFormInputs()
    {
        $columns = '';

        foreach ($this->getModelColumns() as $column) {
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

        return $columns;
    }

    /**
     * build resource's columns as html table's tr
     *
     * @return string
     */
    private function buildShowViewColumns()
    {
        $transPrefix = $this->variables['%VIEW_NAMESPACE%'] . $this->variables['%RESOURCE_NAME_PLURAL%'];
        $columns = '';

        foreach ($this->getModelColumns() as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $columns .= "\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<th style=\"width: 25%;\">@lang('{$transPrefix}.fields.{$column}')</th>" .
                "\n\t\t\t\t\t\t\t\t<td>{{ \${$this->variables['%RESOURCE_NAME_SINGULAR%']}->{$column} }}</td>".
                "\n\t\t\t\t\t\t\t</tr>";
        }

        return $columns;
    }

    /**
     * build resource's columns as key => [validations]
     * TODO:: Guess the input validations
     *
     * @return string
     */
    private function buildFormRequestColumns()
    {
        $columns = '';

        foreach ($this->getModelColumns() as $column) {
            $columns .= "\n\t\t\t'{$column}' => ['nullable'],";
        }

        return $columns;
    }

    /**
     * build resource's columns as DataTables's Column::make() api
     *
     * @return string
     */
    private function buildDatatableColumns()
    {
        $transPrefix = $this->variables['%VIEW_NAMESPACE%'] . $this->variables['%RESOURCE_NAME_PLURAL%'];
        $columns = "\n\t\t\tColumn::make('id')->title(trans('{$transPrefix}.fields.id'))->width('1%'),";

        foreach ($this->getModelColumns() as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $columns .= "\n\t\t\tColumn::make('{$column}')->title(trans('{$transPrefix}.fields.{$column}')),";
        }

        return $columns;
    }

    /**
     * build resource's columns as key => Value
     *
     * @return string
     */
    private function buildLanguageFilesColumns()
    {
        $columns = '';

        foreach ($this->getModelColumns() as $column) {
            if (in_array($column, (new $this->variables['%RESOURCE_MODEL%'])->getHidden())) {
                continue;
            }

            $title = Str::of($column)->title()->replace('_', ' ');
            $columns .= "\n\t\t'{$column}' => '{$title}',";
        }

        return $columns;
    }
}
