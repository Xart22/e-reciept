<?php

namespace App\DataTables;

use App\Models\StokBarangModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
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
            ->addColumn('action', function ($data) {
                if (Auth::user()->role == 'Admin') {
                    return '<div class="container">
                    <button  class="btn btn-warning btn-edit me-1" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Edit" data-id="' . $data->id . '" data-kode_barang="' . $data->kode_barang . '" data-kode_barang="' . $data->kode_barang . '" data-nama_barang="' . $data->nama_barang . '" data-satuan_barang="' . $data->satuan_barang . '" data-harga_barang="' . $data->harga_barang . '" data-stok_barang="' . $data->stok_barang . '"> <i class="bi bi-pencil-square"></i></button>
                    <a  class="btn btn-primary btn-detail me-1" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Detail" href="' . route('stok-barang.show', $data->kode_barang) . '"> <i class="bi bi-eye"></i></a>
                    <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '" data-kode_barang="' . $data->kode_barang . '" data-nama_barang="' . $data->nama_barang . '" > <i class="bi bi-trash"></i></button>
                </div>';
                } else if (Auth::user()->role == 'Kasir') {
                    return '<div class="container">
                    <button  class="btn btn-warning btn-edit me-1" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Edit" data-id="' . $data->id . '" data-kode_barang="' . $data->kode_barang . '" data-kode_barang="' . $data->kode_barang . '" data-nama_barang="' . $data->nama_barang . '" data-satuan_barang="' . $data->satuan_barang . '" data-harga_barang="' . $data->harga_barang . '" data-stok_barang="' . $data->stok_barang . '"> <i class="bi bi-pencil-square"></i></button>
                    <a  class="btn btn-primary btn-detail me-1" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Detail" href="' . route('stok-barang.show', $data->kode_barang) . '"> <i class="bi bi-eye"></i></a>
                </div>';
                }
            });
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
            ->buttons([
                Button::make('excel'),
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
            Column::make('satuan_barang'),
            Column::make('harga_barang'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(160)
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
