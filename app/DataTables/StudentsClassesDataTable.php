<?php

namespace App\DataTables;

use App\Models\Classes;
use App\Models\StudentsClass;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentsClassesDataTable extends DataTable
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
                $viewBtn = "<a href='" . route('admin.student.index', ['classId' => $query->id, 'trackId' => $this->trackId])  . "'class='btn btn-sm btn-primary'><i class='fas fa-eye'></i>" . __('View') . "</a>";
                return $viewBtn;
            })
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->rawColumns([__('action')]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Classes $model): QueryBuilder
    {
        return $model->where('status', 'active')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('studentsclasses-table')
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
            Column::computed(__('action'))
                ->exportable(false)
                ->printable(false)
                ->width(400)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'StudentsClasses_' . date('YmdHis');
    }
}
