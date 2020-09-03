<?php

namespace Microboard\Foundations\Traits;

use Illuminate\Http\Request;

trait DependencyResolverTrait
{
    /**
     * @return string
     */
    protected function getModel(): string
    {
        return app()->getNamespace() . $this->baseName;
    }

    /**
     * @return string
     */
    protected function getDatatable(): string
    {
        return app()->getNamespace() . 'DataTables\\' . str_replace('Controller', 'DataTable', class_basename($this));
    }

    /**
     * @return string
     */
    protected function getStoreFormRequest(): string
    {
        return app()->getNamespace() . 'Http\\Requests\\' . $this->baseName . '\\StoreFormRequest';
    }

    /**
     * @return string
     */
    protected function getUpdateFormRequest(): string
    {
        return app()->getNamespace() . 'Http\\Requests\\' . $this->baseName . '\\UpdateFormRequest';
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getValidated(Request $request)
    {
        return array_filter($request->validated(), function ($input) {
            return !is_null($input);
        });
    }
}
