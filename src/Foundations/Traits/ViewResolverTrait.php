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
        return array_merge([
            'widgets' => $this->getWidgetsFor($view)
        ], $this->buildVariables($model));
    }

    protected function buildVariables(?Model $model = null) {
        $routePrefix = 'microboard';
        $translationsPrefix = '';
        $viewsPrefix = '';
        $viewsPath = 'admin';

        if (property_exists($this, 'attributes')) {
            if (isset($this->attributes['routes_prefix'])) {
                $routePrefix = $this->attributes['routes_prefix'];
            }
            if (isset($this->attributes['translations_prefix'])) {
                $translationsPrefix = $this->attributes['translations_prefix'];
            }
            if (isset($this->attributes['views_prefix'])) {
                $viewsPrefix = $this->attributes['views_prefix'];
            }
            if (isset($this->attributes['views_path'])) {
                $viewsPath = $this->attributes['views_path'];
            }
        }

        return [
            'resource' => $this->model,
            'model' => $model,
            'resourceName' => $name = Str::of($this->baseName)->lower()->plural(),
            'resourceVariable' => Str::of($this->baseName)->lower(),
            'routePrefix' => $this->getRightPrefixFor($routePrefix, '.', $name),
            'translationsPrefix' => $this->getRightPrefixFor($translationsPrefix, '::', $name),
            'viewsPrefix' => $this->getRightPrefixFor(
                $viewsPrefix, '::',
                $this->getRightPrefixFor($viewsPath, '.', $name)
            ),
        ];
    }

    /**
     * Join given prefix and $resource with the delimiter.
     *
     * @param string $prefix
     * @param string $delimiter
     * @param string $resource
     * @return string
     */
    protected function getRightPrefixFor($prefix = '', $delimiter = '.', $resource = '') {
        return (
            $prefix ? $prefix . $delimiter : ''
        ) . $resource;
    }
}
