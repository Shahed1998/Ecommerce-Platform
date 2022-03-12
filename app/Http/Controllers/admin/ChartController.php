<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserCredential;
use App\Models\Admin\User;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use DateTime;

class ChartController extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }
    public function UserRatio()
    {
        $users=UserCredential::where('user_status',1)->get();
        
        $userlist=User::all();
        $arrUserCategory=array();
        foreach($userlist as $u)
        {
            array_push($arrUserCategory,$u->user_role);
        }
        
        $arrUserCount=[];
        foreach($userlist as $u)
        {
            
            $arrUserCount+=[$u->user_role=>0];
        }

        foreach($users as $u)
        {
            $arrUserCount[$u->user->user_role]++;
        }
        
        $chartData = ""; // for rendering in chart
        foreach($arrUserCount as $x => $x_value)
        {
            $chartData .= "['".$x."',".$x_value."],";
        }
        $chartData = rtrim($chartData,",");

        return view('admin.UserRatio')->with('chartData',$chartData);
    }
    public function ProductSelling()
    {
        $orders=Order::all();

        $productlist=Product::all();
        $arrProductCategory=array();
        foreach($productlist as $p)
        {
            array_push($arrProductCategory,$p->name);
        }
        
        $arrProductCount=[];
        foreach($productlist as $p)
        {
            $arrProductCount+=[$p->name=>0];
        }

        foreach($orders as $o)
        {
            $arrProductCount[$o->product->name]++;
        }
        
        $chartData = ""; // for rendering in chart
        foreach($arrProductCount as $x => $x_value)
        {
            $chartData .= "['".$x."',".$x_value."],";
        }
        $chartData = rtrim($chartData,",");

        return view('admin.ProductSellingStat')->with('chartData',$chartData);
    }
}
