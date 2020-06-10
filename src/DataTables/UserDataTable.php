<?php

namespace Microboard\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function (User $user) {
                $html = '';

                if (true) {
                    $html .= '<a href="' . route('microboard.users.show', $user) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::users.view.action-button') . '">' .
                        '<i class="fas fa-eye"></i></a>';
                }

                if (true) {
                    $html .= '<a href="' . route('microboard.users.edit', $user) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans('microboard::users.edit.action-button') . '">' .
                        '<i class="fas fa-edit"></i></a>';
                }

                if (true) {
                    $html .= '<form action="' . route('microboard.users.destroy', $user) . '" method="post" class="d-inline-block">' .
                        csrf_field() . method_field('DELETE') .
                        '<button type="submit" data-toggle="tooltip" ' .
                        'class="bg-transparent border-0 p-0 table-action table-action-delete" ' .
                        'data-original-title="'. trans('microboard::users.delete.action-button') .'" ' .
                        'data-modal-title="'. trans('microboard::users.delete.title') .'" ' .
                        'data-modal-text="'. trans('microboard::users.delete.text') .'" ' .
                        'data-confirm="'. trans('microboard::users.delete.confirm') .'" ' .
                        'data-cancel="'. trans('microboard::users.delete.cancel') .'">' .
                        '<i class="fas fa-trash"></i></button></form>';
                }

                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->language(trans('microboard::datatable', []))
            ->addTableClass('table table-striped table-hover')
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
            Column::make('name')->title(trans('microboard::users.fields.name')),
            Column::make('email')->title(trans('microboard::users.fields.email')),
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
