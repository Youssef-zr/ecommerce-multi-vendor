<?php

namespace App\DataTables;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                        <a class="dropdown-item has-icon" href="' . route('admin.dashboard.image-gallery.index', ['product' => $query->id]) . '"><i class="far fa-images"></i> Image Gallery</a>
                        <a class="dropdown-item has-icon" href="' . route('admin.dashboard.product-variant.index', ['product' => $query->id]) . '"><i class="fas fa-list"></i> Variants</a>
                        <a class="dropdown-item has-icon" href="' . route('admin.dashboard.product.edit', $query->id) . '"><i class="far fa-edit"></i> Edit</a>
                        <a class="dropdown-item has-icon delete-btn" href="' . route('admin.dashboard.product.destroy', $query->id) . '"><i class="fas fa-times"></i> Delete</a>
                    </div>
                </div>';

                return $actions;
            })
            ->addColumn('image', function ($query) {
                $image = '<img src="' . asset($query->thumb_image) . '" class="img-thumbnail" style="width:60px;height:60px"/>';
                return $image;
            })
            ->editColumn('product_type', function ($query) {
                $status = str_replace('_', ' ', $query->product_type);
                $statusClass = 'text-white ';

                switch ($status) {
                    case 'new arrival':
                        $statusClass .= 'bg-primary';
                        break;
                    case 'feature':
                        $statusClass .= 'bg-info';
                        break;
                    case 'top':
                        $statusClass .= 'bg-danger';
                        break;
                    case 'best':
                        $statusClass .= 'bg-success';
                        break;
                    case 'flash deal':
                        $statusClass .= 'bg-warning';
                        break;
                    case 'undefined':
                        $statusClass .= 'bg-secondary';
                        break;
                }

                return "<span class='badge " . $statusClass . "'>" . str()->title($status) . "</span>";
            })
            ->editColumn('price', function ($query) {
                return $query->getPrice() . "$";
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
            ->rawColumns(['image', 'name', 'price', 'product_type', 'status', "action"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('price'),
            Column::make('product_type'),
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
        return 'Product_' . date('YmdHis');
    }
}
