<?php

namespace App\DataTables;

use App\Models\LogModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LogsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->editColumn('created_at', function ($data) {
            return $data->created_at->format('d-m-Y H:i:s');
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LogModel $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('logs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2)
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
            Column::make('user.username')->title('Nama User'),
            Column::make('aktivitas')->title('Aktivitas'),
            Column::make('created_at')->title('Waktu'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Logs_' . date('YmdHis');
    }
}
