<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logout extends Controller
{
    //
    public function logout(Request $req){
        $req->session()->flush();
        return back();
    }
}
