<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.student.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>" . __('Edit') . "</a>";
                $deleteBtn = "<a href='" . route('admin.student.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>" . __('Delete') . "</a>";
                return $editBtn . $deleteBtn;
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
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->addColumn(__('Track'), function ($query) {
                return  $query->track->name;
            })
            ->addColumn(__('Calss'), function ($query) {
                return  $query->class->name;
            })
            ->addColumn(__('Calss room'), function ($query) {
                return  $query->classRoom->name;
            })
            ->rawColumns([__('action'), __('status')]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role', 'student')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('student-table')
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
            Column::make('phone'),
            Column::make(__('Track')),
            Column::make(__('Calss')),
            Column::make(__('Calss room')),
            Column::make(__('Status')),
            Column::computed(__('action'))
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Student_' . date('YmdHis');
    }
}
