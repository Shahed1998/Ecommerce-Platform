<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //customer dashboard get
    public function getDashboard(Request $req){
        // return $req->session()->get('uc_id');
        return view("customer.dashboard");
    }
}
