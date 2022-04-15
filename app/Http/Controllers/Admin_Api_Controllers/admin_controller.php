<?php

namespace App\Http\Controllers\Admin_Api_Controllers;


use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use App\Models\Admin\User_Info;
use Illuminate\Support\Facades\Hash;
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

    public function Login(Request $req)
    {
        //Status 1-success
        //Status 2-Invalid email or password
        //Status 3-User is not active
        //Status 4-Some errors occurred
        try
        {
            $user = UserCredential::where('email',$req->email_ad)->first();
            if(!$user || !Hash::check($req->pass, $user->password)) //Checking if there is a user with given email and password
            {
                return response()->json([
                    "status"=>2,
                    "message"=>"Invalid email or password!"
                ],200);
            }
            if($user->user_status!=1)//checking if user is active or not
            {
                return response()->json([
                    "status"=>3,
                    "message"=>"User is not active!"
                ],200);
            }
            if($user->user_role==2)//admin
            {
                return response()->json([
                    "status"=>1,
                    "message"=>"Success",
                    "email"=>$req->email_ad,
                    "uc_id"=>$user->id,
                    "user_role"=>$user->user_role
                ],200);
            }
            return response()->json([
                "status"=>4,
                "message"=>"Error occurred"
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

    // public function Login(Request $req)
    // {
    //     //return response()->json(["msg"=>"Invalid email or password!"]);
    //     $user = UserCredential::where('email',$req->email_ad)->first();
    //     if(!$user || !Hash::check($req->pass, $user->password)) //Checking if there is a user with given email and password
    //     {
    //         return response()->json(["msg"=>"Invalid email or password!"]);
    //     }
    //     if($user->user_status!=1)//checking if user is active or not
    //     {
    //         return response()->json(["msg"=>"User is not active!"]);
    //     }
    //     // if($user->user_role==1)//customer
    //     // {
    //     //     return response()->json(["email"=>$req->email,"uc_id"=>$user->id,"user_role"=>$user->user_role]);
    //     // }
    //     if($user->user_role==2)//admin
    //     {
    //         return response()->json(["email"=>$req->email_ad,"uc_id"=>$user->id,"user_role"=>$user->user_role]);
    //     }
    //     return response()->json(["msg"=>"Invalid email or password!"]);
    // }

    public function AdminActivities(Request $req)
    {
        $activites=UserCredential::where('id',$req->id)
        ->first();
        return response()->json($activites->Histories);
    }
    public function ClearHistory(Request $req)
    {
        try
        {
            return response()->json([
                "status"=>"Ok",
                "message"=>"yeah"
            ],200);
            $a=UserCredential::where('user_role',2)->where('id',$req->admin_id)->first();
            if(!$a)
            {
                throw new \ErrorException("Invalid admin!");
            }
            if(AdminHistory::where('admin_id',$req->admin_id)->delete())
            {
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"History Successfully cleared"
                ],200);
            }
            throw new \ErrorException("Something went wrong!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
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
            return response()->json(["msg"=>"Error in registration please try again later!"]);
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
            return response()->json(["msg"=>"Error in registration please try again later!"]);
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
