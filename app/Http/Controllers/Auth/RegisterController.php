<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsCompositeUnique_Invoke;
use App\Rules\EmailFormat;

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
        return Validator::make($data, [
            'nom_ar' => ['required', 'string', 'max:255', new IsCompositeUnique_Invoke('users', ['nom_ar' => $data['nom_ar'], 'prenom_ar' => $data['prenom_ar'], 'date_nais' => $data['date_nais']])],
            'nom_fr' => ['required', 'string', 'max:255'],
            'prenom_ar' => ['required', 'string', 'max:255'],
            'prenom_fr' => ['required', 'string', 'max:255'],
            'date_nais' => ['required', 'string', 'max:10'],
            
            'phone' => ['required', 'string', 'max:10'],
            'relex_service_id'=> ['required', 'numeric', 'max:10'],
            'email' => ['required', new EmailFormat($data['email']),'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
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
