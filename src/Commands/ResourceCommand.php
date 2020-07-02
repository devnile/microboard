<?php

namespace Microboard\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Microboard\Factory;
use Microboard\Foundations\Traits\MicroboardPathResolver;
use Microboard\Models\Role;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ResourceCommand extends Command
{
    use MicroboardPathResolver;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'microboard:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin resource for given model';

    /**
     * @var Factory
     */
    protected $microboard;

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * ResourceCommand constructor.
     *
     * @param Factory $microboard
     * @param Filesystem $files
     */
    public function __construct(Factory $microboard, Filesystem $files)
    {
        parent::__construct();

        $this->microboard = $microboard;
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        $namespace = $this->option('namespace') ? $this->option('namespace') . '\\' : null;
        $modelName = $this->argument('model');
        $model = $this->getNamespacedModel($modelName);
        $options = $this->getAvailableOptions();
        $abilities = $this->getAvailableAbilities();

        // Create permissions and make a policy
        if (in_array('policy', $options)) {
            $this->microboard->createPermissionsFor(
                Role::where('name', config('microboard.resources.default_role', 'admin'))->firstOrFail(),
                $modelName,
                $abilities
            );

            // Make a policy
            $this->call('microboard:policy', [
                'name' => "{$modelName}Policy",
                '--model' => $model,
                '--abilities' => $this->option('abilities'),
                '--base_path' => $this->option('base_path'),
            ]);
        }

        // Make controller and datatable classes
        if (in_array('controller', $options)) {
            // Make a controller
            $this->call('microboard:controller', [
                'name' => "{$namespace}{$modelName}Controller",
                '--model' => $model,
                '--base_path' => $this->option('base_path'),
                '--namespaced' => true
            ]);

            // Make a datatable
            if (is_array($abilities) && in_array('viewAny', $abilities)) {
                $this->call('microboard:datatable', [
                    'name' => $modelName,
                    '--model' => trim($model, '/\\'),
                    '--columns' => $this->getModelFillableColumns($model),
                    '--base_path' => $this->option('base_path')
                ]);
            }

            // Make a store form request
            if (is_array($abilities) && in_array('create', $abilities)) {
                $this->call('microboard:request', [
                    'name' => "{$modelName}\\StoreFormRequest",
                    '--model' => $model,
                    '--columns' => $this->getModelFillableColumns($model),
                    '--base_path' => $this->option('base_path')
                ]);
            }

            // Make a update form request
            if (is_array($abilities) && in_array('update', $abilities)) {
                $this->call('microboard:request', [
                    'name' => "{$modelName}\\UpdateFormRequest",
                    '--model' => $model,
                    '--columns' => $this->getModelFillableColumns($model),
                    '--base_path' => $this->option('base_path')
                ]);
            }
        }

        // Make views and lang
        if (in_array('views', $options)) {
            $this->makeFormBladeFile()
                ->makeTableBladeFile();

            foreach (config('microboard.localizations', []) as $lang) {
                if (!isset($lang['code'])) {
                    throw new \InvalidArgumentException('Lang file must contains "code" index!');
                }

                $this->makeLangFileTo($lang['code']);
            }

            $this->updateRoutesAndNavLinks();
        }
    }

    /**
     * @param $modelName
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getNamespacedModel($modelName)
    {
        $model = ($this->option('model-namespace') ? ('/' . rtrim($this->option('model-namespace'), '/\\') . '/') : '') . $modelName;
        $model = str_replace('/', '\\', $model);
        if (Str::startsWith($model, '\\')) {
            $namespacedModel = $model;
        } else {
            $namespacedModel = $this->laravel->getNamespace() . $model;
        }

        return $namespacedModel;
    }

    /**
     * @return array
     */
    protected function getAvailableOptions()
    {
        return $this->option('only') ?
            explode(',', $this->option('only')) :
            ['controller', 'policy', 'views'];
    }

    /**
     * @return array
     */
    protected function getAvailableAbilities()
    {
        $abilities = ['viewAny', 'view', 'create', 'update', 'delete'];

        if ($this->option('abilities')) {
            $abilities = array_map(function ($ability) {
                return trim($ability);
            }, explode(',', $this->option('abilities')));
        }

        return $abilities;
    }

    /**
     *
     *
     * @param string $model
     * @param bool $filter
     * @return array
     */
    protected function getModelFillableColumns(string $model, $filter = false)
    {
        $model = resolve($model);

        return collect($model->getFillable())
            ->filter(function ($column) use ($model, $filter) {
                return $filter || !in_array($column, $model->getHidden());
            })
            ->all();
    }

    /**
     * Create table.blade.php file
     *
     * @return $this
     * @throws FileNotFoundException
     */
    protected function makeTableBladeFile()
    {
        $this->makeBladeFile('table');

        return $this;
    }

    /**
     * Create a new blade file with given name.
     *
     * @param $file
     * @return $this
     * @throws FileNotFoundException
     */
    protected function makeBladeFile($file)
    {
        $name = Str::of($this->argument('model'))->slug()->plural();
        $stub = $this->resolveStubPath("/stubs/views/{$file}.stub");
        $path = $this->getViewsPath($file, $name);

        $this->makeDirectory($path);

        $this->files->put($path, $this->replaceVariablesForm($file, $stub, $name));

        return $this;
    }

    /**
     * @param $view
     * @param $name
     * @return string
     */
    protected function getViewsPath($view, $name): string
    {
        $path = Str::lower("{$this->option('namespace')}/{$name}/{$view}.blade.php");

        return $this->option('base_path') ?
            $this->option('base_path') . '/resources/views/' . $path :
            $this->laravel->resourcePath("views/{$path}");
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Replace views variables.
     *
     * @param $file
     * @param string $stub
     * @param $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function replaceVariablesForm($file, string $stub, $name)
    {
        $stub = $this->files->get($stub);
        $replaces = [];

        if ($file === 'form') {
            $columns = $this->getModelFillableColumns(
                $this->getNamespacedModel($this->argument('model')),
                true
            );
            $html = '';

            foreach ($columns as $column) {
                $html .= str_replace([
                    '{{ column }}', '{{ model }}', '{{ variable }}'
                ], [
                    $column, $name, Str::singular($name)
                ], $this->files->get(
                    $this->resolveStubPath('/stubs/views/form-input.stub')
                ));
            }

            $replaces = [
                '{{ columns }}' => $html
            ];
        }

        if ($file === 'table') {
            $columns = $this->getModelFillableColumns(
                $this->getNamespacedModel($this->argument('model'))
            );
            $html = '';

            foreach ($columns as $column) {
                $html .= str_replace([
                    '{{ column }}', '{{ model }}', '{{ variable }}'
                ], [
                    $column, $name, Str::singular($name)
                ], $this->files->get(
                    $this->resolveStubPath('/stubs/views/table-column.stub')
                ));
            }

            $replaces = [
                '{{ columns }}' => $html
            ];
        }

        return str_replace(array_keys($replaces), array_values($replaces), $stub);
    }

    /**
     * Create form.blade.php
     *
     * @return $this
     * @throws FileNotFoundException
     */
    protected function makeFormBladeFile()
    {
        $this->makeBladeFile('form');

        return $this;
    }

    /**
     * It makes lang files to this model
     *
     * @param $code
     * @return $this
     * @throws FileNotFoundException
     */
    protected function makeLangFileTo($code)
    {
        $columns = '';
        $name = Str::of($this->argument('model'))->slug()->plural();
        $stub = $this->resolveStubPath("/stubs/lang/{$code}.stub");
        $modelName = $this->argument('model');
        $path = Str::lower("{$code}/{$name}.php");
        $path = $this->option('base_path') ?
            $this->option('base_path') . '/resources/lang/' . $path :
            $this->laravel->resourcePath("lang/{$path}");

        $this->makeDirectory($path);

        foreach ($this->getModelFillableColumns($this->getNamespacedModel($modelName), false) as $column) {
            $name = Str::title($column);
            $columns .= "\r\n\t\t'{$column}' => '{$name}',";
        }

        $this->files->put($path, str_replace([
            '{{ model }}', '{{ columns }}'
        ], [
            Str::title($name), $columns
        ], $this->files->get($stub)));

        return $this;
    }

    /**
     * @throws FileNotFoundException
     */
    protected function updateRoutesAndNavLinks()
    {
        $navPath = ($this->option('base_path') ?
                $this->option('base_path') . '/resources/views/' :
                $this->laravel->resourcePath('views/'))
            . 'vendor/microboard/layouts/partials/navbar-links.blade.php';
        $routePath = ($this->option('base_path') ?
                $this->option('base_path') . '/routes/' :
                $this->laravel->basePath('routes/'))
            . 'microboard.php';

        $navLink = $this->files->get(
            $this->resolveStubPath('/stubs/views/nav-link.stub')
        );

        if (
            !$this->files->exists($navPath) ||
            !$this->files->exists($routePath)
        ) {
            throw new \InvalidArgumentException('You must do microboard:install first!');
        }

        $this->files->append(
            $navPath,
            str_replace([
                '{{ model }}', '{{ route }}', '{{ trans }}'
            ], [
                $this->getNamespacedModel($name = $this->argument('model')),
                $trans = Str::of($name)->slug()->plural(),
                $trans
            ], $navLink)
        );

        $this->files->append(
            $routePath,
            "\r\nRoute::resource('$trans', '{$name}Controller');"
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'The model name']
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        // TODO:: add description
        return [
            ['namespace', '', InputOption::VALUE_OPTIONAL, '', config('microboard.routes.namespace.admin_directory', 'Admin')],
            ['model-namespace', '', InputOption::VALUE_REQUIRED, ''],
            ['base_path', 'p', InputOption::VALUE_OPTIONAL, ''],
            ['abilities', 'a', InputOption::VALUE_OPTIONAL, ''],
            ['only', 'o', InputOption::VALUE_OPTIONAL, ''],
        ];
    }
}
