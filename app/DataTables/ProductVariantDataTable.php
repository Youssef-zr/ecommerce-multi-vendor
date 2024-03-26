<?php

namespace App\DataTables;

use App\Models\Backend\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductVariantDataTable extends DataTable
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
                $actions = '
                <div class="dropdown d-inline mr-2">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Options
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="' . route('admin.dashboard.product-variant-item.index', ['productId'=>$query->product_id,'variantId'=>$query->id]) . '"><i class="fas fa-list"></i> Variant Items</a>
                        <a class="dropdown-item has-icon" href="' . route('admin.dashboard.product-variant.edit', $query->id) . '"><i class="far fa-edit"></i> Edit</a>
                        <a class="dropdown-item has-icon delete-btn" href="' . route('admin.dashboard.product-variant.destroy', $query->id) . '"><i class="fas fa-times"></i> Delete</a>
                    </div>
                </div>';

                return $actions;

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
            ->rawColumns(["action", 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('product_id',request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariant-table')
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
            Column::make('id')
                ->width(120),
            Column::make('name'),
            Column::make('status'),
            Column::computed('action')
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
        return 'ProductVariant_' . date('YmdHis');
    }
}
