<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\ProductModel;
use App\Models\Customer\AddToCart;

class product extends Controller
{

    public function __construct(){
        $this->middleware('sessionChecker');
    }

    public function getProduct(Request $req){
        $products = ProductModel::all();
        return view('customer.shop')->with('products', $products);
    }

    public function getOneProduct(Request $req, $id){

        $product = ProductModel::where("id", decrypt($id))->first();
        return view('customer.shopOne')->with('product', $product);

    }

    public function addToCart(Request $req){
        $product_id = $req->product_id;
        $customer_id = $req->session()->get('uc_id');
        $product = ProductModel::where("id", $product_id)->first();

        $cart_items = new AddToCart();
        $cart_items->c_id = $customer_id;
        $cart_items->p_id = $product_id;
        $cart_items->save();
        
    }
}
