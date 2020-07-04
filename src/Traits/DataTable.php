<?php

namespace Microboard\Traits;

use Illuminate\Support\Str;
use Microboard\Foundations\Traits\ViewResolverTrait;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;

trait DataTable
{
    use ViewResolverTrait;

    /**
     * @var string
     */
    protected string $baseName;

    /**
     * DataTable constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->baseName = str_replace('DataTable', '', class_basename($this));
        $this->attributes = $attributes;
    }

    /**
     * Build DataTable class.
     *
     * @param $query
     * @return DataTableAbstract
     */
    public function build($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($model) {
                $html = '';

                if (auth()->user()->can('view', $model)) {
                    $html .= '<a href="' . route($this->route('show'), $model) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans($this->trans('view.action-button')) . '">' .
                        '<i class="fas fa-eye"></i></a>';
                }

                if (auth()->user()->can('update', $model)) {
                    $html .= '<a href="' . route($this->route('edit'), $model) . '" ' .
                        'class="table-action" data-toggle="tooltip" ' .
                        'data-original-title="' . trans($this->trans('edit.action-button')) . '">' .
                        '<i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->can('delete', $model)) {
                    $html .= '<form action="' . route($this->route('destroy'), $model) . '" method="post" class="d-inline-block">' .
                        csrf_field() . method_field('DELETE') .
                        '<button type="submit" data-toggle="tooltip" ' .
                        'class="bg-transparent border-0 p-0 table-action table-action-delete" ' .
                        'data-original-title="' . trans($this->trans('delete.action-button')) . '" ' .
                        'data-modal-title="' . trans($this->trans('delete.title')) . '" ' .
                        'data-modal-text="' . trans($this->trans('delete.text')) . '" ' .
                        'data-confirm="' . trans($this->trans('delete.confirm')) . '" ' .
                        'data-cancel="' . trans($this->trans('delete.cancel')) . '">' .
                        '<i class="fas fa-trash"></i></button></form>';
                }

                return $html;
            });
    }

    /**
     * @param $name
     * @return string
     */
    protected function route($name): string
    {
        return $this->getResourceVariables()['routePrefix'] . '.' . $name;
    }

    /**
     * @param $key
     * @return string
     */
    protected function trans($key): string
    {
        return $this->getResourceVariables()['translationsPrefix'] . '.' . $key;
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
            ->setTableId("{$this->baseName}-table")
            ->autoWidth(false)
            ->orderBy(0, 'asc')
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
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return "{$this->baseName}_" . date('YmdHis');
    }
}
