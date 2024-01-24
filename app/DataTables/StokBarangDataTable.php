<?php

namespace App\DataTables;

use App\Models\StokBarangModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StokBarangDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('action', '<div class="container">
            <a href="' . route('stok-barang.edit', '1') . '" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Edit"> <i class="bi bi-pencil-square"></i></a>
            <a href="' . route('stok-barang.edit', '1') . '" class="btn btn-danger" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete"> <i class="bi bi-trash"></i></a>
        </div>')->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(StokBarangModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stokbarang-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('print'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('kode_barang'),
            Column::make('nama_barang'),
            Column::make('stok_barang'),
            Column::make('harga_barang'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(120)
                ->title('Aksi'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'StokBarang_' . date('YmdHis');
    }
}
