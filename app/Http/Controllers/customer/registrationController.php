<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCredential;
use App\Models\UserInfo;

class registrationController extends Controller
{
    // Validator function
    private function form_validator($req){
        $this->validate($req, [
            "uname"=>"required|min:5",
            "email"=>"required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
            "password"=>"required|min:8",
            "c_password"=>"required|min:8",
            "gender"=>"required",
            "contact"=>"required|min:2|max:15",
            "present_address"=>"required",
            "permanent_address"=>"required",
            "customer_image"=>"required|mimes:jpg,png,jpeg"
        ],[
            "uname.required"=>"User name is required",
            "uname.min"=>"Username must be at least 5 characters long",
            "email.required"=>"Email is required",
            "password.required"=>"Password is required",
            "password.min"=>"Password must be more than 8 characters long",
            "c_password.required"=>"Confirm password is required",
            "c_password.min"=>"Confirm password must be more than 8 characters long",
            "gender.required"=>"Gender must be selected",
            "contact.required"=>"Contact number is required",
            "contact.min"=>"Contact number must be of minimum 2 characters",
            "contact.max"=>"Contact number must be of maximum 15 characters",
            "present_address.required"=>"Present address is required",
            "permanent_address.required"=>"Permanent address is required",
            "customer_image.required"=>"Image is required",
            "customer_image.mimes"=>"Incorrect image format"
        ]);

    }

    //get registration page
    public function getRegister(){
        return view('register')->with('pageName', 'Sign up');
    }

    // post registration page
    public function postRegister(Request $req){

        // return $req;
        
        $validated_data = $this->form_validator($req);

        // Saves the data in the user_credentials table
        $user_credentials = new UserCredential();
        $user_credentials->email = $req->email;
        $user_credentials->password = bcrypt($req->password);
        $user_credentials->user_status = 2;
        $user_credentials->user_role = $req->register_as;

        if($user_credentials->save()){

            $uc_id = $user_credentials->id;  

            // Save the user info on the user_info table
            $user_info = new UserInfo();
            $user_info->name = $req->uname;
            $user_info->gender = $req->gender;
            $user_info->dob = $req->dob;
            $user_info->contact_no = "$req->country_code"."$req->contact";
            $user_info->present_address = $req->present_address;
            $user_info->permanent_address = $req->permanent_address;
            $user_info->uc_id = $uc_id;
            $user_info->save();  
        }
        
        return back();
        
    }
}
