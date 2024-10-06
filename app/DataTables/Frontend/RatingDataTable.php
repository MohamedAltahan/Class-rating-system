<?php

namespace App\DataTables\Frontend;

use App\Models\Material;
use App\Models\rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RatingDataTable extends DataTable
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
            ->addColumn(__('material_name'), function ($query) {
                return  $query->name;
            })
            ->addColumn(__('track_name'), function ($query) {
                return  $query->track->name;
            })
            ->addColumn(__('action'), function ($query) {
                $editBtn = "<a href='" . route('lesson.show', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>" . __('Rate lessons') . "</a>";
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
    public function query(Material $model): QueryBuilder
    {
        return $model->newQuery()->select('materials.*')
            ->join('material_student', 'materials.id', '=', 'material_student.material_id')
            ->where('material_student.student_id', Auth::user()->id);;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rating-table')
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
            Column::make(__('material_name')),
            Column::make(__('track_name')),
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
        return 'rating_' . date('YmdHis');
    }
}
