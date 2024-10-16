<?php

namespace App\DataTables;

use App\Models\FooterSocial;
use App\Models\Social;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SocialDataTable extends DataTable
{
    protected $counter = 1;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn(__('action'), function ($query) {
                $editBtn = "<a href='" . route('admin.socials.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>" . __('Edit') . "</a>";
                $deleteBtn = "<a href='" . route('admin.socials.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>" . __('Delete') . "</a>";
                return $editBtn . $deleteBtn;
            })
            ->addColumn(__('icon'), function ($query) {
                return '<i style="font-size:25px" class="' . $query->icon . '"></i>';
            })
            ->addColumn(__('Name'), function ($query) {
                return $query->name;
            })
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->addColumn(__('Status'), function ($query) {
                if ($query->status == 'active') {
                    $button = '<label class="custom-switch mt-2">
                        <input checked type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="change-status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                } else {
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="change-status custom-switch-input ">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                }

                return $button;
            })
            ->rawColumns([__('icon'), __('action'), __('Status')])
            ->setRowId(__('id'));
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Social $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('footersocial-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make(__('id')),
            Column::make(__('Name')),
            Column::make(__('icon')),
            Column::make(__('Status')),
            Column::computed(__('action'))
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FooterSocial_' . date('YmdHis');
    }
}
