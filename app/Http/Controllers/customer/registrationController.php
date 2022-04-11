<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Customer\UserCredential;
use App\Models\Customer\UserInfo;

class registrationController extends Controller
{
    // ---------------------------------------------------- Final Term
    // Sign up
    public function signup(Request $req){
        try{
            // return $req->user_role;
            $validator = Validator::make($req->all(),[
                "name"=>"required|min:5",
                "email"=>"required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
                "password"=>"required|min:8",
                "c_password"=>"required|required_with:password|same:password|min:8",
                "gender"=>"required",
                "dob"=>"required",
                "contact"=>"required|min:2|max:15",
                "present_address"=>"required",
                "permanent_address"=>"required",
                // "customer_image"=>"required|mimes:jpg,png,jpeg,pdf|max:2048"
            ]);

            if($validator->fails()){
                throw new \ErrorException("Validation failed");
            }

            // // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> To be continued
            // // Saves the data in the user_credentials table
            $user_credentials = new UserCredential();
            $user_credentials->email = $req->email;
            $user_credentials->password = bcrypt($req->password);
            $user_credentials->user_status = 2;
            $user_credentials->user_role = $req->user_role * 1;

            if($user_credentials->save()){

                $uc_id = $user_credentials->id;  

                // // Store user image in the server
                // $file = $req->file("customer_image");
                // $image_name = $file->hashName();
                // $image_path = $req->file("customer_image")->storeAs(
                //     'public/images', $image_name
                // );

                // Save the user info on the user_info table
                $user_info = new UserInfo();
                $user_info->name = $req->name;
                $user_info->gender = $req->gender;
                $user_info->dob = $req->dob;
                $user_info->country_code = $req->country_code;
                $user_info->contact_no = $req->contact;
                // $user_info->image = "storage/images/".$image_name;
                $user_info->present_address = $req->present_address;
                $user_info->permanent_address = $req->permanent_address;
                $user_info->uc_id = $uc_id;
                if($user_info->save()){
                    return response()->json([
                        "status"=>"success",
                        "data"=>[
                            "response"=>$req->all()
                        ]],201
                    );
                }else{
                    throw new \ErrorException("Unable to add data");
                }
            }else{
                throw new \ErrorException("Unable to add data");
            }


        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
        
    }























    // ---------------------------------------------------- Mid Term
    // // Validator function
    // private function form_validator($req){
    //     $this->validate($req, [
    //         "uname"=>"required|min:5",
    //         "email"=>"required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
    //         "password"=>"required|min:8",
    //         "c_password"=>"required|required_with:password|same:password|min:8",
    //         "gender"=>"required",
    //         "contact"=>"required|min:2|max:15",
    //         "present_address"=>"required",
    //         "permanent_address"=>"required",
    //         "customer_image"=>"required|mimes:jpg,png,jpeg,pdf|max:2048"
    //     ],[
    //         "uname.required"=>"User name is required",
    //         "uname.min"=>"Username must be at least 5 characters long",
    //         "email.required"=>"Email is required",
    //         "password.required"=>"Password is required",
    //         "password.min"=>"Password must be more than 8 characters long",
    //         "c_password.same" => "Password and Confirm password must be same",
    //         "c_password.required"=>"Confirm password is required",
    //         "c_password.min"=>"Confirm password must be more than 8 characters long",
    //         "gender.required"=>"Gender must be selected",
    //         "contact.required"=>"Contact number is required",
    //         "contact.min"=>"Contact number must be of minimum 2 characters",
    //         "contact.max"=>"Contact number must be of maximum 15 characters",
    //         "present_address.required"=>"Present address is required",
    //         "permanent_address.required"=>"Permanent address is required",
    //         "customer_image.required"=>"Image is required",
    //         "customer_image.mimes"=>"Incorrect image format",
    //         "customer_image.max" => "Image must not be greater than 2 mb"
    //     ]);

    // }

    // //get registration page
    // public function getRegister(){
    //     return view('register')->with('pageName', 'Sign up');
    // }

    // private function errorHandler($message="", $statusCode=500){
    //     // return $params;
    //         return response()->json([
    //             "status"=>"Failed",
    //             "message"=> $message

    //         ], $statusCode);
    // }

    // public function postRegister(Request $req){
    //     $validated_data = $this->form_validator($req);
    //     // Saves the data in the user_credentials table
    //     $user_credentials = new UserCredential();
    //     $user_credentials->email = $req->email;
    //     $user_credentials->password = bcrypt($req->password);
    //     $user_credentials->user_status = 2;
    //     $user_credentials->user_role = $req->register_as;

    //     if($user_credentials->save()){

    //         $uc_id = $user_credentials->id;  

    //         // Store user image in the server
    //         $file = $req->file("customer_image");
    //         $image_name = $file->hashName();
    //         $image_path = $req->file("customer_image")->storeAs(
    //             'public/images', $image_name
    //         );

    //         // Save the user info on the user_info table
    //         $user_info = new UserInfo();
    //         $user_info->name = $req->uname;
    //         $user_info->gender = $req->gender;
    //         $user_info->dob = $req->dob;
    //         $user_info->country_code = $req->country_code;
    //         $user_info->contact_no = $req->contact;
    //         $user_info->image = "storage/images/".$image_name;
    //         $user_info->present_address = $req->present_address;
    //         $user_info->permanent_address = $req->permanent_address;
    //         $user_info->uc_id = $uc_id;
    //         if($user_info->save()){
    //             $req->session()->flash('registration_status', 'User registered successfully');
    //         }else{
    //             $req->session()->flash('registration_status', 'Unable to sign-up');
    //         }
    //     }else{
    //         $req->session()->flash('registration_status', 'Unable to sign-up');
    //     }
        
    //     return back();
        
    // }
}
