<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Rules\EmailFormat;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Rules\IsColumnsUnique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = array(
            'date_nais.unique' => 'اللقب والاسم الأول والتاريخ موجودان بالفعل!',
            'prenom_fr.unique' => 'اللقب والاسم الأول والتاريخ موجودان بالفعل!',//' nom ,prenom et date  existe déja!',
        );

        return Validator::make($data, [
            'nom_ar' => ['required', 'string', 'max:255'],
            'nom_fr' => ['required', 'string', 'max:255'],
            'prenom_ar' => ['required', 'string', 'max:255', ],
            'prenom_fr' => ['required', 'string', 'max:255',],// 
            'date_nais' => ['required', 'string', 'max:10',
         
                            new IsColumnsUnique('users', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']]),
                            new IsColumnsUnique('users', ['nom_fr' => $data['nom_fr'], 'prenom_fr' => $data['prenom_fr'], 'date_nais' => $data['date_nais']]),
                 
                            ],
            'phone' => ['required', 'string', 'max:10'],
            'relex_service_id'=> ['required', 'numeric', 'max:10'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users',new EmailFormat(),
           
        ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $pattern = '/\w+(.)?\w+(@univ-alger.dz)/';

        $mailform= preg_match($pattern, $data['email']);
       // dd( $mailform);
       

        $user = User::create([
            'relex_service_id' => $data['relex_service_id'],
            'nom_ar' => $data['nom_ar'],
            'nom_fr' => $data['nom_fr'],
            'prenom_ar' => $data['prenom_ar'],
            'prenom_fr' => $data['prenom_fr'],
            'date_nais' => $data['date_nais'],
            'phone' => $data['phone'],

            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        $user->addRole('candidat');
        return  $user;
       // return back()->with('success','Candidat created successfully!');
    
   
    }
}
