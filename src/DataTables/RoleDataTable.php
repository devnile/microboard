<?php

namespace Microboard\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Microboard\Models\Role;
use Microboard\Traits\DataTable as MicroboardDataTable;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    use MicroboardDataTable;

    /**
     * Build DataTable class.
     *
     * @param $query
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return $this->build($query)
            ->editColumn('users', function (Role $role) {
                return $role->users_count;
            })
            ->editColumn('permissions', function (Role $role) {
                return $role->permissions_count;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()->withCount(['users', 'permissions']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(trans('microboard::roles.fields.id'))->width('1%'),
            Column::make('display_name')->title(trans('microboard::roles.fields.display_name')),
            Column::make('users')->title(trans('microboard::roles.fields.users')),
            Column::make('permissions')->title(trans('microboard::roles.fields.permissionsCount')),
            Column::computed('action', '')
                ->exportable(false)
                ->printable(false)
                ->width('1%')
                ->addClass('text-right')
        ];
    }
}
