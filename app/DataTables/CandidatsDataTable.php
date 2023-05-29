<?php

namespace App\DataTables;

use App\Models\Candidat;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CandidatsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.candidats.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Candidat $model): QueryBuilder
    {
        return $model->newQuery();
        $query = Candidat::query();

        $query = Candidat::query()->join('objectives', 'objectives.id', '=', 'candidats.objective_id')
        ->join('grades', 'grades.id', '=', 'candidats.grade_id')
        ->where('is_deleted', '0')
        ->select('candidats.*','grades.titre_ar as grade_ar', 'objectives.titre_ar as objective ','objectives.titre_fr as objective_fr');


        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('Candidats-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id')->hidden()->printable(false)->searchable(false)->exportable(false), 
            Column::make('full_name'),
            Column::make('grade_id'),
            Column::make('grade_ar'),
            Column::make('fonction'),
            Column::make('pays_id'),
            Column::make('objective'),
            Column::make('objective_fr'),
          
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Candidats_' . date('YmdHis');
    }
}
