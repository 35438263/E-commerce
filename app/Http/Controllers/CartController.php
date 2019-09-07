<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{



    public function add_to_cart(Request $request,$product_id){
       

        $product = DB::table('tbl_product')->where('product_id',$product_id)->first();

        if(!$product) {

            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $product_id => [
                    "name" => $product->product_name,
                    "qty" =>$request->qty,
                    "price" => $product->product_price,
                    "image" => $product->product_image
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product_id])) {

            $cart[$product_id]['qty']+=$request->qty;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product_id] = [
            "name" => $product->product_name,
            "qty" =>$request->qty,
            "price" => $product->product_price,
            "image" => $product->product_image

        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');


    }
    public function delete_cart($id){

        if($id) {

            $cart = session()->get('cart');

            if(isset($cart[$id])) {

                unset($cart[$id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
            return redirect()->back()->with('success', 'Product deleted from cart successfully!');
        }

    }

    public function plus_cart($id ,Request $request){

        unset($_SESSION['cart']);
        if($id) {

            $cart = session()->get('cart');

            $cart[$id]["qty"]++;

            session()->put('cart', $cart);

            session()->flash('success', 'product quantity increases successfully');
            return redirect()->back();
        }
    }

    public function minus_cart($id ,Request $request){

        if($id) {

            $cart = session()->get('cart');

            $cart[$id]["qty"]--;

            session()->put('cart', $cart);

            session()->flash('success', 'product quantity decreases successfully');
            return redirect()->back();
        }
    }
}
