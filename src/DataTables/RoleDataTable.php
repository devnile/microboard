<?php

namespace Microboard\DataTables;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Microboard\Models\Role;

class RoleDataTable extends DataTable
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
            ->addColumn('action', function (Role $role) {
                $html = '';

                if (auth()->user()->can('view', $role)) {
                    $html .= '<a href="' . route('microboard.roles.show', $role) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::roles.view.action-button') . '">' .
                        '<i class="fas fa-eye"></i></a>';
                }

                if (auth()->user()->can('update', $role)) {
                    $html .= '<a href="' . route('microboard.roles.edit', $role) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::roles.edit.action-button') . '">' .
                        '<i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->can('delete', $role)) {
                    $html .= '<form action="' . route('microboard.roles.destroy', $role) . '" method="post" class="d-inline-block">' .
                        csrf_field() . method_field('DELETE') .
                        '<button type="submit" data-toggle="tooltip" ' .
                        'class="bg-transparent border-0 p-0 table-action table-action-delete" ' .
                        'data-original-title="'. trans('microboard::roles.delete.action-button') .'" ' .
                        'data-modal-title="'. trans('microboard::roles.delete.title') .'" ' .
                        'data-modal-text="'. trans('microboard::roles.delete.text') .'" ' .
                        'data-confirm="'. trans('microboard::roles.delete.confirm') .'" ' .
                        'data-cancel="'. trans('microboard::roles.delete.cancel') .'">' .
                        '<i class="fas fa-trash"></i></button></form>';
                }

                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $role)
    {
        return $role->newQuery();
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
            ->addTableClass('table table-striped table-hover align-items-center')
            ->columns($this->getColumns())
            ->setTableId('role-table')
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
			Column::make('id')->title(trans('microboard::roles.fields.id'))->width('1%'),
			Column::make('name')->title(trans('microboard::roles.fields.name')),
			Column::make('display_name')->title(trans('microboard::roles.fields.display_name')),
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
        return 'Role_' . date('YmdHis');
    }
}
