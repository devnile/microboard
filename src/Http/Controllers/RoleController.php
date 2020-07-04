<?php

namespace Microboard\Http\Controllers;

use Microboard\DataTables\RoleDataTable;
use Microboard\Http\Requests\Role\StoreFormRequest;
use Microboard\Http\Requests\Role\UpdateFormRequest;
use Microboard\Models\Role;

class RoleController extends ResourceController
{
    /**
     * Register index widgets.
     *
     * @var array
     */
    protected array $indexWidgets = [
        '\Microboard\Widgets\PopularRole' => [
            'size' => 'col-md-4'
        ],
        '\Microboard\Widgets\PermissionsCount' => [
            'size' => 'col-md-4'
        ],
        '\Microboard\Widgets\DefaultRole' => [
            'size' => 'col-md-4'
        ],
    ];

    /**
     * Role has been created.
     *
     * @param StoreFormRequest $request
     * @param Role $model
     */
    protected function created($request, $model)
    {
        $model->permissions()->attach($request->get('permissions'));
    }

    /**
     * Role has been updated.
     *
     * @param UpdateFormRequest $request
     * @param Role $model
     */
    protected function updated($request, $model)
    {
        $model->permissions()->sync($request->get('permissions'));
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return Role::class;
    }

    /**
     * @return string
     */
    protected function getDatatable(): string
    {
        return RoleDataTable::class;
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
}
