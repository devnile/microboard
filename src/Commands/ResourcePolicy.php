<?php

namespace Microboard\Commands;

use Illuminate\Foundation\Console\PolicyMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Microboard\Foundations\Traits\MicroboardPathResolver;

class ResourcePolicy extends PolicyMakeCommand
{
    use MicroboardPathResolver;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'microboard:policy';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->replaceUserNamespace(
            parent::buildClass($name)
        );

        $stub = $this->replaceAbilities($stub);

        $model = $this->option('model');

        return $model ? $this->replaceModel($stub, $model) : $stub;
    }

    /**
     *
     *
     * @param $stub
     * @return string
     */
    private function replaceAbilities($stub)
    {
        $code = [];
        $model = Str::of(class_basename($this->option('model')))->snake()->plural();
        $abilities = [
            'viewAny', 'view', 'create', 'update', 'delete'
        ];

        if ($this->option('abilities')) {
            $abilities = array_map(function ($ability) {
                return trim($ability);
            }, explode(',', $this->option('abilities')));
        }

        foreach ($abilities as $ability) {
            switch ($ability) {
                default:
                case 'viewAny':
                    $message = 'Determine whether the user can view any models.';
                    $docParams = "* @param  {{ user }}  " . '$user' . "\r\n\t";
                    $params = '{{ user }} $user';
                    break;
                case 'view':
                    $message = 'Determine whether the user can view the model.';
                    $docParams = "* @param  {{ user }}  " . '$user' . "\r\n\t* @param  {{ model }}  " . '${{ modelVariable }}' . "\r\n\t";
                    $params = '{{ user }} $user, {{ model }} ${{ modelVariable }}';
                    break;
                case 'create':
                    $message = 'Determine whether the user can create models.';
                    $docParams = "* @param  {{ user }}  " . '$user' . "\r\n\t";
                    $params = '{{ user }} $user';
                    break;
                case 'update':
                    $message = 'Determine whether the user can update the model.';
                    $docParams = "* @param  {{ user }}  " . '$user' . "\r\n\t* @param  {{ model }}  " . '${{ modelVariable }}' . "\r\n\t";
                    $params = '{{ user }} $user, {{ model }} ${{ modelVariable }}';
                    break;
                case 'delete':
                    $message = 'Determine whether the user can delete the model.';
                    $docParams = "* @param  {{ user }}  " . '$user' . "\r\n\t* @param  {{ model }}  " . '${{ modelVariable }}' . "\r\n\t";
                    $params = '{{ user }} $user, {{ model }} ${{ modelVariable }}';
                    break;
            }

            $code[] = "\r\n\t/**\r\n\t* {$message}\r\n\t" .
                "*\r\n\t{$docParams}* @return mixed\r\n\t*/\r\n\tpublic function {$ability}({$params})\r\n\t" .
                "{\r\n\t\treturn " . '$user->permissions' . "()->contains('name', '{$model}-{$ability}');\r\n\t}";
        }

        return str_replace('{{ abilities }}', implode("\r\n", $code), $stub);
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
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model that the policy applies to'],
            ['abilities', 'a', InputOption::VALUE_OPTIONAL, 'The abilities which the policy relies on'],
            ['guard', 'g', InputOption::VALUE_OPTIONAL, 'The guard that the policy relies on']
        ];
    }
}
