<?php

namespace App\DataTables;

use App\Models\Backend\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $btns = "<div class='btn-group'>";
                $editBtn = "<a href='" . route('admin.dashboard.brand.edit', $query->id) . "' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.dashboard.brand.destroy', $query->id) . "' class='btn btn-danger btn-sm delete-btn'><i class='fa fa-trash'></i></a>";
                $btns .= $editBtn . $deleteBtn;
                $btns .= "</div>";

                return $btns;
            })
            ->editColumn('image', function ($query) {
                $image = '<img src="' . asset($query->image) . '" style="width:50px;" class="img-thumbnail"/>';
                return $image;
            })
            ->editColumn('status', function ($query) {
                $value = $query->status == 'active' ? 1 : 0;
                $isChecked = $value == 1 ? "checked" : "";

                $status = "
            <label class='custom-switch mt-2'>
              <input type='checkbox' name='status' data-id='" . $query->id . "' class='custom-switch-input' " . $isChecked . ">
              <span class='custom-switch-indicator'></span>
            </label>";


                return $status;
            })
            ->editColumn('is_featured', function ($query) {
                $value = $query->is_featured == 'active' ? 1 : 0;
                $isChecked = $value == 1 ? "checked" : "";

                $is_featured = "
            <label class='custom-switch mt-2'>
              <input type='checkbox' name='is_featured' data-id='" . $query->id . "' class='custom-switch-input' " . $isChecked . ">
              <span class='custom-switch-indicator'></span>
            </label>";


                return $is_featured;
            })

            ->rawColumns(['name', 'status', "action", 'image',"is_featured"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('image'),
            Column::make('name'),
            Column::make('status'),
            Column::make('is_featured'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
