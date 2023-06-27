<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pays;
use App\Models\User;
use App\Models\Grade;
use App\Models\Candidat;
use App\Models\Document;
use App\Models\View_candidats;

use App\Models\Objective;
use Illuminate\Http\Request;
use App\Rules\IsColumnsUnique;
use App\DataTables\UsersDataTable;
use App\DataTables\View_candidatsDataTable;
use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\DataTables\CandidatsDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        //return view('admin.dashboard');
        return redirect()->route('candidats');
    }
    public function candidats_detail(Request $request =null,View_candidatsDataTable $dataTable)
    {
        $dataTable->setServiceId(Auth::user()->relex_service_id);
        if ((Auth::user()->hasPermission('candidat@listAll'))) {
            if($request->input('relex_service_id')=='all')
                $dataTable->setServiceId(''); 
                else  $dataTable->setServiceId($request->input('relex_service_id')); 
                
        } 
        return $dataTable->render('admin.candidats.list',['title'=>'قائمة المترشحين ']);
    }
    
    public function users_list(UsersDataTable $dataTable)
    {        
        return $dataTable->with('is_admin','0')->render('admin.users.list');
    }
    public function candidats_deleted_list(View_candidatsDataTable $dataTable)
    {
        $dataTable->setIsdeleted('1');
        return  $dataTable->render('admin.candidats.list',['title'=>'قائمة المترشحين المحذوفين']);
    }
    public function candidats_list(CandidatsDataTable $dataTable)
    {
        return $dataTable->with('is_deleted', '0')->render('admin.candidats.list');
    }


   
    public function show_register(){
        return view('admin.admins.admin_register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom_ar' => ['required', 'string', 'max:255'],
            'nom_fr' => ['required', 'string', 'max:255'],
            'prenom_ar' => ['required', 'string', 'max:255'],
            'prenom_fr' => ['required', 'string', 'max:255'],
            'date_nais' => ['required', 'string', 'max:10',
                            new IsColumnsUnique('users', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']]),
                            new IsColumnsUnique('users', ['nom_fr' => $data['nom_fr'], 'prenom_fr' => $data['prenom_fr'], 'date_nais' => $data['date_nais']]),
                            ],
            
            'phone' => ['required', 'string', 'max:10'],
            'relex_service_id'=> ['required', 'numeric', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(Request $data)
    {
        $this->validator( $data->all());
        
        try {
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
                'is_admin'=>"1",
            ]);
        
            // User created successfully
            flash('An admin Successfully Added','success');
            //assign roles
            if ($user->addRole('manager')) {
                // Role assigned successfully
               
                flash('Role assigned to the user.','success');
            } else {
                // Failed to assign role
                flash('Failed to assign role.','error');
            }
        } catch (\Exception $e) {
            // Failed to create user
          //  echo "Failed to create an admin: " . $e->getMessage();
            flash("Failed to create an admin: " . $e->getMessage(),'error');
        }
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

    public function candidat_destroy(Request $request)
    {
        $com = Candidat::where('id',$request->id)->delete();
        return Response()->json($com);
    }
    public function candidat_disable(Candidat $candidat)
    {
      $com= $candidat->update([
        'is_deleted' => 1
    ]);
        if ($com)
        flash('The Candidat sussceefully disable','success');
        return back();
        // return Response()->json($com);
    }
    public function candidat_enable(Candidat $candidat)
    {
        $com= $candidat->update(['is_deleted' => 0 ]);
        if ($com)
        flash('The Candidat sussceefully enable','success');
        return back();
    }
    ////////////////////
    public function user_disable(User $user)
    {
        $com= $user->update([
        'is_active' => '0'
    ]);
        if ($com)
        flash('The user sussceefully disable','success');
        return back();
        // return Response()->json($com);
    }
    public function user_enable(User $user)
    {
        $com= $user->update(['is_active' => '1' ]);
        if ($com)
        flash('The user sussceefully active','success');
        return back();
    }
    ////////////////////
    public function candidat_details(Candidat $candidat)
    {
        if( $candidat)
        { 
            $hasdocs= Document::where(['candidat_id'=>$candidat->id,'is_deleted' => 0 ])->get();
            $grades= Grade::all();
            $pays= Pays::all();
            $objectives= Objective::all();
            return view('admin.candidats.edit')->with(['candidat'=>$candidat,'docs'=>$hasdocs,'grades'=>$grades,'pays'=>$pays,'objectives'=>$objectives]);
        }
    }

    public function candidatUpdateEtat(Request $request, $id)
    {
        $request->validate([
        'motif' => 'required',
        'etat' => 'required',
        ]);
        $ii=  $request->id_st;
        $candidat = Candidat::find($ii);
        $candidat->motif = $request->motif;
        $candidat->etat = $request->etat;
        $candidat->save();
        return   back()->with('success','تم تحديث المرشح بنجاح');
        /*return redirect()->route('admin.dashboard')
        ->with('success','Student Has Been updated successfully');*/
    }

    public function update_candidat(Candidat $candidat, Request $request){

        $data = $request->all();
        $validator =  Validator::make($data, [
            'pays_id' => ['required','numeric' ],
            'pays_nom' => ['required','string' ],
            'etablissement'=> ['required', 'string', 'max:255'],
            'objective_id' => ['required','numeric'],
            
        ]);

        if ($validator->fails()) {
            
            return back()->withInput();
        }

        $candidat->update(
            $request->all()
        );
        
        flash('candidat info Successfully Updated','success');
        return back();
       // return redirect()->route('candidat');
    }
    /*public function document_store(Request $request) 
    {
        $idcondidat=$request->candidat_id;
        $this->document_store_2( $request,$idcondidat); 
        (new CandidatController)->document_store_2( $request,$idcondidat);
        return back();
    }*/
    //-----------------------

    public function indexusers($status)
    {
        return view('admin.candidats.disabled')->with('status',$status);
    }
    public function indexusers2($status)
    {
        return view('admin.users.test')->with('status',$status);
    }

    
    //--------------------------
}
