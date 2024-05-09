<?php

namespace App\DataTables;

use App\Models\Backend\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
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
                $btns = "<a href='" . route('admin.dashboard.flash-sale.delete-product', $query->id) . "' class='btn btn-danger btn-sm delete-btn'><i class='fa fa-trash'></i></a>";

                return $btns;
            })
            ->addColumn('product_name', function ($query) {
                $productName = "<a href='" . route('admin.dashboard.product.edit', $query->product->id) . "'>" . $query->product->name . "</a>";
                return $productName;
            })
            ->editColumn('show_at_home', function ($query) {
                $value = $query->show_at_home == 'yes' ? 1 : 0;
                $isChecked = $value == 1 ? "checked" : "";

                $show_at_home = "
            <label class='custom-switch mt-2'>
              <input type='checkbox' name='show_at_home' data-id='" . $query->id . "' class='custom-switch-input' " . $isChecked . ">
              <span class='custom-switch-indicator'></span>
            </label>";

                return $show_at_home;
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

            ->rawColumns(['product_name', 'show_at_home', 'status', "action"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsaleitem-table')
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
            Column::make('product_name'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
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
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
