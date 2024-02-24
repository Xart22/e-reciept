<?php

namespace App\DataTables;

use App\Models\PenjualanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
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
                if (Auth::user()->role == 'Admin') {
                    if ($data->status_service == 'Cancel' || $data->status_service == 'Selesai') {
                        return '<div class="container">
                <button  class="btn btn-primary btn-detail" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Detail" data-id="' . $data->id . '"> <i class="bi bi-eye"></i></button>
                <button  class="btn btn-dark btn-print " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Cetak Tanda Terima" data-id="' . $data->id . '" data-url="' . route('tanda-terima.cetak', $data->id) . '"> <i class="bi bi-printer"></i></button>
                <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '" data-id-faktur="' . $data->no_faktur . '"> <i class="bi bi-trash"></i></button>
            </div>';
                    }
                    return '<div class="container">
                <button  class="btn btn-warning btn-update" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Update Status" data-id="' . $data->id . '"> <i class="bi bi-pencil-square"></i></button>
                <button  class="btn btn-dark btn-print " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Cetak Tanda Terima" data-id="' . $data->id . '" data-url="' . route('tanda-terima.cetak', $data->id) . '"> <i class="bi bi-printer"></i></button>
                <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '" data-id-faktur="' . $data->no_faktur . '"> <i class="bi bi-trash"></i></button>
            </div>';
                } else {
                    if ($data->status_service == 'Cancel' || $data->status_service == 'Selesai') {
                        return '<div class="container">
                <button  class="btn btn-primary btn-detail" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Detail" data-id="' . $data->id . '"> <i class="bi bi-eye"></i></button>
                <button  class="btn btn-dark btn-print " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Cetak Tanda Terima" data-id="' . $data->id . '" data-url="' . route('tanda-terima.cetak', $data->id) . '"> <i class="bi bi-printer"></i></button>
            </div>';
                    }
                    return '<div class="container">
                <button  class="btn btn-warning btn-update" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Update Status" data-id="' . $data->id . '"> <i class="bi bi-pencil-square"></i></button>
                <button  class="btn btn-dark btn-print " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Cetak Tanda Terima" data-id="' . $data->id . '" data-url="' . route('tanda-terima.cetak', $data->id) . '"> <i class="bi bi-printer"></i></button>
            </div>';
                }
            })
            ->addColumn('Durasi Service', function ($data) {
                $status = $data->status_service;
                if ($status == 'Proses') {
                    $date = date('Y-m-d');
                    $date1 = date_create($date);
                    $date2 = date_create($data->tanggal);
                    $diff = date_diff($date1, $date2);
                    return $diff->format("%a hari");
                } else if ($status == 'Selesai' || $status == 'Cancel') {
                    $date = date_create($data->service_selesai);
                    $date2 = date_create($data->tanggal);
                    $diff = date_diff($date, $date2);
                    if ($diff->format("%a") == 0) {
                        return '1 hari';
                    }
                    return $diff->format("%a hari");
                } else {
                    return '-';
                }
            })
            ->addColumn('Durasi Pengambilan', function ($data) {
                $status = $data->status_pengambilan;
                if ($status == 'Belum Diambil') {
                    $date = date('Y-m-d');
                    $date1 = date_create($date);
                    $date2 = date_create($data->service_selesai);
                    $diff = date_diff($date1, $date2);
                    return $diff->format("%a hari");
                } else if ($status == 'Sudah Diambil') {
                    $date = date_create($data->pengambilan_barang);
                    $date2 = date_create($data->service_selesai);
                    $diff = date_diff($date, $date2);
                    if ($diff->format("%a") == 0) {
                        return '1 hari';
                    }
                    return $diff->format("%a hari");
                } else {
                    return '-';
                }
            })
            ->addColumn('Sales', function ($data) {
                return $data->sales->username;
            })
            ->editColumn('status_service', function ($data) {
                if ($data->status_service == 'Proses') {
                    return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                } else if ($data->status_service == 'Selesai') {
                    return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                } else if ($data->status_service == 'Barang di terima') {
                    return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                } else {
                    return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                }
            })->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan']);
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
            ->orderBy(0)->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('no_faktur'),
            Column::make('tanggal'),
            Column::make('Durasi Service'),
            Column::make('nama_pelanggan'),
            Column::make('nama_perusahaan'),
            Column::make('alamat_pelanggan'),
            Column::make('telepon_pelanggan'),
            Column::make('telepon_seluler'),
            Column::make('item'),
            Column::make('status_service'),
            Column::make('status_pengambilan'),
            Column::make('Durasi Pengambilan'),
            Column::make('Sales'),
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
