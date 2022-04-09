<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserCredential;
use Illuminate\Support\Facades\Hash;

class login extends Controller
{
    //
    public function postLogin(Request $req){
        try{

            $email = $req->email;
            $password = $req->password;

            $customer = UserCredential::where('email', $email)->first();

            if($customer && Hash::check($password, $customer->password)){
                return response()->json([
                    'status'=>'Success',
                    'data'=>[
                        'id'=>$customer->id
                    ]
                ]);
            }

            throw new \ErrorException("User or password did not match");


        }catch(\Exception $e){
            return response()->json([
                'status'=>'Failed',
                'message'=> $e->getMessage()
            ], 404);
        }
    }
}
