<?php

namespace Microboard\Foundations\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait QueryResolverTrait
{
    /**
     * @var Model|null
     */
    protected ?Model $model;

    /**
     * @param Request $request
     * @return mixed
     */
    protected function query(Request $request)
    {
        return $this->model->find(
            $request->route(
                Str::lower($this->baseName)
            )
        );
    }
}
