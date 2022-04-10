<?php

namespace App\Http\Controllers\Admin_Api_Controllers;


use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use App\Models\Admin\User_Info;
use Validator;
use DateTime;

use App\Http\Controllers\Controller;

class admin_controller extends Controller
{
    public function test()
    {
        return response()->json(["msg"=>"I am here!"]);
    }
    //Admin
    public function AdminActivities(Request $req)
    {
        $activites=UserCredential::where('id',$req->id)
        ->first();
        return response()->json($activites->Histories);
    }
    
    public function AdminRegistrationPost(Request $req)
    {
        $check = Validator::make($req->all(),[
            "name"=>"required|min:5|max:30|regex:/^[A-Z. a-z]+$/",
            "email"=>"required|unique:user_credentials,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/",
            "password"=>"required|min:8|max:30",
            "confPassword"=>"required|same:password|min:8|max:30",
            "gender"=>"required",
            "contact"=>"required|min:10|max:10|regex:/^[0-9]{10}+$/",
            "Praddress"=>"required|max:100",
            "Peaddress"=>"required|max:100",
        ]);

        if($check->fails()){
            return response()->json($check->errors());
        }
        
        $uc=new UserCredential();
        $uc->email = $req->email;
        $uc->password = bcrypt($req->password);
        $uc->user_status = 1;
        $uc->user_role = 2;
        if(!$uc->save())
        {
            return response()->json(["msg"=>"Error is registration please try again later!"]);
        }
        
        $uinfo=new User_Info();
        $uinfo->name=$req->name;
        $uinfo->gender=$req->gender;
        $uinfo->dob=$req->dob;
        $uinfo->contact_no=$req->contact;
        $uinfo->present_address=$req->Praddress;
        $uinfo->permanent_address=$req->Peaddress;
        $uinfo->uc_id=$uc->id;

        if(!$uinfo->save())
        {
            return response()->json(["msg"=>"Error is registration please try again later!"]);
        }
        return response()->json(["msg"=>"Admin successfully registered"]);
    }

    public function ProfileView(Request $req)
    {
        $user_info=User_Info::where('uc_id',$req->uc_id)->first();
        $user_cred=UserCredential::where('id',$req->uc_id)->first();
        return response()->json(["user_info"=>$user_info,"user_cred"=>$user_cred]);
    }

    public function ProfileEditPost(Request $req)
    {
        $check = Validator::make($req->all(),[
            "name"=>"required|min:5|max:30|regex:/^[A-Z. a-z]+$/",
            "password"=>"required|min:8|max:30",
            "confPassword"=>"required|same:password|min:8|max:30",
            "gender"=>"required",
            "contact"=>"required|min:10|max:10|regex:/^[0-9]{10}+$/",
            "Praddress"=>"required|max:100",
            "Peaddress"=>"required|max:100",
        ]);

        if($check->fails()){
            return response()->json($check->errors());
        }
        
        $uc=UserCredential::where('id',$req->uc_id)->first();
        $uc->password = bcrypt($req->password);
        if(!$uc->save())
        {
            return response()->json(["msg"=>"Error is editing please try again later!"]);
        }
        $uinfo=User_Info::where('uc_id',$req->uc_id)->first();
        $uinfo->name=$req->name;
        $uinfo->gender=$req->gender;
        $uinfo->dob=$req->dob;
        $uinfo->contact_no=$req->contact;
        $uinfo->present_address=$req->Praddress;
        if(!$uinfo->save())
        {
            return response()->json(["msg"=>"Error is editing please try again later!"]);
        }
        return response()->json(["msg"=>"Profile succussfully updated"]);
    }
}
