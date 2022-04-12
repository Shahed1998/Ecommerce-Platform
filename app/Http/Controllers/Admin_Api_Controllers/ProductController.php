<?php

namespace App\Http\Controllers\Admin_Api_Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserCredential;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Customer_cart;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    //
    //Product
    public function AddProduct(Request $req)
    {
        try
        {
            $check = Validator::make($req->all(),[
                "name"=>"required|min:3|max:30",
                "price"=>"required|regex:/^[0-9]+$/",
                "per_quantity"=>"required|max:20",
                "vendor_id"=>"required|regex:/^[0-9]+$/"
            ]);
            if($check->fails()){
                return response()->json($check->errors());
            }
            $v=UserCredential::where('user_status',1)
            ->where('user_role',4)->where('id',$req->vendor_id)->first();
            if(!$v)
            {
                throw new \ErrorException("Invalid vendor id!");
            }
            $p=new Product();
            $p->name=$req->name;
            $p->price=$req->price;
            $p->per_quantity=$req->per_quantity;
            $p->description=$req->description;
            $p->vendor_id=$req->vendor_id;
            if($p->save())
            {
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"Product successfully added"
                ],200);
            }
            throw new \ErrorException("Something went wrong!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

    public function ViewProducts()
    {
        $products=Product::all();
        return response()->json($products);
    }

    public function ViewProductsById(Request $req)
    {
        $product=Product::where("id",$req->id)->first();
        return response()->json($product);
    }

    public function DeleteProduct(Request $req)
    {
        try
        {
            $p=Product::where('id',$req->id)->first();
            if(!$p)
            {
                return response()->json([
                    "status"=>"Failed",
                    "message"=>"No poroduct found!"
                ],400);
            }
            if(Order::where('product_id',$req->id)->first())
                Order::where('product_id',$req->id)->delete();
            if(Customer_cart::where('p_id',$req->id)->first())
                Customer_cart::where('p_id',$req->id)->delete();
            if(Product::where('id',$req->id)->delete())
            {
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"Product successfully deleted"
                ],200);
            }
            throw new \ErrorException("Something went wrong!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

    public function UpdateProduct(Request $req)
    {
        try
        {
            $p=Product::where("id",$req->id)->first();
            if(!$p)
            {
                throw new \ErrorException("Invalid product!");
            }

            $check = Validator::make($req->all(),[
                "name"=>"min:3|max:30",
                "price"=>"regex:/^[0-9]+$/",
                "per_quantity"=>"max:20",
                "vendor_id"=>"regex:/^[0-9]+$/"
            ]);
            if($check->fails()){
                return response()->json($check->errors());
            }
            if($req->name)
                $p->name=$req->name;
            if($req->price)
                $p->price=$req->price;
            if($req->per_quantity)
                $p->per_quantity=$req->per_quantity;
            if($req->description)
                $p->description=$req->description;
            if($req->vendor_id)
                $p->vendor_id=$req->vendor_id;
            if($p->save())
            {
                return response()->json([
                    "status"=>"Ok",
                    "message"=>"Product successfully updated"
                ],200);
            }
            throw new \ErrorException("Something went wrong!");
        }
        catch(\Exception $e)
        {
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ],400);
        }
    }

}
