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
        $query = Candidat::query()

        ->join('objectives', 'candidats.objective_id', '=', 'objectives.id')
        ->join('grades', 'candidats.grade_id', '=', 'grades.id')
        ->select('candidats.*','grades.titre_ar','objectives.titre_ar as objective_ar')
        ->where('candidats.is_deleted', '0');
       
        return (new EloquentDataTable($query))
           // ->addColumn('action', 'admin.candidats.action')
            ->addColumn('action',function ($data){ 
               // return $this->getActionColumn($data);
               return view('admin.candidats.action')->with("data",$data);
            })
            ->addColumn('full_name',function ($candidat){
                return ($candidat->user->nom_ar . ' ' . $candidat->user->prenom_ar);
            })
            ->addColumn('nom',function ($candidat){
                return ($candidat->user->nom_ar);
            })
            ->addColumn('grade_ar',function ($candidat){
                return ($candidat->titre_ar);
            })
            ->addColumn('objective',function ($candidat){
                return ($candidat->objective_ar);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Candidat $model): QueryBuilder
    {
        return $model->newQuery();//->where('is_deleted', '0');
       // $query = Candidat::query()->where('is_deleted', '0');
        /*
        $query = Candidat::query()->select('candidats.*','grades.titre_ar as grade_ar', 'objectives.titre_ar as objective ','objectives.titre_fr as objective_fr')

        //->join('objectives', 'candidats.objective_id', '=', 'objectives.id')
        ->join('grades', 'candidats.grade_id', '=', 'grades.id')
        ->where('is_deleted', '0');
        */

        //return $this->applyScopes($query);
    }

    protected function getActionColumn($data): string
    {
        
        $detailstUrl = route('candidat_details', $data->id);
        if (  $data->is_deleted  == 1 ){
        $dt='<li>
        <form action="'.url("/candidat_enable/".$data->id).'" method="post">
          @csrf
          <button type="submit" class="dropdown-item"><i class="bi bi-eye m-1"></i>  ارجاع</button>
        </form> 
      </li>  ';
        } 
        else {
        $dt='<li>
        <form action="'.route('candidat_disable',['candidat'=>$data->id]).'" method="post" enctype="multipart/form-data">
          @csrf
          
           <li><button type="submit" onclick="confirmAction()" class="dropdown-item"><i class="bi bi-archive m-1"></i> حذف</button></li>
        </form>
      </li>  '; 
            }
        return "  <a class='btn btn-success' data-value='$data->id' target='_blank' href='$detailstUrl'>Details</a> 
                <button class='edit btn btn-info m-2'data-edit='$data' > <i class='fa fa-edit'></i></button>
                <br\>   <br\> $dt";
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
            Column::computed('action')->title('العمليات')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id')->hidden()->printable(false)->searchable(false)->exportable(false), 
            Column::make('full_name')->title('اللقب و الاسم')->searchable(true),
            Column::make('nom')->title('اللقب  ')->searchable(true),
            //Column::make('grade_id'),
            Column::make('grade_ar')->title('الرتبة'),
            Column::make('fonction')->title('المهنة'),
            Column::make('pays_nom')->title('البلد المستقبل'),
            Column::make('objective')->title('الهدف')->searchable(true)->exportable(true),
           // Column::make('objective_fr'),
          
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
