<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    //get login page
    public function loginGet(){
        return view('login');
    }
}
