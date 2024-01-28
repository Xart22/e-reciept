<?php

namespace App\DataTables;

use App\Models\PenjualanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenjualanModelDataTable extends DataTable
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
                return '<div class="container">
                <button  class="btn btn-warning btn-update" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Update Status" data-id="' . $data->id . '"> <i class="bi bi-pencil-square"></i></button>
                <button  class="btn btn-dark btn-print " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Cetak Tanda Terima" data-id="' . $data->id . '"> <i class="bi bi-printer"></i></button>
                <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '"> <i class="bi bi-trash"></i></button>
            </div>';
            })
            ->editColumn('status_barang', function ($data) {
                if ($data->status_barang == 'Proses') {
                    return '<span class="badge bg-primary w-100 fs-6">' . $data->status_barang . '</span>';
                } else if ($data->status_barang == 'Selesai') {
                    return '<span class="badge bg-succes w-100 fs-6">' . $data->status_barang . '</span>';
                } else if ($data->status_barang == 'Barang di terima') {
                    return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_barang . '</span>';
                } else {
                    return '<span class="badge bg-danger w-100 fs-6">' . $data->status_barang . '</span>';
                }
            })->rawColumns(['action', 'status_barang']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PenjualanModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penjualanmodel-table')
            ->parameters([
                'autoWidth' => false
            ])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('tanggal'),
            Column::make('no_faktur'),
            Column::make('nama_pelanggan'),
            Column::make('nama_perusahaan'),
            Column::make('alamat_pelanggan'),
            Column::make('telepon_pelanggan'),
            Column::make('telepon_seluler'),
            Column::make('item'),
            Column::make('status_barang'),
            Column::make('status_pengambilan'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(150)
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PenjualanModel_' . date('YmdHis');
    }
}
