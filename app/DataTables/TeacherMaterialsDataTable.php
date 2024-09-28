<?php

namespace App\DataTables;

use App\Models\Material;
use App\Models\TeacherMaterial;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeacherMaterialsDataTable extends DataTable
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

            ->addColumn('name', function ($query) {
                return  $query->name;
            })
            ->addColumn('action', function ($query) {
                $deleteBtn = "<a href='" . route('admin.teacher.materials.destroy', ['materialId' => $query->id, 'teacherId' => $this->teacherId])  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>" . __('Delete') . "</a>";
                return  $deleteBtn;
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

            ->addColumn('id', function ($query) {
                return $this->counter++;
            })
            ->rawColumns(['action', 'status'])
        ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Material $model)
    {
        // dd($model->where('id', $this->teacherId)->newQuery()->with('materials'));
        return $model->newQuery()
            ->select('materials.*')
            ->join('material_teacher', 'materials.id', '=', 'material_teacher.material_id')
            ->where('material_teacher.teacher_id', $this->teacherId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('teachermaterials-table')
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
            Column::make('id'),
            Column::make('name'),
            Column::computed('action')
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
        return 'TeacherMaterials_' . date('YmdHis');
    }
}
