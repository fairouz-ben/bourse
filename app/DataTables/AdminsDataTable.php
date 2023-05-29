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
            ->addColumn('action', 'admins.action')
            ->addColumn('full_name',function ($user){
                return ($user->nom_fr . ' ' . $user->prenom_fr);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
       // $query = User::query();

        // Change the select query to retrieve specific columns
        //$query->select('id', 'familyName_fr', 'name_fr','email');

        // Add a condition to retrieve only active users
       // $query->where('is_admin', '1');
        ///////
        $query = User::query()->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('is_admin', '1')
        ->select('users.*', 'roles.name as role_name');


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
          //  Column::make('familyName_fr'),
          //  Column::make('name_fr'),
            
            Column::make('email'),
            Column::make('role_name')->searchable(false),
            
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
