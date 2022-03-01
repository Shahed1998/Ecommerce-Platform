<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class registrationController extends Controller
{
    // Validator function
    private function form_validator($req){
        $validated_data = $this->validate($req, [
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

        return $validated_data;
    }

    //get registration page
    public function getRegister(){
        return view('register')->with('pageName', 'Sign up');
    }

    // post registration page
    public function postRegister(Request $req){

        $this->form_validator($req);
        
    }
}
