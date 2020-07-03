<?php

namespace Microboard\Foundations\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait ViewResolverTrait
{
    /**
     * @param $file
     * @return string
     */
    protected function getViewPathFor($file)
    {
        $name = Str::lower($this->baseName);
        if (view()->exists($view = "{$name}.{$file}")) {
            return $view;
        }

        return "microboard::resource.{$file}";
    }

    /**
     * @param $view
     * @param Model|null $model
     * @return array
     */
    protected function getResourceVariables($view, ?Model $model = null): array
    {
        $routePrefix = 'microboard';
        $translationsPrefix = '';

        if (property_exists($this, 'attributes')) {
            if (isset($this->attributes['routes_prefix'])) {
                $routePrefix = $this->attributes['routes_prefix'];
            }
            if (isset($this->attributes['translations_prefix'])) {
                $translationsPrefix = $this->attributes['translations_prefix'];
            }
        }

        return [
            'resource' => $this->model,
            'resourceName' => Str::of($this->baseName)->lower()->plural(),
            'resourceVariable' => Str::of($this->baseName)->lower(),
            'routePrefix' => $routePrefix ? $routePrefix . '.' : '',
            'translationsPrefix' => $translationsPrefix ? $translationsPrefix . '::' : '',
            'model' => $model,
            'widgets' => $this->getWidgetsFor($view)
        ];
    }
}
