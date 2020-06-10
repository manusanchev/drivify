<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        $user = Auth::user();

        if(!$user->hasVerifiedEmail()){
            Auth::logout();
            return view('auth/verify');

        }else{
            if($user->roles == "admin"){
                return redirect('/admin/dashboard');
            }else{
                return view('home');
            }
           
        }

    }
}
