<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class ProductController extends Controller
{
    public function index(){
        $this->AdminCheck();
        return view('admin.add_product');


    }
    public function all_product(){
        $this->AdminCheck();
        $all_product_info=DB::table('tbl_product')->get();
        return view('/admin.all_product')->with('all_product_info',$all_product_info);

    }
    public function save_product(Request $request){
        $data=array();


        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_selection;
        $data['manufacture_id']=$request->brand_selection;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;


        if($request->publication_status) {
            $data['publication_status'] = $request->publication_status;
        }else{
            $data['publication_status']=0;

        }


        $image=$request->file('product_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['product_image']=$image_url;

                DB::table('tbl_product')->insert($data);
                Session::put('message','product added successfuly');

                return Redirect::to('/add-product');

            }
            $data['product_image']='';
            DB::table('tbl_product')->insert($data);
            Session::put('message','product added successfuly');
            return Redirect::to('/add-product');
        }
}
    public function unactive_product($product_id){

        DB::table('tbl_product')->where('product_id',$product_id)->update(['publication_status'=>0]);
        Session::put('message','product unactived successfuly');
        return Redirect::to('/all-product');


    }
    public function active_product($product_id){

        DB::table('tbl_product')->where('product_id',$product_id)->update(['publication_status'=>1]);
        Session::put('message','product actived successfuly');
        return Redirect::to('/all-product');


    }
    public function edit_product($product_id){
        $product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();
        $this->AdminCheck();
        return view('admin.edit_product')->with('product_info',$product_info);

    }
    public function update_product(Request $request,$product_id){
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_selection;
        $data['manufacture_id']=$request->brand_selection;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;

        $image=$request->file('product_image');

        if($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'image/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['product_image'] = $image_url;

                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                Session::put('message', 'product updated successfuly');

                return Redirect::to('/all-product');

            }
            $data['product_image'] = '';
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'product updated successfuly');

            return Redirect::to('/all-product');


        }
    }
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','product deleted successfuly');
        return Redirect::to('/all-product');

    }

    public function AdminCheck(){
        $admin_id=Session::get('admin_id');
        if($admin_id){

            return;
        }else{
            return Redirect::to('/admin')->send();

        }
    }

    public function search_by_name(Request $request){

        $product_name=$request->product_name;
        $products_info=DB::table('tbl_product')
                    ->where('product_name',$product_name)
                    ->get();
             foreach ($products_info as $product) {
                 
            if($product){

                return view('pages.search')->with('all_product_info',$products_info);

            }else{

                Session::put('search','this product is not here');
                return view('pages.search');                 

            }            
             }

    } 

 
}
