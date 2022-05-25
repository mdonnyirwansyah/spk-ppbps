<?php

namespace App\DataTables;

use App\Models\SubCriteria;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubCriteriaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('criteria', function ($data) {
                if ($data->criteria_id) {
                    return $data->criteria->name;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('sub-criteria.edit', $data).'" class="btn btn-icon">
                        <i class="fas fa-pen text-info"></i>
                    </a>
                    <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$data->id.')" id="delete-'.$data->id.'" delete-route="'.route('sub-criteria.destroy', $data).'" class="btn btn-icon">
                        <i class="fas fa-trash text-danger"></i>
                    </button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubCriteria $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubCriteria $model)
    {
        return $model->orderBy('criteria_id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('subcriteria-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy([4, 'ASC']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->searchable(false)->title('No')->width(50),
            Column::computed('criteria')->title('Kriteria'),
            Column::make('name')->title('Nama'),
            Column::make('rating'),
            Column::make('weight')->title('Bobot'),
            Column::computed('action')->title('Aksi')->width(75)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SubCriteria_' . date('YmdHis');
    }
}
