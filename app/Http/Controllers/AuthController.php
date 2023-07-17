<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //register
    function registerpage(){
        return view('register');
    }
    function loginpage(){
        return view('login');
    }

    function dashboard(){
        if(Auth::user()->role == 'admin'){

            return redirect()->route('category#list');
        }else{

            return redirect()->route('userhome');
        }
    }

}
