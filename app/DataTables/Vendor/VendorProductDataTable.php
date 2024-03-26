<?php

namespace App\DataTables\Vendor;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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
                        <li><a class="dropdown-item has-icon" href="' . route('vendor.dashboard.product-image-gallery.index', ['product' => $query->id]) . '"><i class="far fa-images"></i> Image Gallery</a></li>
                        <li><a class="dropdown-item has-icon" href="' . route('vendor.dashboard.product-variant.index', ['product' => $query->id]) . '"><i class="fas fa-list"></i> Variants</a></li>
                        <li><a class="dropdown-item has-icon" href="' . route('vendor.dashboard.product.edit', $query->id) . '"><i class="far fa-edit"></i> Edit</a></li>
                        <li><a class="dropdown-item has-icon delete-btn" href="' . route('vendor.dashboard.product.destroy', $query->id) . '"><i class="fas fa-times"></i> Delete</a></li>
                    </ul>
                </div>
                ';

                return $actions;
            })
            ->addColumn('image', function ($query) {
                $image = '<img src="' . asset($query->thumb_image) . '" class="img-thumbnail" style="width:60px;height:60px"/>';
                return $image;
            })
            ->editColumn('type', function ($query) {
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
                return $query->price . "$";
            })
            ->editColumn('is_approved', function ($query) {
                $is_approved = $query->is_approved;
                $badge = '';
                switch ($is_approved) {
                    case 'pending':
                        $badge = 'bg-warning text-dark';
                        break;
                    case 'publich':
                        $badge = 'bg-success';
                        break;
                    case 'removed':
                        $badge = 'bg-dander';
                        break;

                    default:
                        $badge = 'bg-secondary';
                        break;
                }

                $output = "<span class='badge {$badge}'>{$is_approved}</span>";

                return $output;
            })
            ->rawColumns(['image', 'name', 'price', 'type', 'is_approved', "action"])
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
            ->setTableId('vendorproduct-table')
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
            Column::make('type'),
            Column::make('is_approved'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
