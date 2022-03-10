<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;

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

    public function updateGet(Request $req){
        $user_id = $req->session()->get('uc_id');
        $user_info = UserInfo::where('uc_id', $user_id)->first();
        return view('customer.update')->with('user_info', $user_info);
    }

    public function updatePatch(Request $req){
        
        $this->validate($req, [
            "prev-password"=>"required",
        ],[
            "prev-password.required"=>"Old password is required to update"
        ]);

        return $req->input();

        // $input = $req->input();
        // $user_info = new UserInfo();
        // $user_id = $req->session()->get('uc_id');

        // if($input["uname"]){
        //     UserInfo::where('uc_id', $user_id )->update(['name'=>$input['uname']]);
        // }
    }
}
