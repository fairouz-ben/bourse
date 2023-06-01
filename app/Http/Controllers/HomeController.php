<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function index()
    {
        return view('home');
    }*/
    public function index()
    {
        if (Auth::user()->is_admin){
                return redirect()->route('admin');
        }
        else 
        {
            return redirect()->route('candidat'); //redirect()->
        }
           // return back();
           return redirect()->route('/'); 
    }
}
