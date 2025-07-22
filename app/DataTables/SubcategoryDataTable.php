<?php

namespace App\DataTables;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('category.name', function ($subcategory) {
                return $subcategory->category?->name ?? '-';
            })
            ->addColumn('action', function ($row) {
                return '
                <div class="d-flex gap-1">
                <button type="button" class="btn btn-danger btn-sm delete-btn" 
                 data-id="' . $row->id . '" 
                 data-name="' . e($row->name) . '">
                     Delete
                 </button>

                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"   data-id="' . $row->id . '" >
                Edit
                </button>
              </div>
                ';
            })->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subcategory $model): QueryBuilder
    {
        return $model->newQuery()->with('category');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive(true)
            ->buttons([
                Button::make('excel')->className('btn btn-success me-1'),
                Button::make('csv')->className('btn btn-info me-1'),
                Button::make('pdf')->className('btn btn-danger me-1'),
                Button::make('print')->className('btn btn-warning me-1'),
            ])->parameters([
                'initComplete' => 'function () {
        $(".dt-buttons").addClass("d-flex mb-3");
    }'
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
            Column::make('slug'),
            Column::make('description'),
            Column::make('category.name')->title('Category Name'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')->responsivePriority(10),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subcategory_' . date('YmdHis');
    }
}
