<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserCredential;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Exception;
use Validator;

class edit extends Controller
{

    public function __construct(){
        $this->middleware('XSSsanitizer');
    }
   
    public function updatePatch(Request $req){
        //{/* ------------------------------------------------------------ */}
        //{/* Have to develop a strategy to upload image */}
        //{/* ------------------------------------------------------------ */}
        // return "not so genius";
        try{
            // return $req->all();
            $validator = Validator::make($req->all(),[
                "name"=>"required|min:5",
                "email"=>"required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
                "password"=>"required|min:8",
                "new_password"=>"required|min:8",
                "confirm_new_password"=>"required|required_with:new_password|same:new_password|min:8",
                "contact"=>"required|min:2|max:15",
                "gender"=>"required",
                "present_address"=>"required",
                "permanent_address"=>"required",
                // "customer_image"=>"required|mimes:jpg,png,jpeg,pdf|max:2048"
            ]);

            if($validator->fails()){
                throw new \ErrorException("Unable to validate data");
            }


            // Saves the data in the user_credentials table
            $db_stored_pass = UserCredential::where('id', $req->id)->first()->password;
            if(Hash::check($req->password, $db_stored_pass))
            {
                UserCredential::where('id', $req->id)->update([
                    "email"=>$req->email, "password"=>bcrypt($req->password)
                ]);

                // $image_name = explode('/',UserInfo::where('uc_id', $user_id)->first()->image)[2];
                // Deletes the existing image from the storage
                // Then updates the latest image
                // if(Storage::exists("public/images/$image_name")){
                //     Storage::delete("public/images/$image_name");
                //     // Store user image in the server
                //     $file = $req->file("customer_image");
                //     $image_name = $file->hashName();
                //     $image_path = $req->file("customer_image")->storeAs(
                //         'public/images', $image_name
                //     );
                //     UserInfo::where('uc_id', $req->id)->update(['image'=>"storage/images/".$image_name]);
                // }

                UserInfo::where('uc_id', $req->id)->update([
                    "name"=>$req->name,
                    "gender"=>$req->gender,
                    "dob"=>$req->dob,
                    "contact_no"=>$req->contact,
                    "country_code"=>$req->country_code,
                    "present_address"=>$req->present_address,
                    "permanent_address"=>$req->permanent_address
                ]);

                return response()->json([
                    "status"=>"Success",
                    "data"=>$req->all()
                ],200);

            }
            
            throw new \ErrorException("Unable to update profile");

        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

}











// ----------------------------------------------------- Mid
//         try{
//             return $req->password;
//             $validator = Validator::make($req->all(),[
//                 "name"=>"min:5",
//                 "email"=>"regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
//                 "password"=>"min:8",
//                 "new_password"=>"min:8",
//                 "confirm_new_password"=>"min:8",
//                 "contact"=>"min:2|max:15",
//                 "customer_image"=>"mimes:jpg,png,jpeg,pdf|max:2048"
//             ]);

//             if($validator->fails()){
//                 throw new \ErrorException("Unable to validate data");
//             }

//             // // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> To be continued
//             // // Saves the data in the user_credentials table
//             $user_credentials = new UserCredential();
//             $user_credentials->email = $req->email;
//             $user_credentials->password = bcrypt($req->password);
//             $user_credentials->user_status = 2;
//             $user_credentials->user_role = $req->user_role * 1;

//             if($user_credentials->save()){

//                 $uc_id = $user_credentials->id;  

//                 // Store user image in the server
//                 $file = $req->file("customer_image");
//                 $image_name = $file->hashName();
//                 $image_path = $req->file("customer_image")->storeAs(
//                     'public/images', $image_name
//                 );

//                 // Save the user info on the user_info table
//                 $user_info = new UserInfo();
//                 $user_info->name = $req->name;
//                 $user_info->gender = $req->gender;
//                 $user_info->dob = $req->dob;
//                 $user_info->country_code = $req->country_code;
//                 $user_info->contact_no = $req->contact;
//                 $user_info->image = "storage/images/".$image_name;
//                 $user_info->present_address = $req->present_address;
//                 $user_info->permanent_address = $req->permanent_address;
//                 $user_info->uc_id = $uc_id;
//                 if($user_info->save()){
//                     return response()->json([
//                         "status"=>"success",
//                         "data"=>[
//                             "response"=>$req->all()
//                         ]],201
//                     );
//                 }else{
//                     throw new \ErrorException("Unable to add data");
//                 }
//             }else{
//                 throw new \ErrorException("Unable to add data");
//             }


//         }catch(\Exception $e){
//             return response()->json([
//                 "status"=>"Failed",
//                 "message"=>$e->getMessage()
//             ],400);
//         }














        
//         // $this->validate($req, [
//         //     "prev-password"=>"required|min:8",
//         // ],[
//         //     "prev-password.required"=>"Old password is required to update",
//         //     "prev-password.min"=>"Password must be more than 8 characters long",
//         // ]);

//         // $user_id = $req->session()->get('uc_id');
//         // $verification_password = $req->input()["prev-password"];
//         // $user = UserCredential::where('id',$user_id)->first();

//         // // Hash::check(plain text, hashed password)
//         // if(Hash::check($verification_password , $user->password)){
//         //     // Update user name
//         //     if($req->uname){
//         //        $validator = $this->validate($req,[
//         //             "uname"=>"min:5",
//         //         ],[
//         //             "uname.min"=>"Username must be at least 5 characters long",
//         //         ]);

//         //         UserInfo::where('uc_id', $user_id)->update(["name"=>$req->uname]);
//         //     }

//         //     // Update user email
//         //     if($req->email){
//         //         $this->validate($req, [
//         //             "email"=>"regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
//         //         ]);

//         //         // Handling query exception
//         //         try{
//         //             UserCredential::where('id', $user_id)->update(["email"=>$req->email]);
//         //         }catch(Exception $e){
//         //             $req->session()->flash('update_status', false);
//         //             return back();
//         //         }
//         //     }

//         //     // Update user password
//         //     if($req->password){
//         //         $this->validate($req,[
//         //             "password"=>"min:8",
//         //             "c_password"=>"required|required_with:password|same:password|min:8",
//         //         ],[
//         //             "password.min"=>"Password must be more than 8 characters long",
//         //             "c_password.same" => "Password and Confirm password must be same",
//         //             "c_password.required"=>"Confirm password is required",
//         //             "c_password.min"=>"Confirm password must be more than 8 characters long",
//         //         ]);

//         //         UserCredential::where('id', $user_id)->update(["password"=>bcrypt($req->password)]);

//         //     }

//         //     // Update user gender
//         //     if($req->gender){
//         //         UserInfo::where('uc_id', $user_id)->update(['gender'=>$req->gender]);
//         //     }

//         //     // update dob
//         //     if($req->dob){
//         //         UserInfo::where('uc_id', $user_id)->update(['dob'=>$req->dob]);
//         //     }

//         //     // update country code
//         //     if($req->country_code){
//         //         UserInfo::where('uc_id', $user_id)->update(['country_code'=>$req->country_code]);
//         //     }

//         //     // update permanent address
//         //     if($req->permanent_address){
//         //         UserInfo::where('uc_id', $user_id)->update(['permanent_address'=>$req->permanent_address]);
//         //     }

//         //     // update present address
//         //     if($req->present_address){
//         //         UserInfo::where('uc_id', $user_id)->update(['present_address'=>$req->present_address]);
//         //     }

//         //     // update image
//         //     if($req->customer_image){
//         //         $this->validate($req, [
//         //             "customer_image"=>"required|mimes:jpg,png,jpeg,pdf|max:2048"
//         //         ],[
//         //             "customer_image.required"=>"Image is required",
//         //             "customer_image.mimes"=>"Incorrect image format",
//         //             "customer_image.max" => "Image must not be greater than 2 mb"
//         //         ]);

//         //         $image_name = explode('/',UserInfo::where('uc_id', $user_id)->first()->image)[2];

//         //         // Deletes the existing image from the storage
//         //         // Then updates the latest image
//         //         if(Storage::exists("public/images/$image_name")){
//         //             Storage::delete("public/images/$image_name");
//         //             // Store user image in the server
//         //             $file = $req->file("customer_image");
//         //             $image_name = $file->hashName();
//         //             $image_path = $req->file("customer_image")->storeAs(
//         //             'public/images', $image_name
//         //             );
//         //             UserInfo::where('uc_id', $user_id)->update(['image'=>"storage/images/".$image_name]);
//         //         }
//         //     }

//         //     $req->session()->flash('update_status', true);
            
//         // }else{

//         //     $req->session()->flash('update_status', false);
//         // }
        
//         // return back();

//     }



//     // public function updateGet(Request $req){
//     //     $user_id = $req->session()->get('uc_id');
//     //     $user_info = UserInfo::where('uc_id', $user_id)->first();
//     //     return view('customer.update')->with('user_info', $user_info);
//     // }

// // }
