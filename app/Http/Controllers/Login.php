<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;

class Login extends Controller
{
    //get login page
    public function loginGet(){
        return view('login');
    }
    //post login page
    public function loginPost(Request $req){
        $user =UserCredential::where('email',$req->email)
        ->where('password',$req->password)
        ->first();
        if(!$user)//Checking if there is a user with given email and password
        {
            $req->session()->flash('msg','Invalid email or password');
            return redirect()->route('login');
        }
        if($user->user_status!=1)//checking if user is active or not
        {
            $req->session()->flash('msg','User is not active!');
            return redirect()->route('login');
        }

        if($user->user_role==1)//customer
        {
            
        }

        if($user->user_role==2)//admin
        {
            $req->session()->put('email',$req->email);
            $req->session()->put('uc_id',$user->id);
            $req->session()->put('user_role',$user->user_role);
            return redirect()->route('admin.home');
        }

        if($user->user_role==3)//staff
        {
            
        }
        if($user->user_role==4)//vendor
        {
            
        }
    }
}