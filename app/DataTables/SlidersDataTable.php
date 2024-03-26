<?php

namespace App\DataTables;

use App\Models\Backend\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Str;

class SlidersDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.dashboard.slider.edit', $query->id) . "' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.dashboard.slider.destroy', $query->id) . "' class='btn btn-danger btn-sm delete-btn'><i class='fa fa-trash'></i></a>";
                $btns .= $editBtn . $deleteBtn;
                $btns .= "</div>";

                return $btns;
            })
            ->editColumn('status', function ($query) {
                $class = $query->status == 'active'
                    ? 'bg-success'
                    : 'bg-danger';

                $status = "<span class='badge text-white " . $class . "'>" . $query->status . "</span>";

                return $status;
            })
            ->editColumn('banner', function ($query) {
                $image = "<img style='width:90px;' src='" . asset($query->banner) . "'>";
                return $image;
            })
            ->editColumn('title', function ($query) {
                return Str::limit($query->title, 40, '...');
            })
            ->rawColumns(['banner', 'title', 'status', "action"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('sliders-table')
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
            Column::make('banner'),
            Column::make('title'),
            Column::make('serial'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(140)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Sliders_' . date('YmdHis');
    }
}
