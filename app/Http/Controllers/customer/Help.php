<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserCredential;

class Help extends Controller
{
    //
    public function getEmail($id){
        try{
            $email = UserCredential::where('id', $id)->first()->email;
            return $email;
        }catch(\Exception $error){
            return $error;
        }
        
    }
}
