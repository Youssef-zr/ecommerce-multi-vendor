<?php

namespace App\DataTables\Vendor;

use App\Models\Backend\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemDataTable extends DataTable
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
                <div class="btn-group dropstart">
                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" id="menu-' . $query->id . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="menu-' . $query->id . '">
                    <li><a class="dropdown-item has-icon" href="' . route('vendor.dashboard.product-variant-item.edit', $query->id) . '"><i class="far fa-edit"></i> Edit</a></li>
                    <li><a class="dropdown-item has-icon delete-btn" href="' . route('vendor.dashboard.product-variant-item.destroy', $query->id) . '"><i class="fas fa-times"></i> Delete</a></li>
                    </ul>
                </div>
                ';

                return $actions;
            })
            ->editColumn('name', function ($query) {
                return str()->limit($query->name, 20, '...');
            })
            ->addColumn('variant_name', function ($query) {
                $variant = "<span class='badge bg-primary'>" . $query->variant->name . "</span>";
                return $variant;
            })
            ->editColumn('price', function ($query) {
                return $query->price . "$";
            })
            ->editColumn('status', function ($query) {
                $value = $query->status == 'active' ? 1 : 0;
                $isChecked = $value == 1 ? "checked" : "";

                $status = "
                <div class='form-check form-switch'>
                    <input class='form-check-input' type='checkbox' name='status' style='border-radius:10px !important;' data-id=' " . $query->id . "' class='custom-switch-input' " . $isChecked . ">
                </div>";

                return $status;
            })
            ->editColumn('is_default', function ($query) {
                $value = $query->is_default == 'yes' ? 1 : 0;
                $isChecked = $value == 1 ? "checked" : "";

                $is_default = "
                <div class='form-check form-switch'>
                    <input class='form-check-input' type='checkbox' name='is_default' style='border-radius:10px !important;' data-id=' " . $query->id . "' class='custom-switch-input' " . $isChecked . ">
                </div>";

                return $is_default;
            })
            ->rawColumns(["variant_name", 'name', 'price', 'status', 'is_default', "action"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('variant_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductvariantitem-table')
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
            Column::make('variant_name')->width(140),
            Column::make('name'),
            Column::make('price'),
            Column::make('is_default'),
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
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
