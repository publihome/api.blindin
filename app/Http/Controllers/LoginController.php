<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index(){
        return view('login');
    }


    public function loginValidate(Request $request){
        $data = request()->except('_token');
        if(Auth::attempt($data)){
            request()->session()->regenerate();
            return "stas logeado";
        }
        return "no estas logeado";
    }
}
