<?php

namespace App\DataTables;

use App\Models\Material;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MaterialDataTable extends DataTable
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

                $addLessonBtn = "<a href='" . route('admin.lesson.create', ['materialId' => $query->id, 'trackId' => $query->track->id])  . "'class='btn btn-sm mx-1 my-1 btn-warning'><i class='fas fa-plus'></i>" . __('Add lesson') . "</a>";
                $editBtn = "<a href='" . route('admin.material.edit', $query->id)  . "'class='btn btn-sm ml-1 btn-primary'><i class='far fa-edit'></i>" . __('Edit') . "</a>";
                $deleteBtn = "<a href='" . route('admin.material.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>" . __('Delete') . "</a>";
                $viewLessons = "<a href='" . route('admin.lesson.show', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-info'><i class='fas fa-eye'></i>" . __('View lessons') . "</a>";

                return @$addLessonBtn . @$viewLessons . @$editBtn . @$deleteBtn;
            })

            ->addColumn(__('status'), function ($query) {
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
            ->addColumn(__('Track name'), function ($query) {

                return $query->track->name;
            })
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->rawColumns([__('action'), __('status')]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Material $model): QueryBuilder
    {

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('material-table')
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
            Column::make('name'),
            Column::make(__('Track name')),
            Column::make(__('status'))->width(60),
            Column::computed(__('action'))
                ->exportable(false)
                ->printable(false)
                ->width(360)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Material_' . date('YmdHis');
    }
}
