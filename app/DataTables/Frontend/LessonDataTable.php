<?php

namespace App\DataTables\Frontend;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LessonDataTable extends DataTable
{
    protected $counter = 0;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn(__('Lesson_name'), function ($query) {
                return  $query->name;
            })
            ->addColumn(__('Teacher_name'), function ($query) {
                return  $query->teacher->name;
            })
            ->addColumn(__('Date'), function ($query) {
                return  Carbon::parse($query->date_time)->format('Y-m-d  ( g:i A )');
            })
            ->addColumn(__('action'), function ($query) {
                $editBtn = "<a href='" . route('lesson.rate-lesson', [$query->id, $this->materialId])  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>" . __('Rate lesson') . "</a>";
                return @$editBtn;
            })
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->rawColumns([__('action')])
            ->setRowId(__('id'));
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lesson $model): QueryBuilder
    {
        return $model->with('teacher')
            ->where('material_id', $this->materialId)
            ->where('status', 'active')
            ->where('track_id', Auth::user()->track_id)
            ->orderBy('created_at', 'desc')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('lesson-table')
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
            Column::make(__('Lesson_name')),
            Column::make(__('Teacher_name')),
            Column::make(__('Date')),
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
        return 'Lesson_' . date('YmdHis');
    }
}
