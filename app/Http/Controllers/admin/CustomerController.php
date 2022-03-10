<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use DateTime;

class CustomerController extends Controller
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

    //customer pending

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
                $str="Customer's pending registration request accpeted with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Customer successfully being accepted');
            }
            else
            {
                $customer->user_status=4;
                $customer->save();
                $str="Customer's pending registration request rejected with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Customer successfully being rejected');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.CustomerPendingChangeAccess')->with('customer',$customer);
    }

    //cutomer active
    public function CustomerActive()
    {
        $customers=UserCredential::where('user_status',1)
        ->where('user_role',1)->get();
        return view('Admin.ActiveCustomers')->with('customers',$customers);
    }

    public function CustomerActivePost(Request $req)
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
        return redirect()->route('admin.customer.active.changeAcssess',encrypt($req->searchCustomer));
    }
    public function CustomerActiveChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',1)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        return view('Admin.CustomerActiveChangeAccess')->with('customer',$customer);
    }

    public function CustomerActiveChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',1)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        if($customer)
        {
            if(isset($req->block))
            {
                $customer->user_status=3;
                $customer->save();
                $str="Customer blocked with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Customer successfully being blocked');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.CustomerActiveChangeAccess')->with('customer',$customer);
    }

    //Customer Blocked
    public function CustomerBlocked()
    {
        $customers=UserCredential::where('user_status',3)
        ->where('user_role',1)->get();
        return view('Admin.BlockedCustomers')->with('customers',$customers);
    }

    public function CustomerBlockedPost(Request $req)
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
        return redirect()->route('admin.customer.blocked.changeAcssess',encrypt($req->searchCustomer));
    }
    public function CustomerBlockedChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',3)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        return view('Admin.CustomerBlockedChangeAccess')->with('customer',$customer);
    }

    public function CustomerBlockedChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $customer=UserCredential::where('user_status',3)
        ->where('user_role',1)
        ->where('id',$id)
        ->first();
        if($customer)
        {
            if(isset($req->active))
            {
                $customer->user_status=1;
                $customer->save();
                $str="Customer status changed to active with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Customer successfully being actived');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.CustomerBlockedChangeAccess')->with('customer',$customer);
    }
}
