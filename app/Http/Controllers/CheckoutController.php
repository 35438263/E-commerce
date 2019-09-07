<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class CheckoutController extends Controller
{
    public function login_check(Request $request){


    	return view('pages.login');


    }
    public function customer_register(Request $request){
		$data=array();
        
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['password']=$request->password;
        $data['customer_phone']=$request->customer_phone;
     

        $customer_id=DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect::to('/checkout');

    }


    public function checkout(){

    	return view('pages.checkout');

    }

    public function save_shipping_details(Request $request){
	$data=array();
        
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_first_name']=$request->shipping_first_name;
        $data['shipping_last_name']=$request->shipping_last_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_city']=$request->shipping_city;
     

        $shipping_id=DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');



    }

    public function customer_login(Request $request){
     	$customer_email=$request->customer_email;
       	$customer_password=$request->password;
        
        $result=DB::table('tbl_customer')->where('customer_email',$customer_email)
            ->where('password',$customer_password)->first();
            if($result){
            	Session::put('customer_id',$result->customer_id);
                 return Redirect::to('/checkout');

            }else{
				Session::put('customer','email or password not valid !!');
				return Redirect::to('/login-check');

            }


    }


       public function customer_logout(){

	    Session::flush();
        return Redirect::to('/');
        }



        public function payment(){


        	return view('pages.payment');


        }

        public function order(Request $request){

        		$payment_method=$request->payment_gateway;
        		$payment_data= array();
        		$payment_data['payment_method']=$payment_method;
        		$payment_data['payment_status']='pending';
        		$payment_id=DB::table('tbl_payment')->insertGetId($payment_data);


        		$order_data=array();
        		$order_data['customer_id']=Session::get('customer_id');
        		$order_data['shipping_id']=Session::get('shipping_id');
        		$order_data['payment_id']=$payment_id;
        		if(Session::get('total')){
        			
        			$order_data['order_total']=Session::get('total');
        		
        		}else{
        			$order_data['order_total']=0;

				}

        		$order_data['order_status']='pending';

        		$order_id=DB::table('tbl_order')->insertGetId($order_data);

        		foreach(session('cart') as $id => $details){

        			$order_details_data=array();
        			$order_details_data['order_id']=$order_id;
        			$order_details_data['product_id']=$id;
        			$order_details_data['product_name']=$details['name'];
        			$order_details_data['product_price']=$details['price'];
        			$order_details_data['product_sales_quantity']=$details['qty'];

        			DB::table('tbl_order_details')->insert($order_details_data);

        		}

        		if($payment_method=='handcash'){
        			Session::put('cart',Null);
        			return view('pages.handcash');
        		}else{

					echo "sucsess by other ";

        		}





        		

        }

}


