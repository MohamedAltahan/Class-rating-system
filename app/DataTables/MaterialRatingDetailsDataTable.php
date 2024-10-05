<?php

namespace App\DataTables;

use App\Models\Lesson;
use App\Models\Material;
use App\Models\MaterialRatingDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MaterialRatingDetailsDataTable extends DataTable
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
            ->addColumn(__('Lesson_name'), function ($query) {
                return $query->name;
            })
            ->addColumn(__('action'), function ($query) {
                $viewBtn = "<a href='" . route('admin.rating.lesson.details', $query->id) . "'class='btn btn-sm mx-1 my-1 btn-warning'><i class='far fa-edit'></i>" . __('View details') . "</a>";
                return $viewBtn;
            })
            ->addColumn(__('Ratings_count'), function ($query) {
                return $query->ratings_count ?? 0;
            })
            ->addColumn(__('Minimum_rating'), function ($query) {
                return $query->ratings_min_rating ?? 0;
            })
            ->addColumn(__('Average_rating'), function ($query) {
                return round($query->ratings_avg_rating, 1) ?? 0;
            })
            ->addColumn(__('Maximum_rating'), function ($query) {
                return $query->ratings_max_rating ?? 0;
            })
            ->addColumn(__('Count_comments'), function ($query) {
                return $query->comments_count ?? 0;
            })
            ->addColumn(__('id'), function ($query) {
                return $this->counter++;
            })
            ->rawColumns([__('action')]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lesson $model): QueryBuilder
    {
        return $model->withCount('ratings')
            ->withCount('comments')
            ->withAvg('ratings', 'rating')
            ->withMin('ratings', 'rating')
            ->withMax('ratings', 'rating')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('materialratingdetails-table')
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
            Column::make(__('Ratings_count')),
            Column::make(__('Minimum_rating')),
            Column::make(__('Average_rating')),
            Column::make(__('Maximum_rating')),
            Column::make(__('Count_comments')),
            Column::computed(__('action'))
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MaterialRatingDetails_' . date('YmdHis');
    }
}
