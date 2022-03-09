<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;

class dashboardController extends Controller
{
    public function __construct(){
        $this->middleware('sessionChecker');
    }
    
    //customer dashboard get
    public function getDashboard(Request $req){
        $uc_id = $req->session()->get('uc_id');

        $user_info =  UserInfo::where('uc_id',$uc_id)->first();

        // return $info;

        return view("customer.dashboard")->with('info', $user_info);
    }

    public function getEdit(){
        return view('customer.edit');
    }
}
