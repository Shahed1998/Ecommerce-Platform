<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserCredential;
use App\Models\Customer\AddToCart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer\ProductModel;
use App\Models\Customer\Feedback;

class delete extends Controller
{
    //
    // public function __construct(){
    //     $this->middleware('sessionChecker');
    // }

    // public function getDelete(){
    //     return view('customer.delete');
    // }

    public function delete(Request $req){
        
        // ------------------------------- Final Term
        try{

            $user_id = $req->id;
            $user_password = $req->password;

            $stored_pass = UserCredential::where('id', $user_id)->first()->password;
            $user_id = UserCredential::where('id', $user_id)->first()->id;

            if( $user_id && Hash::check($user_password, $stored_pass) ){
                // $image_name = explode('/',UserInfo::where('uc_id', $user_id)->first()->image)[2];
                // return $image_name;
                // if(!Storage::delete("/images/$image_name")){
                //     throw new \ErrorException("Image not deleted");
                // }
                // Storage::delete("public/images/$image_name");
                
                Feedback::where('c_id', $user_id)->delete();
                AddToCart::where('c_id', $user_id)->delete();
                UserInfo::where('uc_id', $user_id)->delete();
                UserCredential::where('id', $user_id)->delete();

                return response()->json([
                    "status"=>"success",
                    "message"=>"successfully deleted user"
                ], 204);

            }else{
                throw new \ErrorException("Details not matched");
            }

        }catch(\Exception $err){
            return response()->json([
                "status"=>"Failed",
                "message"=>$err->getMessage()
            ], 404);
        }
        
        
        
        // ------------------------------- Mid Term
        // $this->validate($req, [
        //     "password"=>"required",
        // ],[
        //     "password.required"=>"Password is required",
        // ]);

        // $user_id = $req->session()->get('uc_id');

        // $stored_pass = UserCredential::where('id',$user_id)->first()->password;

        // if(Hash::check($req->password, $stored_pass)){
        //     $image_name = explode('/',UserInfo::where('uc_id', $user_id)->first()->image)[2];
        //     // Deletes the existing image from the storage
        //     if(UserInfo::where('uc_id', $user_id)->delete()){
        //         Storage::delete("public/images/$image_name");
        //         UserCredential::where('id', $user_id)->delete();
        //         return redirect()->route('logout');
        //     }
        // }else {
        //     $req->session()->flash('invalid', 'Password is invalid');
        //     return back();
        // }
    }
}
