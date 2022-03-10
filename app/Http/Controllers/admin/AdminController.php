<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\AdminHistory;
use DateTime;

class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }
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

    //Admin

    public function AdminActivities()
    {
        $activites=UserCredential::where('id',session()->get('uc_id'))
        ->first();
        //return $activites->Histories;
        return view('Admin.activities')->with('activities',$activites->Histories);
    }
}
