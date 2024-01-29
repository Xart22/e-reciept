<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            <button  class="btn btn-warning btn-edit" data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Edit" data-id="' . $data->id . '" data-username="' . $data->username . '" data-role="' . $data->role . '"> <i class="bi bi-pencil-square"></i></button>
            <button  class="btn btn-danger btn-delete " data-coreui-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Delete" data-id="' . $data->id . '" data-username="' . $data->username . '" > <i class="bi bi-trash"></i></button>
        </div>';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
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
            Column::make('username')->title('Username'),
            Column::make('role')->title('Role'),
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
        return 'User_' . date('YmdHis');
    }
}
