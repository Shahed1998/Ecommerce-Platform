<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\ProductModel;
use App\Models\Customer\AddToCart;
use App\Models\Customer\Feedback;

class product extends Controller
{

    // public function __construct(){
    //     $this->middleware('sessionChecker');
    // }

    // get all product
    public function getProduct(Request $req){

        // ---------------- Final
        try{
            $allProducts = ProductModel::all();
            return response()->json([
                "status"=>"Success", 
                "data"=>$allProducts
            ]);
        }catch(Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ]);
        }
        

        // ---------------- Mid
        // $products = ProductModel::all();
        // return view('customer.shop')->with('products', $products);
    }

    public function getOneProduct(Request $req, $id){

        $product = ProductModel::where("id", decrypt($id))->first();
        return view('customer.shopOne')->with('product', $product);

    }

    public function addToCart(Request $req){
       // ----------------------- Final
       try{

        $product = new AddToCart();
        $product->c_id = $req->customer_id;
        $product->p_id = $req->product_id;

        if($product->save()){
            return response()->json([
                "status"=>"success",
                "data"=>$product
            ], 201);
        }

        throw new \ExceptionError("Unable to add product to cart");

       }catch(Exception $e){
            return response()->json([
               "status"=>"Failed",
               "message"=>$e->getMessage()
            ], 400);
       }
        // ----------------------- Mid    
        // $product_id = $req->product_id;
        // $customer_id = $req->session()->get('uc_id');
        // $product = ProductModel::where("id", $product_id)->first();

        // $cart_items = new AddToCart();
        // $cart_items->c_id = $customer_id;
        // $cart_items->p_id = $product_id;
        // $cart_items->save();
        
    }

    public function deleteFromCart(Request $req){
        try{

            AddToCart::where("id", $req->id)->delete();
            return response()->json([
                "status"=>"success",
                "data"=> null
            ],204);

        }catch(\Exception $e){

            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ], 400);

        }
    }

    public function addProdReview(Request $req){
        try{

            $feedback = new Feedback();
            $feedback->p_id = $req->p_id;
            $feedback->c_id = $req->c_id;
            $feedback->review = $req->review;
            $feedback->save();

            return response()->json([
                "status"=>"success",
                "data"=> $feedback
            ],201);

        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ], 400);
        }
    }

    public function viewProdReview(Request $req, $review_id){
        try{

            $reviews = Feedback::where("id", $review_id)->first();
            return response()->json([
                "status"=>"success",
                "data"=> $reviews
            ],200);

        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ], 400);
        }
    }

    public function editProdReview(Request $req, $review_id){
        try{

            $reviews = Feedback::where("id", $review_id)->update(["review"=>$req->review]);
            return response()->json([
                "status"=>"success",
                "data"=> $reviews
            ],200);

        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ], 400);
        }
    }

    public function deleteProdReview(Request $req, $review_id){
        try{

            Feedback::where("id", $review_id)->delete();
            return response()->json([
                "status"=>"success",
                "data"=> null
            ],204);

        }catch(\Exception $e){
            return response()->json([
                "status"=>"Failed",
                "message"=>$e->getMessage()
            ], 400);
        }
    }
}
