<?php

namespace App\DataTables;

use App\Models\Recruitment;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RecruitmentDataTable extends DataTable
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
            ->addColumn('action', function ($recruitment) {
                return '
                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('recruitment.edit', $recruitment).'" class="btn btn-icon">
                        <i class="fas fa-pen text-info"></i>
                    </a>
                    <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$recruitment->id.')" id="delete-'.$recruitment->id.'" delete-route="'.route('recruitment.destroy', $recruitment).'" class="btn btn-icon">
                        <i class="fas fa-trash text-danger"></i>
                    </button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Recruitment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recruitment $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('recruitment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy([1, 'ASC']);
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
            Column::make('title')->title('Judul'),
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
        return 'Recruitment_' . date('YmdHis');
    }
}
