<?php

namespace Microboard\Http\Controllers;

use App\User;
use Microboard\DataTables\UserDataTable;
use Microboard\Http\Requests\User\StoreFormRequest;
use Microboard\Http\Requests\User\UpdateFormRequest;

class UserController extends ResourceController
{
    protected array $indexWidgets = [
        '\Microboard\Widgets\UsersInThisMonth' => [
            'size' => 'col-md-6'
        ],
        '\Microboard\Widgets\PopularRole' => [
            'size' => 'col-md-6'
        ]
    ];

    /**
     * @param UpdateFormRequest $request
     * @param User $model
     * @return mixed|void
     */
    protected function created($request, $model)
    {
        addMediaTo($model, 'avatar');
    }

    /**
     * @param UpdateFormRequest $request
     * @param User $model
     * @return mixed|void
     */
    protected function updated($request, $model)
    {
        addMediaTo($model, 'avatar');
    }

    /**
     * @return string
     */
    protected function getStoreFormRequest(): string
    {
        return StoreFormRequest::class;
    }

    /**
     * @return string
     */
    protected function getUpdateFormRequest(): string
    {
        return UpdateFormRequest::class;
    }

    /**
     * @return string
     */
    protected function getDatatable(): string
    {
        return UserDataTable::class;
    }
}
