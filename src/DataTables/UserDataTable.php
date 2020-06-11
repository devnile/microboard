<?php

namespace Microboard\DataTables;

use App\User;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
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
                    '<time datetime="'. $user->updated_at .'">' .
                    trans('microboard::users.fields.updated_at') . ' ' .
                    $user->updated_at->diffForHumans() . '</time></small>' .
                    '</div></div>';
            })
            ->editColumn('created_at', function(User $user) {
                return "<time datetime='{$user->created_at}'>{$user->created_at->format('d/m/Y')}</time>";
            })
            ->addColumn('action', function (User $user) {
                $html = '';

                if (auth()->user()->can('view', $user)) {
                    $html .= '<a href="' . route('microboard.users.show', $user) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::users.view.action-button') . '">' .
                        '<i class="fas fa-eye"></i></a>';
                }

                if (auth()->user()->can('update', $user)) {
                    $html .= '<a href="' . route('microboard.users.edit', $user) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::users.edit.action-button') . '">' .
                        '<i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->can('delete', $user)) {
                    $html .= '<form action="' . route('microboard.users.destroy', $user) . '" method="post" class="d-inline-block">' .
                        csrf_field() . method_field('DELETE') .
                        '<button type="submit" data-toggle="tooltip" ' .
                        'class="bg-transparent border-0 p-0 table-action table-action-delete" ' .
                        'data-original-title="' . trans('microboard::users.delete.action-button') . '" ' .
                        'data-modal-title="' . trans('microboard::users.delete.title') . '" ' .
                        'data-modal-text="' . trans('microboard::users.delete.text') . '" ' .
                        'data-confirm="' . trans('microboard::users.delete.confirm') . '" ' .
                        'data-cancel="' . trans('microboard::users.delete.cancel') . '">' .
                        '<i class="fas fa-trash"></i></button></form>';
                }

                return $html;
            })
            ->escapeColumns(['*']);
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
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->language(trans('microboard::datatable', []))
            ->addTableClass('table table-striped table-hover table-sm align-items-center')
            ->columns($this->getColumns())
            ->setTableId('user-table')
            ->autoWidth(false)
            ->orderBy(0)
            ->minifiedAjax()
            ->dom("<'card'" .
                "<'card-header border-0'<'row align-items-center'<'col-12 col-sm-8 col-md-6'<'row no-gutters'<'col-4'l><'col-8'f>>><'col-12 col-sm-4 col-md-6 text-right'B>>>" .
                "<'table-responsive't>" .
                "<'card-footer'<'row'<'col-12 col-sm-6'i><'col-12 col-sm-6'p>>>" .
                "r>")
            ->buttons(
                Button::make('print')->text('<span>' . trans('microboard::datatable.print') . '</span><i class="fa fa-print"></i>'),
                Button::make('excel')->text('<span>' . trans('microboard::datatable.excel') . '</span><i class="fa fa-file-excel"></i>'),
                Button::make('reload')->text('<span>' . trans('microboard::datatable.reload') . '</span><i class="fa fa-sync"></i>')
            );
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
