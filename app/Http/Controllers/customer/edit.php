<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserCredential;
use Illuminate\Support\Facades\Hash;
use Exception;

class edit extends Controller
{
    public function __construct(){
        $this->middleware('sessionChecker');
    }

    public function updateGet(Request $req){
        $user_id = $req->session()->get('uc_id');
        $user_info = UserInfo::where('uc_id', $user_id)->first();
        return view('customer.update')->with('user_info', $user_info);
    }

    public function updatePatch(Request $req){
        
        $this->validate($req, [
            "prev-password"=>"required|min:8",
        ],[
            "prev-password.required"=>"Old password is required to update",
            "prev-password.min"=>"Password must be more than 8 characters long",
        ]);

        $user_id = $req->session()->get('uc_id');
        $verification_password = $req->input()["prev-password"];
        $user = UserCredential::where('id',$user_id)->first();

        // Hash::check(plain text, hashed password)
        if(Hash::check($verification_password , $user->password)){
            // Update user name
            if($req->uname){
               $validator = $this->validate($req,[
                    "uname"=>"min:5",
                ],[
                    "uname.min"=>"Username must be at least 5 characters long",
                ]);

                UserInfo::where('uc_id', $user_id)->update(["name"=>$req->uname]);
            }

            // Update user email
            if($req->email){
                $this->validate($req, [
                    "email"=>"regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
                ]);

                // Handling query exception
                try{
                    UserCredential::where('id', $user_id)->update(["email"=>$req->email]);
                }catch(Exception $e){
                    $req->session()->flash('update_status', false);
                    return back();
                }
            }

            // Update user password
            if($req->password){
                $this->validate($req,[
                    "password"=>"min:8",
                    "c_password"=>"required|required_with:password|same:password|min:8",
                ],[
                    "password.min"=>"Password must be more than 8 characters long",
                    "c_password.same" => "Password and Confirm password must be same",
                    "c_password.required"=>"Confirm password is required",
                    "c_password.min"=>"Confirm password must be more than 8 characters long",
                ]);

                UserCredential::where('id', $user_id)->update(["password"=>bcrypt($req->password)]);

            }

            // Update user gender
            if($req->gender){
                UserInfo::where('uc_id', $user_id)->update(['gender'=>$req->gender]);
            }

            // update dob
            if($req->dob){
                UserInfo::where('uc_id', $user_id)->update(['dob'=>$req->dob]);
            }

            // update country code
            if($req->country_code){
                UserInfo::where('uc_id', $user_id)->update(['country_code'=>$req->country_code]);
            }

            // update permanent address
            if($req->permanent_address){
                UserInfo::where('uc_id', $user_id)->update(['permanent_address'=>$req->permanent_address]);
            }

            // update present address
            if($req->present_address){
                UserInfo::where('uc_id', $user_id)->update(['present_address'=>$req->present_address]);
            }

            // update image
            if($req->customer_image){
                $this->validate($req, [
                    "customer_image"=>"required|mimes:jpg,png,jpeg,pdf|max:2048"
                ],[
                    "customer_image.required"=>"Image is required",
                    "customer_image.mimes"=>"Incorrect image format",
                    "customer_image.max" => "Image must not be greater than 2 mb"
                ]);

                // Store user image in the server
                $file = $req->file("customer_image");
                $image_name = $file->hashName();
                $image_path = $req->file("customer_image")->storeAs(
                    'public/images', $image_name
                );

                UserInfo::where('uc_id', $user_id)->update(['image'=>"storage/images/".$image_name]);
            }

            $req->session()->flash('update_status', true);
            
        }else{

            $req->session()->flash('update_status', false);
        }
        
        return back();

    }
}
