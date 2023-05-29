<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\User;
use App\Models\Grade;
use App\Models\Candidat;

use App\Models\Document;
use App\Models\Objective;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CandidatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        if (Auth::user()->is_admin){
            return redirect()->route('admin');
        }
        else 
        {
            $candidat= Candidat::where(['user_id'=>Auth::user()->id])->get()->first();
            if( $candidat)
            {
            
                return view('candidat.candidatIndex')->with(['candidat'=>$candidat]);
            }
            else {
                $user=Auth::user();
                $grades= Grade::all();
                $pays= Pays::all();
                $objectives= Objective::all();
                return view('candidat.create')
                ->with(['user'=>$user, 'grades'=>$grades,'pays'=>$pays,'objectives'=>$objectives]
                );
            
            }
        }
        return back();
    }
    public function store(Request $request)
    {
        $request->request->add(['user_id' =>auth()->user()->id]);
        
        $data = $request->all();
        $validator =  Validator::make($data, [

            'fonction' => ['required', 'string', 'max:255'],
            'grade_id' => ['required','numeric' ],
            'pays_id' => ['required','numeric' ],
            'etablissement'=> ['required', 'string', 'max:255'],
            'objective_id' => ['required','numeric'],

            'year_of_last_benefit' => ['required', 'string', 'max:4'],

           // 'file' =>'required|mimes:pdf|max:10240',
            
        ]);

        if ($validator->fails()) {
            
           //$Flasher->addError($validator->messages()->first());
          // PrimeFlasher::flash()->addError($validator->messages()->first());
            return back()->withInput();
        }
        
        Candidat::create( $data );
        
        flash('candidat info Successfully Added','success');
        
        return redirect()->route('candidat');
    }

    public function candidatIndex()
    {
        $candidat= Candidat::where(['user_id'=>Auth::user()->id])->get()->first();
        if( $candidat)
        {
            return view('candidat.candidatIndex')->with(['candidat'=>$candidat]);
        }
    }
   

    public function print()
    {
        
        $user =  Auth::user();//User::find($id)->candidat;  ///Candidat::findOrFail($id);
        
        $candidat= Candidat::where(['user_id'=>Auth::user()->id])->get()->first();
        
        if( $candidat)
        { 
            $documents= Document::where(['candidat_id'=>$candidat->id]);
            if ($documents)
            {
                return view('candidat.print', compact('user','candidat','documents'));
            } return 'error no documents !';
            
            
        } return 'error no candadat !';
    }
    public function show_uploaded_file()
    {  
        
        return ('show_uploaded_file');
    }
    public function edit()
    {
        return ('Here where editing Candidat data!!!!!');
    }
    
}
