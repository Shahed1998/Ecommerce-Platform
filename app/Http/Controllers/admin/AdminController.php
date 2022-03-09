<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;

class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['sessionChecker','authAdmin']);
    }

    // public function __construct(){
    //     $this->middleware('sessionChecker');
    // }

    public function home()
    {
        $customers=UserCredential::where('user_status',2)
        ->where('user_role',1)->get();

        $dstaffs=UserCredential::where('user_status',2)
        ->where('user_role',3)->get();

        $vendors=UserCredential::where('user_status',2)
        ->where('user_role',4)->get();

        return view('admin.home')->with('c',count($customers))
        ->with('s',count($dstaffs))
        ->with('v',count($vendors))
        ->with('t',count($customers)+count($dstaffs)+count($vendors));
    }
    public function CustomerPending()
    {
        $customers=UserCredential::where('user_status',2)
        ->where('user_role',1)->get();
        return view('Admin.PendingCustomers')->with('customers',$customers);
    }

    public function CustomerPendingPost(Request $req)
    {
        $req->validate(
            [
                'searchCustomer'=>'required|regex:/^[0-9]+$/'
            ],
            [
                'searchCustomer.required'=>'Id cannot be empty',
                'searchCustomer.regex'=>'Id must be integer'
            ]
        );
        return redirect()->route('admin.customer.pending.changeAcssess',encrypt($req->searchCustomer));
    }
    public function CustomerPendingChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',2)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        return view('Admin.CustomerPendingChangeAccess')->with('customer',$customer);
    }

    public function CustomerPendingChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',2)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        if($customer)
        {
            if(isset($req->accept))
            {
                $customer->user_status=1;
                $customer->save();
                $req->session()->flash('msg1','Customer successfully being accepted');
            }
            else
            {
                $customer->user_status=4;
                $customer->save();
                $req->session()->flash('msg1','Customer successfully being rejected');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.CustomerPendingChangeAccess')->with('customer',$customer);
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
                $req->session()->flash('msg1','Delivery Staff successfully being accepted');
            }
            else
            {
                $DeliverySatff->user_status=4;
                $DeliverySatff->save();
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
