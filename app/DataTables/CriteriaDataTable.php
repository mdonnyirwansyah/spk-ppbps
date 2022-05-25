<?php

namespace App\DataTables;

use App\Models\Criteria;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CriteriaDataTable extends DataTable
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
        ->addColumn('recruitment', function ($data) {
            if ($data->recruitment_id) {
                return $data->recruitment->title;
            } else {
                return '-';
            }
        })
        ->addColumn('weight', function ($data) {
            $percentage = $data->weight * 100;

            return $percentage.'%';
        })
        ->addColumn('action', function ($data) {
            return '
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('criteria.edit', $data).'" class="btn btn-icon">
                    <i class="fas fa-pen text-info"></i>
                </a>
                <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$data->id.')" id="delete-'.$data->id.'" delete-route="'.route('criteria.destroy', $data).'" class="btn btn-icon">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            ';
        })
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Criteria $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Criteria $model)
    {
        return $model->orderBy('recruitment_id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('criteria-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy([3, 'ASC']);
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
            Column::computed('recruitment')->title('Tema Rekrutmen'),
            Column::make('name')->title('Nama'),
            Column::computed('weight')->title('Bobot'),
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
        return 'Criteria_' . date('YmdHis');
    }
}
