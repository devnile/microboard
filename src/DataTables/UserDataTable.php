<?php

namespace Microboard\DataTables;

use App\User;
use Microboard\Traits\DataTable as MicroboardDataTable;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    use MicroboardDataTable;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return $this->build($query)
            ->editColumn('role_id', function (User $user) {
                if (auth()->user()->can('view', $user->role)) {
                    $route = route('microboard.roles.show', $user->role);
                    return "<a href='{$route}'>{$user->role->display_name}</a>";
                }

                return $user->role->display_name;
            })
            ->editColumn('name', function (User $user) {
                return '<div class="media align-items-center">' .
                    '<span class="avatar avatar-sm rounded-circle mr-3">' .
                    '<img alt="' . $user->name . '" src="' . $user->avatar . '"></span>' .
                    '<div class="media-body">' .
                    '<span class="mb-0 d-block">' . $user->name . '</span>' .
                    '<small class="mb-0" style="font-size: 10px;"><i class="fa fa-clock"></i> ' .
                    '<time datetime="' . $user->updated_at . '">' .
                    trans('microboard::users.fields.updated_at') . ' ' .
                    $user->updated_at->diffForHumans() . '</time></small>' .
                    '</div></div>';
            })
            ->editColumn('created_at', function (User $user) {
                return "<time datetime='{$user->created_at}'>{$user->created_at->format('d/m/Y')}</time>";
            })
            ->rawColumns(['action', 'created_at', 'name', 'role_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with(['role']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(trans('microboard::users.fields.id'))->width('1%'),
            Column::make('name')->title(trans('microboard::users.fields.name'))->width('25%'),
            Column::make('role_id')->title(trans('microboard::users.fields.role_id')),
            Column::make('email')->title(trans('microboard::users.fields.email')),
            Column::make('created_at')->title(trans('microboard::users.fields.created_at')),
            Column::computed('action', '')
                ->exportable(false)
                ->printable(false)
                ->width('1%')
                ->addClass('text-right')
        ];
    }
}
