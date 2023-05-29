<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use App\DataTables\CandidatsDataTable;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsCompositeUnique_Invoke;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
      
    }
    public function users_list(UsersDataTable $dataTable)
    {
       
        
        return $dataTable->with('is_admin','0')->render('admin.users.list');
    }
    public function candidats_list(CandidatsDataTable $dataTable)
    {
        return $dataTable->render('admin.candidats.list');
    }
  
    public function show_register(){
        return view('admin.admins.admin_register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom_ar' => ['required', 'string', 'max:255', new IsCompositeUnique_Invoke('users', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']])],
            'nom_fr' => ['required', 'string', 'max:255'],
            'prenom_ar' => ['required', 'string', 'max:255'],
            'prenom_fr' => ['required', 'string', 'max:255'],
            'date_nais' => ['required', 'string', 'max:10'],
            
            'phone' => ['required', 'string', 'max:10'],
            'relex_service_id'=> ['required', 'numeric', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(Request $data)
    {
        $this->validator( $data->all());
        $user= User::create([
            'relex_service_id' => $data['relex_service_id'],
            'nom_ar' => $data['nom_ar'],
            'nom_fr' => $data['nom_fr'],
            'prenom_ar' => $data['prenom_ar'],
            'prenom_fr' => $data['prenom_fr'],
            'date_nais' => $data['date_nais'],
            'phone' => $data['phone'],

            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin'=>1,
        ]);
        $user->addRole('supervisor');
        flash('Admin Successfully Added','success');
        
        return back();
        
    }
  
    public function admins_list(AdminsDataTable $dataTable)
    {
        
        return $dataTable->render('admin.admins.list');
    }
    
  
    public function edit($id)
    {
        $user = User::find($id);
    }
}
