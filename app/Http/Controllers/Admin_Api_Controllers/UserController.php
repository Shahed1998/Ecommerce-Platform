<?php

namespace App\Http\Controllers\Admin_Api_Controllers;

use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use App\Models\Admin\Customer_cart;
use App\Models\Admin\Product;
use App\Models\Admin\Order;
use App\Models\Admin\User_Info;
use Validator;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin_Api_Controllers\admin_controller;

class UserController extends Controller
{
    //
    public function AddUser(Request $req)
    {
        try
        {
            $check = Validator::make($req->all(),[
                "name"=>"required|min:5|max:30|regex:/^[A-Z. a-z]+$/",
                "email"=>"required|unique:user_credentials,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/",
                "password"=>"required|min:8|max:30",
                "confPassword"=>"required|same:password|min:8|max:30",
                "gender"=>"required",
                "user_status"=>"required|regex:/^[1-4]{1}+$/",
                "user_role"=>"required|regex:/^[1-4]{1}+$/",
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
            $uc->user_status = $req->user_status;
            $uc->user_role = $req->user_role;
            if($uc->save())
            {
                $uinfo=new User_Info();
                $uinfo->name=$req->name;
                $uinfo->gender=$req->gender;
                $uinfo->dob=$req->dob;
                $uinfo->contact_no=$req->contact;
                $uinfo->present_address=$req->Praddress;
                $uinfo->permanent_address=$req->Peaddress;
                $uinfo->uc_id=$uc->id;
                if($uinfo->save())
                {
                    return response()->json([
                        "status"=>"Ok",
                        "message"=>"User successfully added"
                    ],200);
                }   
            }
            throw new \ErrorException("Error in registration please try again later!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

    public function Deleteuser(Request $req)
    {
        try
        {
            $user=UserCredential::where('id',$req->id)->first();
            if(!$user)
            {
                throw new \ErrorException("No user found!");
            }
            if($user->user_role==1)
            {
                Customer_cart::where('c_id',$req->id)->delete();
                Order::where('customer_id',$req->id)->delete();
                User_Info::where('uc_id',$req->id)->delete();
                UserCredential::where('id',$req->id)->delete();
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"User successfully deleted!"
                ],200);
            }
            else if($user->user_role==2)
            {
                AdminHistory::where('admin_id',$req->id)->delete();
                User_Info::where('uc_id',$req->id)->delete();
                UserCredential::where('id',$req->id)->delete();
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"User successfully deleted!"
                ],200);
            }
            else if($user->user_role==3)
            {
                User_Info::where('uc_id',$req->id)->delete();
                UserCredential::where('id',$req->id)->delete();
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"User successfully deleted!"
                ],200);
            }
            else
            {
                $products=Product::where("vendor_id",$req->id)->get();
                foreach($products as $i)
                {
                    Order::where('product_id',$i->id)->delete();
                    Customer_cart::where('p_id',$i->id)->delete();
                }
                Product::where("vendor_id",$req->id)->delete();
                User_Info::where('uc_id',$req->id)->delete();
                UserCredential::where('id',$req->id)->delete();
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"User successfully deleted!"
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
    public function ShowUser(Request $req)
    {
        $user_info=User_Info::where('uc_id',$req->id)->first();
        $user_cred=UserCredential::where('id',$req->id)->first();
        return response()->json(["user_info"=>$user_info,"user_cred"=>$user_cred]);
    }

    public function ShowAllUser()
    {
        $user_info=User_Info::all();
        $users=[];
        foreach($user_info as $i)
        {
            $var=[];
            $var["user_info"]=$i;
            $var["user_cred"]=UserCredential::where('id',$i->uc_id)->first();
            $users[]=$var;
        }
        return response()->json($users);
    }

    public function ChangeAccess(Request $req)
    {
        try
        {
            $check = Validator::make($req->all(),[
                "id"=>"required|regex:/^[1-4]{1}+$/",
                "user_status"=>"required|regex:/^[1-4]{1}+$/"
            ]);
    
            if($check->fails()){
                return response()->json($check->errors());
            }
            $user=UserCredential::where('id',$req->id)->first();
            if(!$user)
            {
                throw new \ErrorException("No matched user found!");
            }
            $user->user_status=$req->user_status;
            if($user->save())
            {
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"Access successfully changed"
                ],200); 
            }
            throw new \ErrorException("Error in changing access!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }
}
