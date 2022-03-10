<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserCredential;
use Illuminate\Support\Facades\Hash;

class delete extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }

    public function getDelete(){
        return view('customer.delete');
    }

    public function delete(Request $req){
        $this->validate($req, [
            "password"=>"required",
        ],[
            "password.required"=>"Password is required",
        ]);

        $user_id = $req->session()->get('uc_id');

        $stored_pass = UserCredential::where('id',$user_id)->first()->password;

        if(Hash::check($req->password, $stored_pass)){
            if(UserInfo::where('uc_id', $user_id)->delete()){
                UserCredential::where('id', $user_id)->delete();
                return redirect()->route('logout');
            }
        }else {
            $req->session()->flash('invalid', 'Password is invalid');
            return back();
        }
    }
}