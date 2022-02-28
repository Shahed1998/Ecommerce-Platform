<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class registrationController extends Controller
{
    //get registration page
    public function getRegister(){
        return view('register')->with('pageName', 'Sign up');
    }
}
