<?php

namespace App\DataTables;

use App\Models\View_candidats;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class View_candidatsDataTable extends DataTable
{
    private $ServiceId;
    private $Isdeleted = '0';

    public function setServiceId($user_service_Id)
    {
        $this->ServiceId = $user_service_Id;
    }
   
    public function setIsdeleted($Isdeleted)
    {
        $this->Isdeleted = $Isdeleted;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
           // ->addColumn('action', 'view_candidats.action')
            ->addColumn('action',function ($data){ 
                // return $this->getActionColumn($data);
                return view('admin.candidats.action')->with("data",$data);
             })
             ->addColumn('cantact',function ($data){
                return ($data->email . ' / ' . $data->phone);
            })
             ->setRowClass(function ($data) {
                 if ($data->etat == 'Accepté' ) 
                 return 'table-success' ;
                 if ($data->etat == 'Refusé' )  return  'table-danger';
                 if ($data->etat == 'Acceptée sous réserve' )  return  'table-warning';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(View_candidats $model): QueryBuilder
    {
       // return $model->newQuery();
       $query = $model->newQuery();
       $query->where('is_deleted', $this->Isdeleted );
        if ($this->ServiceId) {
            $query->where('relex_service_id', $this->ServiceId)
                ->where('is_deleted', $this->Isdeleted );
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('view_candidats-table')
                    ->columns($this->getColumns())
                    ->responsive(true)
                    ->pageLength(50)
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                       // Button::make('pdf'), //still doesn't work
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
            Column::make('nom_ar')->title('اللقب ')->searchable(true),
            Column::make('prenom_ar')->title('الاسم')->searchable(true),
            //Column::make('grade_id'),
            Column::make('grade_titre_ar')->title('الرتبة'),
           // Column::make('fonction')->title('المهنة'),
            Column::make('pays_nom')->title('البلد المستقبل'),
            Column::make('objective_titre_ar')->title('الهدف')->searchable(true)->exportable(true),
            Column::make('year_of_last_benefit')->title('سنة المنحة الأخيرة'),
            Column::make('cantact')->title('اتصال')->searchable(true),
            Column::make('etat')->title('الحالة'),
        ];
    }
  
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'View_candidats_' . date('YmdHis');
    }
}
