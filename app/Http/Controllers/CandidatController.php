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
use Ramsey\Uuid\Type\Integer;

class CandidatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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
                $hasdoc=Document::where(['candidat_id'=>$candidat->id])->get()->first();
                if(!$hasdoc){

                    //$this->addDocuments();
                    return redirect()->route('documents');

                }else
                {
                    $hasdocs= Document::where(['candidat_id'=>$candidat->id,'is_deleted' => 0 ])->get();
                return view('candidat.candidatIndex')->with(['candidat'=>$candidat,'docs'=>$hasdocs]);
                }
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
            'pays_nom' => ['required','string' ],
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
   //Documents
    public function addDocuments()
    {
        $candidat= Candidat::where(['user_id'=>Auth::user()->id])->get()->first();
        $user=Auth::user();
        if( $candidat)
        {
            return view('candidat.addDocuments')->with(['candidat'=>$candidat]);
        } else  return redirect()->route('candidat');

    }
    public function store_addDocuments(Request $request)
    {
        //return (dd( $request['candidat_id']));
        $nbfile=6;// Must do it with aouther ways!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $data=  $request->all();
        $validator = Validator::make($data,
        [
            'file_1' => 'required|mimes:pdf|max:10000',
            'file_2' => 'required|mimes:pdf|max:10000',
            'file_3' => 'required|mimes:pdf|max:10000',
            'file_4' => 'required|mimes:pdf|max:10000',
            'file_5' => 'required|mimes:pdf|max:10000',
            'file_6' => 'required|mimes:pdf|max:10000',
            ]
          );
          if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();//->withInput();
        }
        
        for($i=1;$i<=$nbfile; $i++){
        
            $candidat_doc= array();
            if( $request['file_'.$i]!= null){

                $fileName =  $request['candidat_id'].'_doc'.$i.'_'.time().'.'. $request['file_'.$i]->extension(); 
                $filePath = $request->file('file_'.$i)->storeAs('candidats_doc', $fileName);
                $file_path_to_save='/storage/app/' . $filePath;    
                
                $candidat_doc= (['candidat_id'=> $request['candidat_id'],
                                'nom'=> 'doc_'.$i,
                                'doc_nom_id'=> $i,
                                'file_path'=>$file_path_to_save
                                ]);  
                Document::create($candidat_doc);
                flash('Document '. $i .'Successfully Added','success');
                }                     
        }
      
        

        flash('Documents Successfully Added','success');
        
        return redirect()->route('candidat');
        
    }

   //print 

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
    public function show_uploaded_file(Document $document)
    {  
       // dd($document);
      //  dd($document->file_path);
       // dd($document->id);
      // $document= Document::where(['id'=>$document])->get()->first();
      // dd($document);

      if( $document!= null){
            
                $file =base_path().$document->file_path; //app_path()  //base_path
                
           if (file_exists($file)) {

                $headers = [
                    'Content-Type' => 'application/pdf'
                ];

                return response()->download($file, 'uploaded_file', $headers, 'inline');
            } else {
               // echo ('File not found!');
                abort(404, 'File not found!');
            }
        } else abort(404, 'File not found!');

    }
    public function document_archived( $request)
    {
       //dd($request);
        $com = Document::where(['id'=>$request])->update([
            'is_deleted' => 1
        ]);
        return  back();// Response()->json($com);
    }
    
    public function document_restor(Request $request)
    {
        $com = Document::where(['id'=>$request->id])->update([
            'is_deleted' => 0
        ]);
        return Response()->json($com);
    }
    public function document_edit(Document $document)
    {
        
        return view('candidat.document.edit')->with(['document' => $document]);
    }
    public function document_store(Request $request) 
    {
       
        $data = $request->all();
        //dd($request['doc_nom_id']);
        $validator = Validator::make($data,
            [
                "doc_nom_id" => ['required', 'string', 'max:25'],
                'file' => 'required|max:10000', //|mimes: pdf, PDF
               
            ]
        );

        if ($validator->fails()) {
            flash($validator->messages()->first(),'error');
            return back();
        }
        //dd($request['file']);
        $idcondidat=Auth::user()->candidat->id;
       
        $fileName =  $idcondidat.'_'.$request['doc_nom_id'].'_'.time().'.pdf';//. $request->file->extension(); 
        $filePath = $request->file('file')->storeAs('candidats_doc', $fileName);
        $file_path_to_save='/storage/app/' . $filePath;    
        
        $candidat_doc= (['candidat_id'=> $idcondidat,
                        'nom'=> 'doc_'.$request['doc_nom_id'],
                        'doc_nom_id'=> $request['doc_nom_id'],
                        'file_path'=>$file_path_to_save
                        ]);  
        Document::create($candidat_doc);
        flash('Document Successfully Added','success');
      
        return redirect('/candidat');
    }
    public function edit()
    {
        return ('Here where editing Candidat data!!!!!');
    }
    
}
