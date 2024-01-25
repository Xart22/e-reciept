<?php

namespace App\DataTables;

use App\Models\TokoModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TokoModelDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->rawColumns(['logo', 'action'])->addColumn('logo', function ($data) {
            return '<img src="' . asset('storage/img/' . $data->logo_toko) . '" width="80px">';
        })->addColumn('action', function ($data) {
            return '<div class="container">
            <button  class="btn btn-warning btn-edit me-1" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Edit" data-id="' . $data->id . '" data-nama="' . $data->nama_toko . '" data-alamat="' . $data->alamat_toko . '" data-telpon="' . $data->telepon_toko . '" data-email="' . $data->email_toko . '"> <i class="bi bi-pencil-square"></i></button>
            <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '" data-nama="' . $data->nama_toko . '" data-url ="' . route('toko.destroy', $data->id) . '"> <i class="bi bi-trash"></i></button>
        </div>';
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TokoModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tokomodel-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('nama_toko')->title('Nama Toko'),
            Column::make('alamat_toko')->title('Alamat Toko'),
            Column::make('telepon_toko')->title('Telepon Toko'),
            Column::make('email_toko')->title('Email Toko'),
            Column::make('logo'),
            Column::make('action')
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
        return 'TokoModel_' . date('YmdHis');
    }
}
