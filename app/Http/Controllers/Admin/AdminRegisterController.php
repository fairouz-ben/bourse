<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    use RegistersUsers;

  
   // protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function show_register(){
        return view('auth.admin_register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'familyName_fr' => ['required', 'string', 'max:255'],
            'name_fr'=>['required', 'string', 'max:255'],
            'birthday'=>['required', 'string', 'max:10'],
            'transfert_type'=>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(Request $data)
    {
        
        $user= User::create([
            'familyName_fr' => $data['familyName_fr'],
            'name_fr' => $data['name_fr'],
            'birthday' => $data['birthday'],
            'transfert_type'=> $data['transfert_type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin'=>1,
        ]);
        $user->addRole('supervisor');
        return  $user;
        //return view('admin.dashboard');
        
    }
}
