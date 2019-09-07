<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
   public function index(){

       return view('admin_login');

   }



    public function dashboard(Request $request){

       $admin_email=$request->admin_email;
       $admin_password=$request->admin_password;
        $result=DB::table('tbl_admin')->where('admin_email',$admin_email)
            ->where('admin_password',$admin_password)->first();
            if($result){
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return Redirect::to('/dashboard');

            }else{

                Session::put('message','Email or password not valid');
                return Redirect::to('/admin');

            }
    }




    public function manage_order(){

        $order_info=DB::table('tbl_order')
                    ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                    ->select('tbl_order.*','tbl_customer.customer_name')
                    ->get();


        return view ('admin.manage_order')->with('order_info',$order_info);



    }
    public function view_order($order_id){

          $order_info_by_id=DB::table('tbl_order')
                    ->where('tbl_order.order_id',$order_id)
                    ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                    ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                    
                    ->join('tbl_order_details','tbl_order.order_id','=',
                          'tbl_order_details.order_id')

                    ->select('tbl_order.*','tbl_order_details.*','tbl_customer.*','tbl_shipping.*')
                    ->get();

                    


      return view ('admin.view_order')->with('all_order_info',$order_info_by_id);

    }
}
