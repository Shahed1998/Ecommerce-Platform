<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserCredential;
use Illuminate\Support\Facades\Hash;

class dashboardController extends Controller
{
    // --------------------------------------- Final term
    public function getDashboard(Request $req){
        try{
            // $id = decrypt($req->id);
            $id = $req->id;
            if(UserInfo::where('uc_id', $id)->first()){

                $customer_info = UserInfo::where('uc_id', $id)
                ->first()
                ->makeHidden(['uc_id', 'id']);

            }else{
                throw new \ErrorException('Invalid id');
            }
            

            $customer_credentials = UserInfo::where('uc_id', $id)->first()
            ->userCredential
            ->makeHidden(['password']);

            $customer_status = UserInfo::where('uc_id', $id)
            ->first()
            ->userCredential
            ->userStatus
            ->status;

            $customer_role = UserInfo::where('uc_id', $id)
            ->first()
            ->userCredential
            ->userRole
            ->user_role;

            $customer_info['email'] = $customer_credentials->email;
            $customer_info['status'] = $customer_status;
            $customer_info['role'] = $customer_role;

            return response()->json([
                'status'=>'Success',
                'data'=>[
                    'info'=>$customer_info,
                ]
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status'=>'Failed',
                'message'=>$e->getMessage()
            ]);
        }
    }











    // --------------------------------------- Mid term
    // public function __construct(){
    //     $this->middleware('sessionChecker');
    // }
    
    // //customer dashboard get
    // public function getDashboard(Request $req){
    //     $uc_id = $req->session()->get('uc_id');

    //     $user_info =  UserInfo::where('uc_id',$uc_id)->first();

    //     // return $info;

    //     return view("customer.dashboard")->with('info', $user_info);
    // }

    // public function getEdit(){
    //     return view('customer.edit');
    // }

    
}
