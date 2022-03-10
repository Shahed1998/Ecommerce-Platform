<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use DateTime;

class DeliveryStaffController extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }

    public function SaveHistory($str)
    {
        $history=new AdminHistory();
        $history->description=$str;
        $history->admin_id=session()->get('uc_id');
        $dt = new DateTime();
        $history->date_time=$dt->format('Y-m-d H:i:s');
        $history->save();
    }

    public function DeliveryStaffPending()
    {
        $DeliveryStaffs=UserCredential::where('user_status',2)
        ->where('user_role',3)->get();
        return view('Admin.PendingDeliveryStaffs')->with('DeliveryStaffs',$DeliveryStaffs);
    }

    public function DeliveryStaffPendingPost(Request $req)
    {
        $req->validate(
            [
                'searchDeliveryStaff'=>'required|regex:/^[0-9]+$/'
            ],
            [
                'searchDeliveryStaff.required'=>'Id cannot be empty',
                'searchDeliveryStaff.regex'=>'Id must be integer'
            ]
        );
        return redirect()->route('admin.DeliveryStaff.pending.changeAcssess',encrypt($req->searchDeliveryStaff));
    }
    public function DeliveryStaffPendingChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $DeliverySatff=UserCredential::where('user_status',2)
        ->where('user_role',3)
        ->where('id',$id)
        ->first();
        return view('Admin.DeliveryStaffPendingChangeAccess')->with('DeliveryStaff',$DeliverySatff);
    }

    public function DeliveryStaffPendingChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $DeliverySatff=UserCredential::where('user_status',2)
        ->where('user_role',3)
        ->where('id',$id)
        ->first();
        if($DeliverySatff)
        {
            if(isset($req->accept))
            {
                $DeliverySatff->user_status=1;
                $DeliverySatff->save();
                $str="Delivery Staff's pending registration request accpeted with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Delivery Staff successfully being accepted');
            }
            else
            {
                $DeliverySatff->user_status=4;
                $DeliverySatff->save();
                $str="Delivery Staff's pending registration request rejected with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Delivery Staff successfully being rejected');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.DeliveryStaffPendingChangeAccess')->with('DeliveryStaff',$DeliverySatff);
    }
}
