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

class AdminsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            
            ->addColumn('action',function ($data){ 
                // return $this->getActionColumn($data);
                return view('admin.admins.action')->with("data",$data);
            })
            ->addColumn('full_name',function ($user){
                return ($user->nom_fr . ' ' . $user->prenom_fr);
            })
            ->setRowClass(function ($data) {
                if ($data->is_active == '0' ) 
                return 'table-secondary' ;
               
           })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        
        $query = User::query()
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->select('users.*', User::raw('GROUP_CONCAT(roles.name) as roles'))
                ->where('is_admin', '1')
                ->whereNot('users.id', 1)
                ->groupBy('users.id', 'users.nom_fr');
                //->get();
        /* $query = User::query()->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('is_admin', '1')
        ->select('users.*', 'roles.name as role_name');*/


        return $this->applyScopes($query);

        //return $model->newQuery()->where('is_admin', 1);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admins-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                       // Button::make('csv'),
                      //  Button::make('pdf'),
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
          //  Column::make('familyName_fr'),
          //  Column::make('name_fr'),
            
            Column::make('email'),
            Column::make('roles')->searchable(false),
            
        ];
    }
   

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}
