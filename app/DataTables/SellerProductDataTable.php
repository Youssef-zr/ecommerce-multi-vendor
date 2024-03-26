<?php

namespace App\DataTables;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerProductDataTable extends DataTable
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
            ->addColumn('vendor', function ($query) {
                $vendor = $query->vendor->shop_name;
                return '<span class="badge bg-info text-white">' . $vendor . '</span>';
            })
            ->addColumn('image', function ($query) {
                $image = '<img src="' . asset($query->thumb_image) . '" class="img-thumbnail" style="width:60px;height:60px"/>';
                return $image;
            })
            ->addColumn('type', function ($query) {
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
            ->addColumn('approve', function ($query) {

                $is_approved = "<select class='form-control p-1 is_approved' name='is_approved' data-id='{$query->id}'>
                    <option value='pending'" . ($query->is_approved == 'pending' ? 'selected' : '') . ">Pending</option>
                    <option value='approved'" . ($query->is_approved == 'approved' ? 'selected' : '') . ">Approved</option>
                </select>";

                return $is_approved;
            })

            ->rawColumns(['vendor', 'image', 'name', 'price', 'type', 'status', 'approve', "action"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        if (request()->hasAny('approved','type','vendor','status')) {

            $query = $model->newQuery();

            if (request()->has('approved') and request('approved') != null) {
                $query->where('is_approved', request()->get('approved'));
            }

            if (request()->has('type') and request('type') != null) {
                $query->where('product_type', request()->get('type'));
            }

            if (request()->has('vendor') and request('vendor') != null) {
                $query->where('vendor_id', request()->get('vendor'));
            }
            if (request()->has('status') and request('status') != null) {
                $query->where('status', request()->get('status'));
            }


            return $query;
        }

        return $model->where('vendor_id', "!=", auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('sellerproduct-table')
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
            Column::make('vendor'),
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('type'),
            Column::make('status'),
            Column::make('approve')->width(120),
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
        return 'SellerProduct_' . date('YmdHis');
    }
}
