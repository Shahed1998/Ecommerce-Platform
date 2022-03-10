<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use DateTime;

class VendorController extends Controller
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

    //Pending
    public function VendorPending()
    {
        $Vendors=UserCredential::where('user_status',2)
        ->where('user_role',4)->get();
        //return $Vendors;
        return view('Admin.PendingVendors')->with('Vendors',$Vendors);
    }

    public function VendorPendingPost(Request $req)
    {
        $req->validate(
            [
                'searchVendor'=>'required|regex:/^[0-9]+$/'
            ],
            [
                'searchVendor.required'=>'Id cannot be empty',
                'searchVendor.regex'=>'Id must be integer'
            ]
        );
        return redirect()->route('admin.Vendor.pending.changeAcssess',encrypt($req->searchVendor));
    }
    public function VendorPendingChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',2)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        return view('Admin.VendorPendingChangeAccess')->with('Vendor',$Vendor);
    }

    public function VendorPendingChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',2)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        if($Vendor)
        {
            if(isset($req->accept))
            {
                $Vendor->user_status=1;
                $Vendor->save();
                $str="Vendor's pending registration request accpeted with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Vendor successfully being accepted');
            }
            else
            {
                $Vendor->user_status=4;
                $Vendor->save();
                $str="Vendor's pending registration request rejected with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Vendor successfully being rejected');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.VendorPendingChangeAccess')->with('Vendor',$Vendor);
    }

    //Active
    public function VendorActive()
    {
        $Vendors=UserCredential::where('user_status',1)
        ->where('user_role',4)->get();
        //return $Vendors;
        return view('Admin.ActiveVendors')->with('Vendors',$Vendors);
    }

    public function VendorActivePost(Request $req)
    {
        $req->validate(
            [
                'searchVendor'=>'required|regex:/^[0-9]+$/'
            ],
            [
                'searchVendor.required'=>'Id cannot be empty',
                'searchVendor.regex'=>'Id must be integer'
            ]
        );
        return redirect()->route('admin.Vendor.active.changeAcssess',encrypt($req->searchVendor));
    }
    public function VendorActiveChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',1)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        return view('Admin.VendorActiveChangeAccess')->with('Vendor',$Vendor);
    }

    public function VendorActiveChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',1)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        if($Vendor)
        {
            if(isset($req->block))
            {
                $Vendor->user_status=3;
                $Vendor->save();
                $str="Vendor blocked with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Vendor successfully being blokced');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.VendorActiveChangeAccess')->with('Vendor',$Vendor);
    }

    //Blocked
    public function VendorBlocked()
    {
        $Vendors=UserCredential::where('user_status',3)
        ->where('user_role',4)->get();
        //return $Vendors;
        return view('Admin.BlockedVendors')->with('Vendors',$Vendors);
    }

    public function VendorBlockedPost(Request $req)
    {
        $req->validate(
            [
                'searchVendor'=>'required|regex:/^[0-9]+$/'
            ],
            [
                'searchVendor.required'=>'Id cannot be empty',
                'searchVendor.regex'=>'Id must be integer'
            ]
        );
        return redirect()->route('admin.Vendor.blocked.changeAcssess',encrypt($req->searchVendor));
    }
    public function VendorBlockedChangeAccess(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',3)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        return view('Admin.VendorBlockedChangeAccess')->with('Vendor',$Vendor);
    }

    public function VendorBlockedChangeAccessPost(Request $req)
    {
        $id=decrypt($req->id);
        $Vendor=UserCredential::where('user_status',3)
        ->where('user_role',4)
        ->where('id',$id)
        ->first();
        if($Vendor)
        {
            if(isset($req->active))
            {
                $Vendor->user_status=1;
                $Vendor->save();
                $str="Vendor's status changed to active with id ".$id;
                $this->SaveHistory($str);
                $req->session()->flash('msg1','Vendor successfully being activated');
            }
        }
        else
        {
            $req->session()->flash('msg2','Error in the operation');
        }
        return view('Admin.VendorBlockedChangeAccess')->with('Vendor',$Vendor);
    }
}
