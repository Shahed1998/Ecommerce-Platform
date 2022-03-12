<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use App\Models\Admin\User_Info;
use DateTime;

class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }
    public function home()
    {
        $customers=UserCredential::where('user_status',2)
        ->where('user_role',1)->get();

        $dstaffs=UserCredential::where('user_status',2)
        ->where('user_role',3)->get();

        $vendors=UserCredential::where('user_status',2)
        ->where('user_role',4)->get();

        return view('admin.home')->with('c',count($customers))
        ->with('s',count($dstaffs))
        ->with('v',count($vendors))
        ->with('t',count($customers)+count($dstaffs)+count($vendors));
    }

    //Admin

    public function AdminActivities()
    {
        $activites=UserCredential::where('id',session()->get('uc_id'))
        ->first();
        //return $activites->Histories;
        return view('Admin.activities')->with('activities',$activites->Histories);
    }

    public function ValidateForm($req)
    {
        $this->validate($req, 
        [
            "name"=>"required|min:5|max:30|regex:/^[A-Z. a-z]+$/",
            "email"=>"required|unique:user_credentials,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/",
            "password"=>"required|min:8|max:30",
            "confPassword"=>"required|same:password|min:8|max:30",
            "gender"=>"required",
            "contact"=>"required|min:10|max:10|regex:/^[0-9]{10}+$/",
            "Praddress"=>"required|max:100",
            "Peaddress"=>"required|max:100",
            "admin_image"=>"required|mimes:jpg,png,jpeg"
        ]
        ,[
            "name.required"=>"Name field is required",
            "name.regex"=>"Name format is invalid",
            "name.min"=>"Name must be at least 5 characters long",
            "name.max"=>"Name must not exceed 30 characters",
            "email.required"=>"Email is required",
            "email.regex"=>"Email format is incorrect",
            "password.required"=>"Password field is required",
            "password.min"=>"Password must be at least 8 characters long",
            "password.max"=>"Password must not exceed 30 characters",
            "confPassword.same" => "Password and Confirm password must be same",
            "confPassword.required"=>"Confirm password is required",
            "gender.required"=>"Gender must be selected",
            "contact.required"=>"Contact number is required",
            "contact.min"=>"Contact number must be 10 characters long",
            "contact.max"=>"Contact number must be 10 characters long",
            "contact.regex"=>"Characters must be between 0 to 9",
            "Praddress.required"=>"Present address is required",
            "Peaddress.required"=>"Permanent address is required",
            "admin_image.required"=>"Image is required",
            "admin_image.mimes"=>"Incorrect image format"
        ]
        );

    }
    public function AdminRegistration(Request $req)
    {
        return view('admin.AdminRegistration');
    }
    public function AdminRegistrationPost(Request $req)
    {
        $this->ValidateForm($req);
        
        $uc=new UserCredential();
        $uc->email = $req->email;
        $uc->password = bcrypt($req->password);
        $uc->user_status = 1;
        $uc->user_role = 2;
        $uc->save();
        
        $uinfo=new User_Info();
        $uinfo->name=$req->name;
        $uinfo->gender=$req->gender;
        $uinfo->dob=$req->dob;
        $uinfo->contact_no=$req->contact;
        $uinfo->present_address=$req->Praddress;
        $uinfo->permanent_address=$req->Peaddress;
        $uinfo->uc_id=$uc->id;

        //Storing image
        $folder="profile_images";
        $file_name=$uc->id.'.'.$req->file('admin_image')->getClientOriginalExtension();
        $req->file('admin_image')->storeAs($folder,$file_name);
        $uinfo->image="storage/profile_images/".$file_name;
        $uinfo->save();
        return view('admin.AdminRegistration');
    }
}
